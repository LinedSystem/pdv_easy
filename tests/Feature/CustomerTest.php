<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test client registration page rendering.
     */
    public function test_customer_creation_page_can_be_rendered(): void
    {
        $tenant = Tenant::create([
            'nome_empresa' => 'Empresa Teste',
            'cnpj' => '06.990.590/0001-23',
        ]);

        $user = User::create([
            'tenant_id' => $tenant->id,
            'name' => 'Usuario Teste',
            'email' => 'teste@empresa.com',
            'password' => bcrypt('Senha123'),
        ]);
        $user->email_verified_at = now();
        $user->save();

        $response = $this->actingAs($user)->get('/clientes/create');

        $response->assertStatus(200);
        $response->assertSee('Cadastro de Novo Cliente');
        $response->assertSee('Tipo de Personalidade');
    }

    /**
     * Test client list empty state.
     */
    public function test_customer_list_page_can_be_rendered_with_empty_state(): void
    {
        $tenant = Tenant::create([
            'nome_empresa' => 'Empresa Teste',
            'cnpj' => '06.990.590/0001-23',
        ]);

        $user = User::create([
            'tenant_id' => $tenant->id,
            'name' => 'Usuario Teste',
            'email' => 'teste@empresa.com',
            'password' => bcrypt('Senha123'),
        ]);
        $user->email_verified_at = now();
        $user->save();

        $response = $this->actingAs($user)->get('/clientes');

        $response->assertStatus(200);
        $response->assertSee('Nenhum cliente cadastrado ainda');
    }

    /**
     * Test client can be stored successfully.
     */
    public function test_customer_can_be_stored_successfully(): void
    {
        $tenant = Tenant::create([
            'nome_empresa' => 'Empresa Teste',
            'cnpj' => '06.990.590/0001-23',
        ]);

        $user = User::create([
            'tenant_id' => $tenant->id,
            'name' => 'Usuario Teste',
            'email' => 'teste@empresa.com',
            'password' => bcrypt('Senha123'),
        ]);
        $user->email_verified_at = now();
        $user->save();

        $response = $this->actingAs($user)->post('/clientes', [
            'tipo_cliente' => 'PF',
            'documento' => '111.444.777-35', // Valid CPF
            'nome' => 'Cliente Teste PF',
            'apelido' => 'Testinho',
            'registro_geral' => '12.345.678-9',
            'tipo_contribuinte' => 'não_contribuinte',
            'consumidor_final' => 'on',
            'telefone_fixo' => '(11) 4444-4444',
            'telefone_celular' => '(11) 99999-9999',
            'email' => 'cliente@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Praça da Sé',
            'numero' => '100',
            'bairro' => 'Sé',
            'complemento' => 'Cj 12',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'ibge' => '3550308',
        ]);

        $response->assertRedirect('/clientes');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('clientes', [
            'tenant_id' => $tenant->id,
            'nome' => 'Cliente Teste PF',
            'email' => 'cliente@teste.com',
            'tipo_cliente' => 'PF',
            'documento' => '111.444.777-35',
        ]);
    }

    /**
     * Test client with invalid CPF is rejected.
     */
    public function test_customer_with_invalid_cpf_is_rejected(): void
    {
        $tenant = Tenant::create([
            'nome_empresa' => 'Empresa Teste',
            'cnpj' => '06.990.590/0001-23',
        ]);

        $user = User::create([
            'tenant_id' => $tenant->id,
            'name' => 'Usuario Teste',
            'email' => 'teste@empresa.com',
            'password' => bcrypt('Senha123'),
        ]);
        $user->email_verified_at = now();
        $user->save();

        $response = $this->actingAs($user)->post('/clientes', [
            'tipo_cliente' => 'PF',
            'documento' => '123.456.789-00', // Invalid CPF
            'nome' => 'Cliente Teste PF',
            'email' => 'cliente@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua Falsa',
            'numero' => '123',
            'tipo_contribuinte' => 'não_contribuinte',
        ]);

        $response->assertSessionHasErrors(['documento']);
    }

    /**
     * Test multi-tenant isolation of client records.
     */
    public function test_customer_list_is_isolated_by_tenant(): void
    {
        // Tenant A
        $tenantA = Tenant::create([
            'nome_empresa' => 'Empresa A',
            'cnpj' => '06.990.590/0001-23',
        ]);

        $userA = User::create([
            'tenant_id' => $tenantA->id,
            'name' => 'Usuario A',
            'email' => 'a@empresa.com',
            'password' => bcrypt('Senha123'),
        ]);
        $userA->email_verified_at = now();
        $userA->save();

        Cliente::create([
            'tenant_id' => $tenantA->id,
            'tipo_cliente' => 'PF',
            'documento' => '111.444.777-35', // Valid CPF
            'nome' => 'Cliente Tenant A',
            'email' => 'cliente.a@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua A',
            'numero' => '10',
        ]);

        // Tenant B
        $tenantB = Tenant::create([
            'nome_empresa' => 'Empresa B',
            'cnpj' => '12.345.678/0001-99',
        ]);

        $userB = User::create([
            'tenant_id' => $tenantB->id,
            'name' => 'Usuario B',
            'email' => 'b@empresa.com',
            'password' => bcrypt('Senha123'),
        ]);
        $userB->email_verified_at = now();
        $userB->save();

        Cliente::create([
            'tenant_id' => $tenantB->id,
            'tipo_cliente' => 'PJ',
            'documento' => '06.990.590/0001-23', // Valid CNPJ
            'nome' => 'Cliente Tenant B',
            'email' => 'cliente.b@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua B',
            'numero' => '20',
        ]);

        // Accessing as User A
        $responseA = $this->actingAs($userA)->get('/clientes');
        $responseA->assertStatus(200);
        $responseA->assertSee('Cliente Tenant A');
        $responseA->assertDontSee('Cliente Tenant B');

        // Accessing as User B
        $responseB = $this->actingAs($userB)->get('/clientes');
        $responseB->assertStatus(200);
        $responseB->assertSee('Cliente Tenant B');
        $responseB->assertDontSee('Cliente Tenant A');
    }
}
