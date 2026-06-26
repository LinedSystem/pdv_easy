<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // Explicitly declare table name
    protected $table = 'categorias';

    protected $fillable = [
        'tenant_id',
        'nome',
    ];

    /**
     * Get the tenant that owns the category.
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
