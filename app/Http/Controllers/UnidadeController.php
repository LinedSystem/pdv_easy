<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    /**
     * Display a listing of units (tenant-isolated).
     */
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $unidades = Unidade::where('tenant_id', $tenantId)
            ->orderBy('nome', 'asc')
            ->paginate(10);

        // Edit state: check if an edit ID was passed
        $editUnidade = null;
        if ($request->filled('edit')) {
            $editUnidade = Unidade::where('tenant_id', $tenantId)
                ->where('id', $request->query('edit'))
                ->first();
        }

        return view('cadastros.auxiliares.unidades', compact('unidades', 'editUnidade'));
    }

    /**
     * Store a newly created unit.
     */
    public function store(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'abreviacao' => [
                'required',
                'string',
                'max:10',
                function ($attribute, $value, $fail) use ($tenantId) {
                    $exists = Unidade::where('tenant_id', $tenantId)
                        ->where('abreviacao', $value)
                        ->exists();
                    if ($exists) {
                        $fail('Esta abreviação de unidade já está cadastrada no sistema.');
                    }
                }
            ],
        ]);

        Unidade::create([
            'tenant_id' => $tenantId,
            'nome' => $request->nome,
            'abreviacao' => strtoupper($request->abreviacao),
        ]);

        return redirect()->route('unidades.index')
            ->with('success', 'Unidade cadastrada com sucesso!');
    }

    /**
     * Update the specified unit.
     */
    public function update(Request $request, $id)
    {
        $tenantId = auth()->user()->tenant_id;
        $unidade = Unidade::where('tenant_id', $tenantId)->findOrFail($id);

        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'abreviacao' => [
                'required',
                'string',
                'max:10',
                function ($attribute, $value, $fail) use ($tenantId, $id) {
                    $exists = Unidade::where('tenant_id', $tenantId)
                        ->where('abreviacao', $value)
                        ->where('id', '!=', $id)
                        ->exists();
                    if ($exists) {
                        $fail('Esta abreviação de unidade já está cadastrada no sistema.');
                    }
                }
            ],
        ]);

        $unidade->update([
            'nome' => $request->nome,
            'abreviacao' => strtoupper($request->abreviacao),
        ]);

        return redirect()->route('unidades.index')
            ->with('success', 'Unidade atualizada com sucesso!');
    }

    /**
     * Remove the specified unit.
     */
    public function destroy($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $unidade = Unidade::where('tenant_id', $tenantId)->findOrFail($id);
        $unidade->delete();

        return redirect()->route('unidades.index')
            ->with('success', 'Unidade excluída com sucesso!');
    }
}
