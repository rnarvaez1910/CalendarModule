<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AssetsReservation;

class Assets extends Model
{
    protected $appends = ['can_reserve'];

    public $timestamps = false;

    public function assets_reservation()
    {
        return $this->hasMany(AssetsReservation::class);
    }

    public function getCanReserveAttribute() { 
        return $this->quantity > $this->assets_reservation->count();
    }
}