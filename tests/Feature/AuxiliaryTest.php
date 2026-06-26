<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Unidade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuxiliaryTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Tenant $tenant;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tenant = Tenant::create([
            'nome_empresa' => 'Empresa Teste',
            'cnpj' => '06.990.590/0001-23',
        ]);

        $this->user = User::create([
            'tenant_id' => $this->tenant->id,
            'name' => 'Usuario Teste',
            'email' => 'teste@empresa.com',
            'password' => bcrypt('Senha123'),
        ]);
        $this->user->email_verified_at = now();
        $this->user->save();
    }

    /**
     * Test categories page renders.
     */
    public function test_categorias_page_can_be_rendered(): void
    {
        $response = $this->actingAs($this->user)->get('/categorias');

        $response->assertStatus(200);
        $response->assertSee('Auxiliares: Categorias');
        $response->assertSee('Cadastrar Categoria');
        $response->assertSee('Nenhuma categoria cadastrada ainda');
    }

    /**
     * Test units page renders.
     */
    public function test_unidades_page_can_be_rendered(): void
    {
        $response = $this->actingAs($this->user)->get('/unidades');

        $response->assertStatus(200);
        $response->assertSee('Auxiliares: Unidades de Medida');
        $response->assertSee('Cadastrar Unidade');
        $response->assertSee('Nenhuma unidade cadastrada ainda');
    }

    /**
     * Test creating a category.
     */
    public function test_categoria_can_be_stored(): void
    {
        $response = $this->actingAs($this->user)->post('/categorias', [
            'nome' => 'Bebidas',
        ]);

        $response->assertRedirect('/categorias');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('categorias', [
            'tenant_id' => $this->tenant->id,
            'nome' => 'Bebidas',
        ]);
    }

    /**
     * Test duplicate category name per tenant is rejected.
     */
    public function test_categoria_duplicate_name_per_tenant_is_rejected(): void
    {
        Categoria::create([
            'tenant_id' => $this->tenant->id,
            'nome' => 'Bebidas',
        ]);

        $response = $this->actingAs($this->user)->post('/categorias', [
            'nome' => 'Bebidas',
        ]);

        $response->assertSessionHasErrors(['nome']);
    }

    /**
     * Test updating a category.
     */
    public function test_categoria_can_be_updated(): void
    {
        $categoria = Categoria::create([
            'tenant_id' => $this->tenant->id,
            'nome' => 'Bebidas',
        ]);

        $response = $this->actingAs($this->user)->put("/categorias/{$categoria->id}", [
            'nome' => 'Bebidas Geladas',
        ]);

        $response->assertRedirect('/categorias');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('categorias', [
            'id' => $categoria->id,
            'nome' => 'Bebidas Geladas',
        ]);
    }

    /**
     * Test deleting a category.
     */
    public function test_categoria_can_be_deleted(): void
    {
        $categoria = Categoria::create([
            'tenant_id' => $this->tenant->id,
            'nome' => 'Bebidas',
        ]);

        $response = $this->actingAs($this->user)->delete("/categorias/{$categoria->id}");

        $response->assertRedirect('/categorias');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('categorias', [
            'id' => $categoria->id,
        ]);
    }

    /**
     * Test creating a unit.
     */
    public function test_unidade_can_be_stored(): void
    {
        $response = $this->actingAs($this->user)->post('/unidades', [
            'nome' => 'Quilograma',
            'abreviacao' => 'KG',
        ]);

        $response->assertRedirect('/unidades');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('unidades', [
            'tenant_id' => $this->tenant->id,
            'nome' => 'Quilograma',
            'abreviacao' => 'KG',
        ]);
    }

    /**
     * Test duplicate unit abbreviation per tenant is rejected.
     */
    public function test_unidade_duplicate_abbreviation_per_tenant_is_rejected(): void
    {
        Unidade::create([
            'tenant_id' => $this->tenant->id,
            'nome' => 'Quilograma',
            'abreviacao' => 'KG',
        ]);

        $response = $this->actingAs($this->user)->post('/unidades', [
            'nome' => 'Kilo',
            'abreviacao' => 'KG',
        ]);

        $response->assertSessionHasErrors(['abreviacao']);
    }

    /**
     * Test updating a unit.
     */
    public function test_unidade_can_be_updated(): void
    {
        $unidade = Unidade::create([
            'tenant_id' => $this->tenant->id,
            'nome' => 'Quilograma',
            'abreviacao' => 'KG',
        ]);

        $response = $this->actingAs($this->user)->put("/unidades/{$unidade->id}", [
            'nome' => 'Quilo',
            'abreviacao' => 'KG',
        ]);

        $response->assertRedirect('/unidades');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('unidades', [
            'id' => $unidade->id,
            'nome' => 'Quilo',
            'abreviacao' => 'KG',
        ]);
    }

    /**
     * Test deleting a unit.
     */
    public function test_unidade_can_be_deleted(): void
    {
        $unidade = Unidade::create([
            'tenant_id' => $this->tenant->id,
            'nome' => 'Quilograma',
            'abreviacao' => 'KG',
        ]);

        $response = $this->actingAs($this->user)->delete("/unidades/{$unidade->id}");

        $response->assertRedirect('/unidades');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('unidades', [
            'id' => $unidade->id,
        ]);
    }

    /**
     * Test tenant isolation for categories and units.
     */
    public function test_tenant_isolation_for_auxiliaries(): void
    {
        // Another tenant
        $tenantB = Tenant::create([
            'nome_empresa' => 'Outra Empresa',
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

        // Create resource for tenant B
        $categoriaB = Categoria::create([
            'tenant_id' => $tenantB->id,
            'nome' => 'Categoria Exclusiva B',
        ]);

        $unidadeB = Unidade::create([
            'tenant_id' => $tenantB->id,
            'nome' => 'Unidade Exclusiva B',
            'abreviacao' => 'UNB',
        ]);

        // User A list should not see B's resources
        $response = $this->actingAs($this->user)->get('/categorias');
        $response->assertDontSee('Categoria Exclusiva B');

        $response = $this->actingAs($this->user)->get('/unidades');
        $response->assertDontSee('Unidade Exclusiva B');

        // User A should get 404 when trying to update/delete B's resources
        $response = $this->actingAs($this->user)->put("/categorias/{$categoriaB->id}", [
            'nome' => 'Tentativa de Fraude',
        ]);
        $response->assertStatus(404);

        $response = $this->actingAs($this->user)->delete("/unidades/{$unidadeB->id}");
        $response->assertStatus(404);
    }
}
