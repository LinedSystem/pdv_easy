<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->string('tipo_cliente', 2); // PF or PJ
            $table->string('documento', 20); // CPF or CNPJ
            $table->string('nome'); // Name or Razão Social
            $table->string('apelido')->nullable(); // Apelido or Nome Fantasia
            $table->string('registro_geral')->nullable(); // RG or Inscrição Estadual
            $table->string('tipo_contribuinte')->default('não_contribuinte');
            $table->boolean('consumidor_final')->default(true);
            $table->string('telefone_fixo')->nullable();
            $table->string('telefone_celular')->nullable();
            $table->string('email');
            $table->string('cep', 9);
            $table->string('logradouro');
            $table->string('numero', 10);
            $table->string('bairro')->nullable();
            $table->string('complemento')->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('ibge')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
