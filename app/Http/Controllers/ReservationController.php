<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation; // Si tu modelo se llama Reservation.php en app/

class ReservationController extends Controller
{
    /**
     * Guarda una nueva reserva.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'aula' => 'nullable|integer|min:1|max:47',
            'aula_especial' => 'nullable|string|max:25',
            'videobeam' => 'boolean',
            'laptop' => 'boolean',
            'extension' => 'boolean',
            'adaptador' => 'boolean',
        ]);

        // Crear la reserva
        $reserva = Reservation::create([
            'fechaReserva' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'aula' => $request->aula,
            'aula_especial' => $request->aula_especial,
            'videobeam' => $request->videobeam ?? false,
            'laptop' => $request->laptop ?? false,
            'extension' => $request->extension ?? false,
            'adaptador' => $request->adaptador ?? false,
        ]);

        return response()->json([
            'success' => true,
            'reserva' => $reserva
        ], 201);
    }
}
?>