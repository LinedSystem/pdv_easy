<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test supplier registration page rendering.
     */
    public function test_supplier_creation_page_can_be_rendered(): void
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

        $response = $this->actingAs($user)->get('/fornecedores/create');

        $response->assertStatus(200);
        $response->assertSee('Cadastro de Novo Fornecedor');
        $response->assertSee('Tipo de Personalidade');
    }

    /**
     * Test supplier list empty state.
     */
    public function test_supplier_list_page_can_be_rendered_with_empty_state(): void
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

        $response = $this->actingAs($user)->get('/fornecedores');

        $response->assertStatus(200);
        $response->assertSee('Nenhum fornecedor cadastrado ainda');
    }

    /**
     * Test supplier can be stored successfully.
     */
    public function test_supplier_can_be_stored_successfully(): void
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

        $response = $this->actingAs($user)->post('/fornecedores', [
            'tipo_fornecedor' => 'PF',
            'documento' => '111.444.777-35', // Valid CPF
            'nome' => 'Fornecedor Teste PF',
            'apelido' => 'Testinho',
            'registro_geral' => '12.345.678-9',
            'tipo_contribuinte' => 'não_contribuinte',
            'ativo' => 'on',
            'telefone_fixo' => '(11) 4444-4444',
            'telefone_celular' => '(11) 99999-9999',
            'email' => 'fornecedor@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Praça da Sé',
            'numero' => '100',
            'bairro' => 'Sé',
            'complemento' => 'Cj 12',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'ibge' => '3550308',
        ]);

        $response->assertRedirect('/fornecedores');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('fornecedores', [
            'tenant_id' => $tenant->id,
            'nome' => 'Fornecedor Teste PF',
            'email' => 'fornecedor@teste.com',
            'tipo_fornecedor' => 'PF',
            'documento' => '111.444.777-35',
        ]);
    }

    /**
     * Test supplier with invalid CPF is rejected.
     */
    public function test_supplier_with_invalid_cpf_is_rejected(): void
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

        $response = $this->actingAs($user)->post('/fornecedores', [
            'tipo_fornecedor' => 'PF',
            'documento' => '123.456.789-00', // Invalid CPF
            'nome' => 'Fornecedor Teste PF',
            'email' => 'fornecedor@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua Falsa',
            'numero' => '123',
            'tipo_contribuinte' => 'não_contribuinte',
        ]);

        $response->assertSessionHasErrors(['documento']);
    }

    /**
     * Test multi-tenant isolation of supplier records.
     */
    public function test_supplier_list_is_isolated_by_tenant(): void
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

        Fornecedor::create([
            'tenant_id' => $tenantA->id,
            'tipo_fornecedor' => 'PF',
            'documento' => '111.444.777-35', // Valid CPF
            'nome' => 'Fornecedor Tenant A',
            'email' => 'fornecedor.a@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua A',
            'numero' => '10',
            'tipo_contribuinte' => 'não_contribuinte',
            'ativo' => true,
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

        Fornecedor::create([
            'tenant_id' => $tenantB->id,
            'tipo_fornecedor' => 'PJ',
            'documento' => '06.990.590/0001-23', // Valid CNPJ
            'nome' => 'Fornecedor Tenant B',
            'email' => 'fornecedor.b@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua B',
            'numero' => '20',
            'tipo_contribuinte' => 'não_contribuinte',
            'ativo' => true,
        ]);

        // Accessing as User A
        $responseA = $this->actingAs($userA)->get('/fornecedores');
        $responseA->assertStatus(200);
        $responseA->assertSee('Fornecedor Tenant A');
        $responseA->assertDontSee('Fornecedor Tenant B');

        // Accessing as User B
        $responseB = $this->actingAs($userB)->get('/fornecedores');
        $responseB->assertStatus(200);
        $responseB->assertSee('Fornecedor Tenant B');
        $responseB->assertDontSee('Fornecedor Tenant A');
    }

    /**
     * Test supplier edit form rendering.
     */
    public function test_supplier_edit_page_can_be_rendered(): void
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

        $fornecedor = Fornecedor::create([
            'tenant_id' => $tenant->id,
            'tipo_fornecedor' => 'PF',
            'documento' => '111.444.777-35',
            'nome' => 'Fornecedor Teste',
            'email' => 'fornecedor@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '1',
            'tipo_contribuinte' => 'não_contribuinte',
            'ativo' => true,
        ]);

        $response = $this->actingAs($user)->get("/fornecedores/{$fornecedor->id}/edit");

        $response->assertStatus(200);
        $response->assertSee('Editar Fornecedor');
        $response->assertSee('111.444.777-35');
    }

    /**
     * Test supplier can be updated successfully.
     */
    public function test_supplier_can_be_updated_successfully(): void
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

        $fornecedor = Fornecedor::create([
            'tenant_id' => $tenant->id,
            'tipo_fornecedor' => 'PF',
            'documento' => '111.444.777-35',
            'nome' => 'Nome Antigo',
            'email' => 'fornecedor@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '1',
            'tipo_contribuinte' => 'não_contribuinte',
            'ativo' => true,
        ]);

        $response = $this->actingAs($user)->put("/fornecedores/{$fornecedor->id}", [
            'tipo_fornecedor' => 'PF',
            'documento' => '111.444.777-35', // keep same CPF
            'nome' => 'Nome Novo',
            'tipo_contribuinte' => 'não_contribuinte',
            'email' => 'fornecedor.novo@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '2',
            'ativo' => 'on',
        ]);

        $response->assertRedirect('/fornecedores');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('fornecedores', [
            'id' => $fornecedor->id,
            'nome' => 'Nome Novo',
            'email' => 'fornecedor.novo@teste.com',
            'numero' => '2',
        ]);
    }

    /**
     * Test unique document validation checks duplicates on other suppliers but ignores self.
     */
    public function test_supplier_uniqueness_ignores_self_but_blocks_others(): void
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

        $fornecedor1 = Fornecedor::create([
            'tenant_id' => $tenant->id,
            'tipo_fornecedor' => 'PF',
            'documento' => '111.444.777-35', // CPF 1
            'nome' => 'Fornecedor 1',
            'email' => 'f1@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '1',
            'tipo_contribuinte' => 'não_contribuinte',
            'ativo' => true,
        ]);

        $fornecedor2 = Fornecedor::create([
            'tenant_id' => $tenant->id,
            'tipo_fornecedor' => 'PF',
            'documento' => '222.555.888-03', // CPF 2
            'nome' => 'Fornecedor 2',
            'email' => 'f2@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '2',
            'tipo_contribuinte' => 'não_contribuinte',
            'ativo' => true,
        ]);

        // Attempting to update Fornecedor 2 with CPF of Fornecedor 1 should fail
        $response = $this->actingAs($user)->put("/fornecedores/{$fornecedor2->id}", [
            'tipo_fornecedor' => 'PF',
            'documento' => '111.444.777-35', // Duplicate
            'nome' => 'Fornecedor 2 Tentando Duplicar',
            'email' => 'f2@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '2',
            'tipo_contribuinte' => 'não_contribuinte',
            'ativo' => 'on',
        ]);

        $response->assertSessionHasErrors(['documento']);
    }

    /**
     * Test supplier deletion.
     */
    public function test_supplier_can_be_deleted_successfully(): void
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

        $fornecedor = Fornecedor::create([
            'tenant_id' => $tenant->id,
            'tipo_fornecedor' => 'PF',
            'documento' => '111.444.777-35',
            'nome' => 'Fornecedor Teste',
            'email' => 'fornecedor@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '1',
            'tipo_contribuinte' => 'não_contribuinte',
            'ativo' => true,
        ]);

        $response = $this->actingAs($user)->delete("/fornecedores/{$fornecedor->id}");

        $response->assertRedirect('/fornecedores');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('fornecedores', [
            'id' => $fornecedor->id,
        ]);
    }

    /**
     * Test tenant isolation for edit, update, delete.
     */
    public function test_supplier_tenant_isolation_on_write_actions(): void
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

        $fornecedorA = Fornecedor::create([
            'tenant_id' => $tenantA->id,
            'tipo_fornecedor' => 'PF',
            'documento' => '111.444.777-35',
            'nome' => 'Fornecedor A',
            'email' => 'a@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '1',
            'tipo_contribuinte' => 'não_contribuinte',
            'ativo' => true,
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
        $response = $this->actingAs($userB)->get("/fornecedores/{$fornecedorA->id}/edit");
        $response->assertStatus(404);

        // User B tries to update User A's supplier -> should 404
        $response = $this->actingAs($userB)->put("/fornecedores/{$fornecedorA->id}", [
            'tipo_fornecedor' => 'PF',
            'documento' => '111.444.777-35',
            'nome' => 'Modificado por B',
            'email' => 'a@teste.com',
            'cep' => '01001-000',
            'logradouro' => 'Rua',
            'numero' => '1',
            'tipo_contribuinte' => 'não_contribuinte',
            'ativo' => 'on',
        ]);
        $response->assertStatus(404);

        // User B tries to delete User A's supplier -> should 404
        $response = $this->actingAs($userB)->delete("/fornecedores/{$fornecedorA->id}");
        $response->assertStatus(404);
    }
}
