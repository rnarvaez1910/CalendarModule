<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findAll()
    {
        $reservations = Reservation::all();
        return response()->json($reservations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $reservationInfo = $request->validate(['professor_name' => 'required|string',
            'professor_email' => 'required|email',
            'asignature' => 'required|string',
            'classroom' => 'required|string', 
            'video_beam' => 'required|boolean', 
            'cable_hdmi' => 'required|boolean',
            'laptop' => 'required|boolean',
            'electrical_extension' => 'required|boolean',
            'adapter' => 'required|boolean',
            'reservation_start' => 'required|date', 
            'reservation_end' => 'required|date',
            ]);
        $reservation = Reservation::create($reservationInfo);
        return response()->json($reservation, 201);
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function delete(Reservation $reservation)
    {
        //
    }
}
