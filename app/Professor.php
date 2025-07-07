<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $fillable = ['id',
    'professor_name',
    'professor_email'];
    protected $table = 'professors';
    protected $casts = ['id' => 'integer', 
        'professor_name' => 'string', 
        'professor_email' => 'string'];
}
