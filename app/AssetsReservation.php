<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reservation;
use App\Assets;

class AssetsReservation extends Model
{

    protected $fillable = ['reservation_id', 'assets_id'];

    protected $table = 'assets_reservations';

    protected $casts = [
        'reservation_id' => 'integer',
        'assets_id' => 'integer',
    ];

    public $timestamps = false;

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function assets()
    {
        return $this->belongsTo(Assets::class);
    }
}
