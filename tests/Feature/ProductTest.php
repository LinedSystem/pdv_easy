<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Unidade;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test product creation page rendering.
     */
    public function test_product_creation_page_can_be_rendered(): void
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

        $response = $this->actingAs($user)->get('/produtos/create');

        $response->assertStatus(200);
        $response->assertSee('Cadastro de Novo Produto');
        $response->assertSee('Dados do Produto');
    }

    /**
     * Test product list empty state.
     */
    public function test_product_list_page_can_be_rendered_with_empty_state(): void
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

        $response = $this->actingAs($user)->get('/produtos');

        $response->assertStatus(200);
        $response->assertSee('Nenhum produto cadastrado ainda');
    }

    /**
     * Test product can be stored successfully.
     */
    public function test_product_can_be_stored_successfully(): void
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

        $categoria = Categoria::create([
            'tenant_id' => $tenant->id,
            'nome' => 'Bebidas',
        ]);

        $unidade = Unidade::create([
            'tenant_id' => $tenant->id,
            'nome' => 'Lata 350ml',
            'abreviacao' => 'LT',
        ]);

        $response = $this->actingAs($user)->post('/produtos', [
            'nome' => 'Coca Cola Lata',
            'sku' => 'COCA-LATA-350',
            'barcode' => '7891234567890',
            'barcode_interno' => '10001',
            'unidade_id' => $unidade->id,
            'categoria_id' => $categoria->id,
            'estoque_inicial' => 100,
            'estoque_minimo' => 10,
            'preco_custo' => 2.50,
            'margem_lucro' => 60,
            'preco_venda' => 4.00,
            'tributacao' => 'Simples Nacional',
            'ncm' => '2202.10.00',
            'cest' => '03.007.00',
            'origem' => '0',
            'cbenef' => 'PR800000',
        ]);

        $response->assertRedirect('/produtos');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('produtos', [
            'tenant_id' => $tenant->id,
            'nome' => 'Coca Cola Lata',
            'sku' => 'COCA-LATA-350',
            'barcode_interno' => '10001',
            'estoque_atual' => 100,
            'preco_venda' => 4.00,
        ]);
    }

    /**
     * Test validation rules for required fields.
     */
    public function test_product_required_fields_validation(): void
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

        // Attempt store with missing fields (nome, barcode_interno, categoria_id, ncm, margem_lucro)
        $response = $this->actingAs($user)->post('/produtos', [
            'nome' => '',
            'barcode_interno' => '',
            'categoria_id' => '',
            'ncm' => '',
            'margem_lucro' => '',
        ]);

        $response->assertSessionHasErrors(['nome', 'barcode_interno', 'categoria_id', 'ncm', 'margem_lucro']);
    }

    /**
     * Test SKU uniqueness per tenant.
     */
    public function test_product_sku_uniqueness_per_tenant(): void
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

        $categoria = Categoria::create([
            'tenant_id' => $tenant->id,
            'nome' => 'Bebidas',
        ]);

        // Create product 1
        Produto::create([
            'tenant_id' => $tenant->id,
            'nome' => 'Coca Cola',
            'sku' => 'COCA-LATA',
            'barcode_interno' => '10001',
            'categoria_id' => $categoria->id,
            'ncm' => '2202.10.00',
        ]);

        // Attempt creating product 2 with same SKU
        $response = $this->actingAs($user)->post('/produtos', [
            'nome' => 'Pepsi Cola',
            'sku' => 'COCA-LATA', // Duplicate SKU
            'barcode_interno' => '10002',
            'categoria_id' => $categoria->id,
            'estoque_inicial' => 10,
            'estoque_minimo' => 2,
            'preco_custo' => 2.00,
            'margem_lucro' => 50,
            'preco_venda' => 3.00,
            'ncm' => '2202.10.00',
        ]);

        $response->assertSessionHasErrors(['sku']);
    }

    /**
     * Test barcode_interno uniqueness per tenant.
     */
    public function test_product_barcode_interno_uniqueness_per_tenant(): void
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

        $categoria = Categoria::create([
            'tenant_id' => $tenant->id,
            'nome' => 'Bebidas',
        ]);

        // Create product 1
        Produto::create([
            'tenant_id' => $tenant->id,
            'nome' => 'Coca Cola',
            'sku' => 'COCA-LATA',
            'barcode_interno' => '10001',
            'categoria_id' => $categoria->id,
            'ncm' => '2202.10.00',
        ]);

        // Attempt creating product 2 with same barcode_interno
        $response = $this->actingAs($user)->post('/produtos', [
            'nome' => 'Pepsi Cola',
            'sku' => 'PEPSI-LATA',
            'barcode_interno' => '10001', // Duplicate Barcode Interno
            'categoria_id' => $categoria->id,
            'estoque_inicial' => 10,
            'estoque_minimo' => 2,
            'preco_custo' => 2.00,
            'margem_lucro' => 50,
            'preco_venda' => 3.00,
            'ncm' => '2202.10.00',
        ]);

        $response->assertSessionHasErrors(['barcode_interno']);
    }

    /**
     * Test product edit view rendering.
     */
    public function test_product_edit_page_can_be_rendered(): void
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

        $categoria = Categoria::create([
            'tenant_id' => $tenant->id,
            'nome' => 'Bebidas',
        ]);

        $produto = Produto::create([
            'tenant_id' => $tenant->id,
            'nome' => 'Coca Cola',
            'sku' => 'COCA-LATA',
            'barcode_interno' => '10001',
            'categoria_id' => $categoria->id,
            'ncm' => '2202.10.00',
        ]);

        $response = $this->actingAs($user)->get("/produtos/{$produto->id}/edit");

        $response->assertStatus(200);
        $response->assertSee('Editar Produto');
        $response->assertSee('COCA-LATA');
    }

    /**
     * Test product can be updated successfully.
     */
    public function test_product_can_be_updated_successfully(): void
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

        $categoria = Categoria::create([
            'tenant_id' => $tenant->id,
            'nome' => 'Bebidas',
        ]);

        $produto = Produto::create([
            'tenant_id' => $tenant->id,
            'nome' => 'Nome Antigo',
            'sku' => 'COCA-LATA',
            'barcode_interno' => '10001',
            'categoria_id' => $categoria->id,
            'ncm' => '2202.10.00',
            'estoque_inicial' => 10,
            'estoque_atual' => 10,
        ]);

        $response = $this->actingAs($user)->put("/produtos/{$produto->id}", [
            'nome' => 'Nome Novo',
            'sku' => 'COCA-LATA', // Same SKU (uniqueness validation should ignore self)
            'barcode_interno' => '10001', // Same Barcode (should ignore self)
            'categoria_id' => $categoria->id,
            'estoque_inicial' => 20, // increased stock initial
            'estoque_minimo' => 5,
            'preco_custo' => 3.00,
            'margem_lucro' => 50,
            'preco_venda' => 4.50,
            'ncm' => '2202.10.00',
        ]);

        $response->assertRedirect('/produtos');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('produtos', [
            'id' => $produto->id,
            'nome' => 'Nome Novo',
            'estoque_inicial' => 20,
            'estoque_atual' => 20, // should adjust by difference (10 to 20) -> new stock = 20
            'preco_venda' => 4.50,
        ]);
    }

    /**
     * Test product deletion.
     */
    public function test_product_can_be_deleted_successfully(): void
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

        $categoria = Categoria::create([
            'tenant_id' => $tenant->id,
            'nome' => 'Bebidas',
        ]);

        $produto = Produto::create([
            'tenant_id' => $tenant->id,
            'nome' => 'Coca Cola',
            'sku' => 'COCA-LATA',
            'barcode_interno' => '10001',
            'categoria_id' => $categoria->id,
            'ncm' => '2202.10.00',
        ]);

        $response = $this->actingAs($user)->delete("/produtos/{$produto->id}");

        $response->assertRedirect('/produtos');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('produtos', [
            'id' => $produto->id,
        ]);
    }

    /**
     * Test multi-tenant isolation of write actions.
     */
    public function test_product_tenant_isolation_on_write_actions(): void
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

        $categoriaA = Categoria::create([
            'tenant_id' => $tenantA->id,
            'nome' => 'Bebidas A',
        ]);

        $produtoA = Produto::create([
            'tenant_id' => $tenantA->id,
            'nome' => 'Produto A',
            'sku' => 'PROD-A',
            'barcode_interno' => '10001',
            'categoria_id' => $categoriaA->id,
            'ncm' => '2202.10.00',
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

        // User B tries to view User A's product edit page -> should 404
        $response = $this->actingAs($userB)->get("/produtos/{$produtoA->id}/edit");
        $response->assertStatus(404);

        // User B tries to update User A's product -> should 404
        $response = $this->actingAs($userB)->put("/produtos/{$produtoA->id}", [
            'nome' => 'Modificado por B',
            'sku' => 'PROD-A',
            'barcode_interno' => '10001',
            'categoria_id' => $categoriaA->id,
            'estoque_inicial' => 10,
            'estoque_minimo' => 2,
            'preco_custo' => 2.00,
            'margem_lucro' => 50,
            'preco_venda' => 3.00,
            'ncm' => '2202.10.00',
        ]);
        $response->assertStatus(404);

        // User B tries to delete User A's product -> should 404
        $response = $this->actingAs($userB)->delete("/produtos/{$produtoA->id}");
        $response->assertStatus(404);
    }
}
