<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Show the application registration form.
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * Handle a registration request for the application.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nome_empresa' => ['required', 'string', 'max:255'],
            'cnpj' => [
                'required',
                'string',
                'unique:tenants,cnpj',
                function ($attribute, $value, $fail) {
                    if (!$this->validateCnpj($value)) {
                        $fail('O CNPJ informado é inválido.');
                    }
                }
            ],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[A-Za-z]/', // contains letters
                'regex:/[0-9]/',    // contains numbers
            ],
        ], [
            'password.regex' => 'A senha deve conter pelo menos uma letra e um número.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado no sistema.',
            'email.unique' => 'Este e-mail corporativo já está em uso.',
        ]);

        $user = DB::transaction(function () use ($request) {
            $tenant = Tenant::create([
                'nome_empresa' => $request->nome_empresa,
                'cnpj' => $request->cnpj,
            ]);

            return User::create([
                'tenant_id' => $tenant->id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Validates Brazil's CNPJ format and digits.
     */
    private function validateCnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        if (strlen($cnpj) != 14) return false;
        
        // Reject identical digit sequences (e.g. 00000000000000)
        if (preg_match('/(\d)\1{13}/', $cnpj)) return false;
        
        // First verifier digit validation
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) return false;
        
        // Second verifier digit validation
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj[13] != ($resto < 2 ? 0 : 11 - $resto)) return false;
        
        return true;
    }
}
