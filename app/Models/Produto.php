<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    // Explicitly declare table name
    protected $table = 'produtos';

    protected $fillable = [
        'tenant_id',
        'nome',
        'sku',
        'barcode',
        'barcode_interno',
        'unidade_id',
        'categoria_id',
        'estoque_inicial',
        'estoque_minimo',
        'estoque_atual',
        'preco_custo',
        'margem_lucro',
        'preco_venda',
        'imagem',
        'tributacao',
        'ncm',
        'cest',
        'origem',
        'cbenef',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'estoque_inicial' => 'float',
            'estoque_minimo' => 'float',
            'estoque_atual' => 'float',
            'preco_custo' => 'float',
            'margem_lucro' => 'float',
            'preco_venda' => 'float',
        ];
    }

    /**
     * Get the tenant that owns the product.
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the category of the product.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Get the unit of the product.
     */
    public function unidade()
    {
        return $this->belongsTo(Unidade::class, 'unidade_id');
    }
}
