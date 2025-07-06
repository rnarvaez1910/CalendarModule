<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AssetsReservation;

class Reservation extends Model
{
    protected $fillable = ['id', 
        'professor_name',
        'professor_email',
        'asignature', 
        'classroom',
        'reservation_start', 
        'reservation_end', 
        'approved',
        'declined'];
    protected $table = 'reservations';
    protected $casts = ['id' => 'integer', 
        'professor_name' => 'string', 
        'professor_email' => 'string', 
        'asignature' => 'string', 
        'classroom' => 'string',
        'reservation_start' => 'datetime', 
        'reservation_end' => 'datetime', 
        'approved' => 'boolean',
        'declined' => 'boolean'];
    protected $attributes = [
        'approved'=> false,
        'declined'=> false,
    ];

    public function assets_reservation()
    {
        return $this->hasMany(AssetsReservation::class);
    }
}
