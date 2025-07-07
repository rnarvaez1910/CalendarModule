<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    protected $fillable = ['nombre', 'edad', 'eliminado'];
    protected $casts = [
        'nombre' => 'string',
        'edad' => 'integer',
        'eliminado' => 'boolean'
    ];

    public $timestamps = false;
}
