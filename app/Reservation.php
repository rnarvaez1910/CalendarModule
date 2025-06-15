<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['id', 
        'professor_name',
        'professor_email',
        'asignature', 
        'classroom', 
        'assets', 
        'reservation_start', 
        'reservation_end', 
        'approved'];
    protected $table = 'reservations';
    protected $casts = ['id' => 'integer', 
        'professor_name' => 'string', 
        'professor_email' => 'string', 
        'asignature' => 'string', 
        'classroom' => 'string', 
        'assets' => 'string', 
        'reservation_start' => 'datetime', 
        'reservation_end' => 'datetime', 
        'approved' => 'boolean'];
}
