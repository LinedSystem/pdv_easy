<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    // Explicitly declare table name
    protected $table = 'unidades';

    protected $fillable = [
        'tenant_id',
        'nome',
        'abreviacao',
    ];

    /**
     * Get the tenant that owns the unit.
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
