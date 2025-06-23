<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AssetsReservation;

class Assets extends Model
{
    public function assets_reservation()
    {
        return $this->hasMany(AssetsReservation::class);
    }
}
