<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the clients (tenant isolated).
     */
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        // Search query
        $search = $request->input('search');

        $query = Cliente::where('tenant_id', $tenantId);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                  ->orWhere('documento', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('apelido', 'like', "%{$search}%");
            });
        }

        $clientes = $query->orderBy('nome', 'asc')->paginate(10)->withQueryString();

        return view('clientes.index', compact('clientes', 'search'));
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created client in database (tenant isolated).
     */
    public function store(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        // Validation rules
        $request->validate([
            'tipo_cliente' => ['required', 'in:PF,PJ'],
            'documento' => [
                'required',
                'string',
                'max:25',
                function ($attribute, $value, $fail) use ($request, $tenantId) {
                    $cleanDoc = preg_replace('/\D/', '', $value);
                    
                    // Validate digits
                    if ($request->tipo_cliente === 'PF') {
                        if (!$this->validateCpf($cleanDoc)) {
                            $fail('O CPF informado é inválido.');
                            return;
                        }
                    } else {
                        if (!$this->validateCnpj($cleanDoc)) {
                            $fail('O CNPJ informado é inválido.');
                            return;
                        }
                    }

                    // Validate uniqueness for the current tenant
                    $exists = Cliente::where('tenant_id', $tenantId)
                        ->where('documento', $value)
                        ->exists();
                    if ($exists) {
                        $fail(($request->tipo_cliente === 'PF' ? 'Este CPF' : 'Este CNPJ') . ' já está cadastrado no sistema.');
                    }
                }
            ],
            'nome' => ['required', 'string', 'max:255'],
            'apelido' => ['nullable', 'string', 'max:255'],
            'registro_geral' => ['nullable', 'string', 'max:255'],
            'tipo_contribuinte' => ['required', 'string', 'in:contribuinte_icms,não_contribuinte,isento'],
            'telefone_fixo' => ['nullable', 'string', 'max:25'],
            'telefone_celular' => ['nullable', 'string', 'max:25'],
            'email' => ['required', 'email', 'max:255'],
            'cep' => ['required', 'string', 'max:9'],
            'logradouro' => ['required', 'string', 'max:255'],
            'numero' => ['required', 'string', 'max:15'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'complemento' => ['nullable', 'string', 'max:255'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'uf' => ['nullable', 'string', 'max:2'],
            'ibge' => ['nullable', 'string', 'max:20'],
        ]);

        Cliente::create([
            'tenant_id' => $tenantId,
            'tipo_cliente' => $request->tipo_cliente,
            'documento' => $request->documento,
            'nome' => $request->nome,
            'apelido' => $request->apelido,
            'registro_geral' => $request->registro_geral,
            'tipo_contribuinte' => $request->tipo_contribuinte,
            'consumidor_final' => $request->has('consumidor_final'),
            'telefone_fixo' => $request->telefone_fixo,
            'telefone_celular' => $request->telefone_celular,
            'email' => $request->email,
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'complemento' => $request->complemento,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'ibge' => $request->ibge,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Validate CPF digits.
     */
    private function validateCpf($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (strlen($cpf) != 11) return false;
        
        // Reject identical digit sequences
        if (preg_match('/(\d)\1{10}/', $cpf)) return false;
        
        // First verifier digit validation
        for ($i = 0, $soma = 0; $i < 9; $i++) {
            $soma += $cpf[$i] * (10 - $i);
        }
        $resto = ($soma * 10) % 11;
        if ($resto == 10 || $resto == 11) $resto = 0;
        if ($cpf[9] != $resto) return false;
        
        // Second verifier digit validation
        for ($i = 0, $soma = 0; $i < 10; $i++) {
            $soma += $cpf[$i] * (11 - $i);
        }
        $resto = ($soma * 10) % 11;
        if ($resto == 10 || $resto == 11) $resto = 0;
        if ($cpf[10] != $resto) return false;
        
        return true;
    }

    /**
     * Validate CNPJ digits.
     */
    private function validateCnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        if (strlen($cnpj) != 14) return false;
        
        // Reject identical digit sequences
        if (preg_match('/(\d)\1{13}/', $cnpj)) return false;
        
        // First verifier digit validation
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        $digito1 = $resto < 2 ? 0 : 11 - $resto;
        if ($cnpj[12] != $digito1) return false;
        
        // Second verifier digit validation
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        $digito2 = $resto < 2 ? 0 : 11 - $resto;
        if ($cnpj[13] != $digito2) return false;
        
        return true;
    }
}
