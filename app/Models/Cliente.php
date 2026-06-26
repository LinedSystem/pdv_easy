<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'tenant_id',
        'tipo_cliente',
        'documento',
        'nome',
        'apelido',
        'registro_geral',
        'tipo_contribuinte',
        'consumidor_final',
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
            'consumidor_final' => 'boolean',
        ];
    }

    /**
     * Get the tenant that owns the client.
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
