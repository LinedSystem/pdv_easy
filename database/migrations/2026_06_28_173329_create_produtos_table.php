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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->string('nome');
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->string('barcode_interno');
            $table->foreignId('unidade_id')->nullable()->constrained('unidades')->onDelete('set null');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->decimal('estoque_inicial', 12, 3)->default(0);
            $table->decimal('estoque_minimo', 12, 3)->default(0);
            $table->decimal('estoque_atual', 12, 3)->default(0);
            $table->decimal('preco_custo', 12, 2)->default(0);
            $table->decimal('margem_lucro', 5, 2)->default(0);
            $table->decimal('preco_venda', 12, 2)->default(0);
            $table->string('imagem')->nullable();
            $table->string('tributacao')->nullable();
            $table->string('ncm');
            $table->string('cest')->nullable();
            $table->string('origem')->nullable();
            $table->string('cbenef')->nullable();
            $table->timestamps();

            // Unique constraints within the tenant context
            // Note: SKU can be nullable; in database systems, unique nullable allows multiple null values.
            $table->unique(['tenant_id', 'sku']);
            $table->unique(['tenant_id', 'barcode_interno']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
