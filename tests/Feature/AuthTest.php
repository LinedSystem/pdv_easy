<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test registration form rendering.
     */
    public function test_registration_form_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Crie sua conta empresarial');
    }

    /**
     * Test registration validation failures.
     */
    public function test_registration_validation_fails_with_invalid_data(): void
    {
        $response = $this->post('/register', [
            'nome_empresa' => '',
            'cnpj' => '12.345.678/0001-00', // Invalid CNPJ digits
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'short',
            'password_confirmation' => 'mismatch',
        ]);

        $response->assertSessionHasErrors(['nome_empresa', 'cnpj', 'name', 'email', 'password']);
    }

    /**
     * Test registration success.
     */
    public function test_registration_succeeds_with_valid_data(): void
    {
        $response = $this->post('/register', [
            'nome_empresa' => 'Minha Nova Loja',
            'cnpj' => '06.990.590/0001-23', // Valid CNPJ
            'name' => 'Proprietario',
            'email' => 'proprietario@novaloja.com.br',
            'password' => 'Senha123',
            'password_confirmation' => 'Senha123',
        ]);

        // Asserts user is created and authenticated
        $this->assertDatabaseHas('tenants', [
            'nome_empresa' => 'Minha Nova Loja',
            'cnpj' => '06.990.590/0001-23',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Proprietario',
            'email' => 'proprietario@novaloja.com.br',
        ]);

        $user = User::where('email', 'proprietario@novaloja.com.br')->first();
        $this->assertNotNull($user);
        $this->assertAuthenticatedAs($user);

        // Since MustVerifyEmail is implemented, the dashboard request should redirect to the verification notice
        $response->assertRedirect(route('dashboard'));

        $dashboardResponse = $this->actingAs($user)->get('/dashboard');
        $dashboardResponse->assertRedirect(route('verification.notice'));
    }

    /**
     * Test login form rendering.
     */
    public function test_login_form_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Boas-vindas de volta');
    }

    /**
     * Test login validation and authentication success.
     */
    public function test_login_succeeds_with_valid_credentials(): void
    {
        // Setup user
        $tenant = Tenant::create([
            'nome_empresa' => 'Empresa Teste',
            'cnpj' => '06.990.590/0001-23',
        ]);

        $user = User::create([
            'tenant_id' => $tenant->id,
            'name' => 'Usuario Teste',
            'email' => 'teste@empresa.com',
            'password' => Hash::make('Senha123'),
            'email_verified_at' => now(),
        ]);

        // Attempt login
        $response = $this->post('/login', [
            'email' => 'teste@empresa.com',
            'password' => 'Senha123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test login fails with invalid credentials.
     */
    public function test_login_fails_with_invalid_password(): void
    {
        // Setup user
        $tenant = Tenant::create([
            'nome_empresa' => 'Empresa Teste',
            'cnpj' => '06.990.590/0001-23',
        ]);

        User::create([
            'tenant_id' => $tenant->id,
            'name' => 'Usuario Teste',
            'email' => 'teste@empresa.com',
            'password' => Hash::make('Senha123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'teste@empresa.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test logout.
     */
    public function test_user_can_logout(): void
    {
        $tenant = Tenant::create([
            'nome_empresa' => 'Empresa Teste',
            'cnpj' => '06.990.590/0001-23',
        ]);

        $user = User::create([
            'tenant_id' => $tenant->id,
            'name' => 'Usuario Teste',
            'email' => 'teste@empresa.com',
            'password' => Hash::make('Senha123'),
        ]);

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
