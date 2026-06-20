<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = Tenant::create([
            'nome_empresa' => 'Minha Loja Facil LTDA',
            'cnpj' => '12.345.678/0001-99',
        ]);

        User::create([
            'tenant_id' => $tenant->id,
            'name' => 'Administrador',
            'email' => 'admin@easydb.com',
            'password' => Hash::make('senha123'),
            'email_verified_at' => now(), // Pre-verified so it can bypass verification in dashboard
        ]);
    }
}
