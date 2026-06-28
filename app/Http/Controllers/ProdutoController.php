<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the products (tenant isolated).
     */
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $search = $request->input('search');

        $query = Produto::where('tenant_id', $tenantId)->with(['categoria', 'unidade']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('barcode_interno', 'like', "%{$search}%")
                  ->orWhere('barcode', 'like', "%{$search}%");
            });
        }

        $produtos = $query->orderBy('nome', 'asc')->paginate(10)->withQueryString();

        return view('cadastros.produtos.index', compact('produtos', 'search'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $tenantId = auth()->user()->tenant_id;
        $categorias = Categoria::where('tenant_id', $tenantId)->orderBy('nome', 'asc')->get();
        $unidades = Unidade::where('tenant_id', $tenantId)->orderBy('nome', 'asc')->get();

        return view('cadastros.produtos.create', compact('categorias', 'unidades'));
    }

    /**
     * Store a newly created product in database.
     */
    public function store(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        // Custom validation message translations
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'sku' => [
                'nullable', 
                'string', 
                'max:100',
                function ($attribute, $value, $fail) use ($tenantId) {
                    if ($value) {
                        $exists = Produto::where('tenant_id', $tenantId)->where('sku', $value)->exists();
                        if ($exists) {
                            $fail('Este SKU já está cadastrado.');
                        }
                    }
                }
            ],
            'barcode' => ['nullable', 'string', 'max:100'],
            'barcode_interno' => [
                'required', 
                'string', 
                'max:100',
                function ($attribute, $value, $fail) use ($tenantId) {
                    $exists = Produto::where('tenant_id', $tenantId)->where('barcode_interno', $value)->exists();
                    if ($exists) {
                        $fail('Este Código de Barras Interno já está cadastrado.');
                    }
                }
            ],
            'unidade_id' => [
                'nullable',
                function ($attribute, $value, $fail) use ($tenantId) {
                    if ($value) {
                        $exists = Unidade::where('tenant_id', $tenantId)->where('id', $value)->exists();
                        if (!$exists) {
                            $fail('A Unidade selecionada é inválida.');
                        }
                    }
                }
            ],
            'categoria_id' => [
                'required',
                function ($attribute, $value, $fail) use ($tenantId) {
                    $exists = Categoria::where('tenant_id', $tenantId)->where('id', $value)->exists();
                    if (!$exists) {
                        $fail('A Categoria selecionada é inválida.');
                    }
                }
            ],
            'estoque_inicial' => ['required', 'numeric', 'min:0'],
            'estoque_minimo' => ['required', 'numeric', 'min:0'],
            'preco_custo' => ['required', 'numeric', 'min:0'],
            'margem_lucro' => ['required', 'numeric', 'min:0'],
            'preco_venda' => ['required', 'numeric', 'min:0'],
            'imagem' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'tributacao' => ['nullable', 'string', 'max:100'],
            'ncm' => ['required', 'string', 'max:20'],
            'cest' => ['nullable', 'string', 'max:20'],
            'origem' => ['nullable', 'string', 'max:5'],
            'cbenef' => ['nullable', 'string', 'max:50'],
        ]);

        $imagePath = null;
        if ($request->hasFile('imagem')) {
            $file = $request->file('imagem');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/produtos');
            
            // Ensure directory exists
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            $file->move($destinationPath, $filename);
            $imagePath = 'uploads/produtos/' . $filename;
        }

        Produto::create([
            'tenant_id' => $tenantId,
            'nome' => $request->nome,
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'barcode_interno' => $request->barcode_interno,
            'unidade_id' => $request->unidade_id,
            'categoria_id' => $request->categoria_id,
            'estoque_inicial' => $request->estoque_inicial,
            'estoque_minimo' => $request->estoque_minimo,
            'estoque_atual' => $request->estoque_inicial, // initial stock matches current
            'preco_custo' => $request->preco_custo,
            'margem_lucro' => $request->margem_lucro,
            'preco_venda' => $request->preco_venda,
            'imagem' => $imagePath,
            'tributacao' => $request->tributacao,
            'ncm' => $request->ncm,
            'cest' => $request->cest,
            'origem' => $request->origem,
            'cbenef' => $request->cbenef,
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $produto = Produto::where('tenant_id', $tenantId)->findOrFail($id);
        $categorias = Categoria::where('tenant_id', $tenantId)->orderBy('nome', 'asc')->get();
        $unidades = Unidade::where('tenant_id', $tenantId)->orderBy('nome', 'asc')->get();

        return view('cadastros.produtos.edit', compact('produto', 'categorias', 'unidades'));
    }

    /**
     * Update the specified product in database.
     */
    public function update(Request $request, $id)
    {
        $tenantId = auth()->user()->tenant_id;
        $produto = Produto::where('tenant_id', $tenantId)->findOrFail($id);

        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'sku' => [
                'nullable', 
                'string', 
                'max:100',
                function ($attribute, $value, $fail) use ($tenantId, $id) {
                    if ($value) {
                        $exists = Produto::where('tenant_id', $tenantId)
                            ->where('sku', $value)
                            ->where('id', '!=', $id)
                            ->exists();
                        if ($exists) {
                            $fail('Este SKU já está cadastrado.');
                        }
                    }
                }
            ],
            'barcode' => ['nullable', 'string', 'max:100'],
            'barcode_interno' => [
                'required', 
                'string', 
                'max:100',
                function ($attribute, $value, $fail) use ($tenantId, $id) {
                    $exists = Produto::where('tenant_id', $tenantId)
                        ->where('barcode_interno', $value)
                        ->where('id', '!=', $id)
                        ->exists();
                    if ($exists) {
                        $fail('Este Código de Barras Interno já está cadastrado.');
                    }
                }
            ],
            'unidade_id' => [
                'nullable',
                function ($attribute, $value, $fail) use ($tenantId) {
                    if ($value) {
                        $exists = Unidade::where('tenant_id', $tenantId)->where('id', $value)->exists();
                        if (!$exists) {
                            $fail('A Unidade selecionada é inválida.');
                        }
                    }
                }
            ],
            'categoria_id' => [
                'required',
                function ($attribute, $value, $fail) use ($tenantId) {
                    $exists = Categoria::where('tenant_id', $tenantId)->where('id', $value)->exists();
                    if (!$exists) {
                        $fail('A Categoria selecionada é inválida.');
                    }
                }
            ],
            'estoque_inicial' => ['required', 'numeric', 'min:0'],
            'estoque_minimo' => ['required', 'numeric', 'min:0'],
            'preco_custo' => ['required', 'numeric', 'min:0'],
            'margem_lucro' => ['required', 'numeric', 'min:0'],
            'preco_venda' => ['required', 'numeric', 'min:0'],
            'imagem' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'tributacao' => ['nullable', 'string', 'max:100'],
            'ncm' => ['required', 'string', 'max:20'],
            'cest' => ['nullable', 'string', 'max:20'],
            'origem' => ['nullable', 'string', 'max:5'],
            'cbenef' => ['nullable', 'string', 'max:50'],
        ]);

        $imagePath = $produto->imagem;
        if ($request->hasFile('imagem')) {
            // Delete old image if it exists
            if ($imagePath && File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }

            $file = $request->file('imagem');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/produtos');
            
            // Ensure directory exists
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            $file->move($destinationPath, $filename);
            $imagePath = 'uploads/produtos/' . $filename;
        }

        // Calculate new estoque_atual adjustment. If estoque_inicial is updated,
        // we can adjust estoque_atual by the difference, or just reset/keep it simple.
        // Let's adjust stock:
        $stockDiff = $request->estoque_inicial - $produto->estoque_inicial;
        $newEstoqueAtual = max(0, $produto->estoque_atual + $stockDiff);

        $produto->update([
            'nome' => $request->nome,
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'barcode_interno' => $request->barcode_interno,
            'unidade_id' => $request->unidade_id,
            'categoria_id' => $request->categoria_id,
            'estoque_inicial' => $request->estoque_inicial,
            'estoque_minimo' => $request->estoque_minimo,
            'estoque_atual' => $newEstoqueAtual,
            'preco_custo' => $request->preco_custo,
            'margem_lucro' => $request->margem_lucro,
            'preco_venda' => $request->preco_venda,
            'imagem' => $imagePath,
            'tributacao' => $request->tributacao,
            'ncm' => $request->ncm,
            'cest' => $request->cest,
            'origem' => $request->origem,
            'cbenef' => $request->cbenef,
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified product from database.
     */
    public function destroy($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $produto = Produto::where('tenant_id', $tenantId)->findOrFail($id);

        // Delete image file if exists
        if ($produto->imagem && File::exists(public_path($produto->imagem))) {
            File::delete(public_path($produto->imagem));
        }

        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}
