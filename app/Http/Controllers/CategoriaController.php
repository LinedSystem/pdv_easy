<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of categories (tenant-isolated).
     */
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $categorias = Categoria::where('tenant_id', $tenantId)
            ->orderBy('nome', 'asc')
            ->paginate(10);

        // Edit state: check if an edit ID was passed
        $editCategoria = null;
        if ($request->filled('edit')) {
            $editCategoria = Categoria::where('tenant_id', $tenantId)
                ->where('id', $request->query('edit'))
                ->first();
        }

        return view('cadastros.auxiliares.categorias', compact('categorias', 'editCategoria'));
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($tenantId) {
                    $exists = Categoria::where('tenant_id', $tenantId)
                        ->where('nome', $value)
                        ->exists();
                    if ($exists) {
                        $fail('Esta categoria já está cadastrada no sistema.');
                    }
                }
            ],
        ]);

        Categoria::create([
            'tenant_id' => $tenantId,
            'nome' => $request->nome,
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria cadastrada com sucesso!');
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, $id)
    {
        $tenantId = auth()->user()->tenant_id;
        $categoria = Categoria::where('tenant_id', $tenantId)->findOrFail($id);

        $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($tenantId, $id) {
                    $exists = Categoria::where('tenant_id', $tenantId)
                        ->where('nome', $value)
                        ->where('id', '!=', $id)
                        ->exists();
                    if ($exists) {
                        $fail('Esta categoria já está cadastrada no sistema.');
                    }
                }
            ],
        ]);

        $categoria->update([
            'nome' => $request->nome,
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified category.
     */
    public function destroy($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $categoria = Categoria::where('tenant_id', $tenantId)->findOrFail($id);
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }
}
