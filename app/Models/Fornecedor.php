<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    // Explicitly declare table name due to Portuguese plural form
    protected $table = 'fornecedores';

    protected $fillable = [
        'tenant_id',
        'tipo_fornecedor',
        'documento',
        'nome',
        'apelido',
        'registro_geral',
        'tipo_contribuinte',
        'ativo',
        'telefone_fixo',
        'telefone_celular',
        'email',
        'cep',
        'logradouro',
        'numero',
        'bairro',
        'complemento',
        'cidade',
        'uf',
        'ibge',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'ativo' => 'boolean',
        ];
    }

    /**
     * Get the tenant that owns the supplier.
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
