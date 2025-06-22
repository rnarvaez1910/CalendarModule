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
        'video_beam',
        'cable_hdmi',
        'laptop',
        'electrical_extension',
        'adapter',
        'reservation_start', 
        'reservation_end', 
        'approved'];
    protected $table = 'reservations';
    protected $casts = ['id' => 'integer', 
        'professor_name' => 'string', 
        'professor_email' => 'string', 
        'asignature' => 'string', 
        'classroom' => 'string', 
        'video_beam' => 'boolean',
        'cable_hdmi' => 'boolean',
        'laptop' => 'boolean',
        'electrical_extension' => 'boolean',
        'adapter' => 'boolean',
        'reservation_start' => 'datetime', 
        'reservation_end' => 'datetime', 
        'approved' => 'boolean'];
    protected $attributes = [
        'approved'=> false,
    ];
}
