<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reservation;
use App\Assets;

class AssetsReservation extends Model
{
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function asset()
    {
        return $this->belongsTo(Assets::class);
    }
}
