<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AssetsReservation;

class Assets extends Model
{
    protected $fillable = [
        'id',
        'name',
        'serial'
    ];
    protected $table = 'assets';
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'serial' => 'string'
    ];

    protected $appends = ['can_reserve'];

    public $timestamps = false;

    public function assets_reservation()
    {
        return $this->hasMany(AssetsReservation::class);
    }

    public function getCanReserveAttribute()
    {
        return $this->assets_reservation->count() == 0;
    }
}