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

    /**
     * Test client edit form rendering.
     */
    public function test_customer_edit_page_can_be_rendered(): void
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

        $cliente = Cliente::create([
            'tenant_id' => $tenant->id,
            'tipo_cliente' => 'PF',
            'documento' => '111.444.777-35',
            'nome' => 'Cliente Teste',
            'email' => 'cliente@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '1',
            'tipo_contribuinte' => 'não_contribuinte',
        ]);

        $response = $this->actingAs($user)->get("/clientes/{$cliente->id}/edit");

        $response->assertStatus(200);
        $response->assertSee('Editar Cliente');
        $response->assertSee('111.444.777-35');
    }

    /**
     * Test customer can be updated successfully.
     */
    public function test_customer_can_be_updated_successfully(): void
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

        $cliente = Cliente::create([
            'tenant_id' => $tenant->id,
            'tipo_cliente' => 'PF',
            'documento' => '111.444.777-35',
            'nome' => 'Nome Antigo',
            'email' => 'cliente@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '1',
            'tipo_contribuinte' => 'não_contribuinte',
        ]);

        $response = $this->actingAs($user)->put("/clientes/{$cliente->id}", [
            'tipo_cliente' => 'PF',
            'documento' => '111.444.777-35', // keep same CPF
            'nome' => 'Nome Novo',
            'tipo_contribuinte' => 'não_contribuinte',
            'email' => 'cliente.novo@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '2',
        ]);

        $response->assertRedirect('/clientes');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'nome' => 'Nome Novo',
            'email' => 'cliente.novo@teste.com',
            'numero' => '2',
        ]);
    }

    /**
     * Test unique document validation checks duplicates on other clients but ignores self.
     */
    public function test_customer_uniqueness_ignores_self_but_blocks_others(): void
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

        $cliente1 = Cliente::create([
            'tenant_id' => $tenant->id,
            'tipo_cliente' => 'PF',
            'documento' => '111.444.777-35', // CPF 1
            'nome' => 'Cliente 1',
            'email' => 'c1@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '1',
            'tipo_contribuinte' => 'não_contribuinte',
        ]);

        $cliente2 = Cliente::create([
            'tenant_id' => $tenant->id,
            'tipo_cliente' => 'PF',
            'documento' => '222.555.888-03', // CPF 2
            'nome' => 'Cliente 2',
            'email' => 'c2@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '2',
            'tipo_contribuinte' => 'não_contribuinte',
        ]);

        // Attempting to update Cliente 2 with CPF of Cliente 1 should fail
        $response = $this->actingAs($user)->put("/clientes/{$cliente2->id}", [
            'tipo_cliente' => 'PF',
            'documento' => '111.444.777-35', // Duplicate
            'nome' => 'Cliente 2 Tentando Duplicar',
            'email' => 'c2@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '2',
            'tipo_contribuinte' => 'não_contribuinte',
        ]);

        $response->assertSessionHasErrors(['documento']);
    }

    /**
     * Test client deletion.
     */
    public function test_customer_can_be_deleted_successfully(): void
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

        $cliente = Cliente::create([
            'tenant_id' => $tenant->id,
            'tipo_cliente' => 'PF',
            'documento' => '111.444.777-35',
            'nome' => 'Cliente Teste',
            'email' => 'cliente@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '1',
            'tipo_contribuinte' => 'não_contribuinte',
        ]);

        $response = $this->actingAs($user)->delete("/clientes/{$cliente->id}");

        $response->assertRedirect('/clientes');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('clientes', [
            'id' => $cliente->id,
        ]);
    }

    /**
     * Test tenant isolation for edit, update, delete.
     */
    public function test_customer_tenant_isolation_on_write_actions(): void
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

        $clienteA = Cliente::create([
            'tenant_id' => $tenantA->id,
            'tipo_cliente' => 'PF',
            'documento' => '111.444.777-35',
            'nome' => 'Cliente A',
            'email' => 'a@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '1',
            'tipo_contribuinte' => 'não_contribuinte',
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

        // User B tries to view User A's edit page -> should 404
        $response = $this->actingAs($userB)->get("/clientes/{$clienteA->id}/edit");
        $response->assertStatus(404);

        // User B tries to update User A's client -> should 404
        $response = $this->actingAs($userB)->put("/clientes/{$clienteA->id}", [
            'tipo_cliente' => 'PF',
            'documento' => '111.444.777-35',
            'nome' => 'Modificado por B',
            'email' => 'a@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '1',
            'tipo_contribuinte' => 'não_contribuinte',
        ]);
        $response->assertStatus(404);

        // User B tries to delete User A's client -> should 404
        $response = $this->actingAs($userB)->delete("/clientes/{$clienteA->id}");
        $response->assertStatus(404);
    }
}
