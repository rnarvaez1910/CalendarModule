<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'fechaReserva',
        'hora_inicio',
        'hora_fin',
        'aula',
        'aula_especial',
        'videobeam',
        'laptop',
        'extension',
        'adaptador'
    ];
}
?>