<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\AssetsReservation;
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
        $reservations = Reservation::with('assets_reservation.assets')->get();
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
            'reservation_start' => 'required|date', 
            'reservation_end' => 'required|date',
            'assets_reservation' => 'array',
            ]);
        $reservation = Reservation::create($reservationInfo);

        foreach ($reservationInfo['assets_reservation'] as $assetId) {
            AssetsReservation::create([
                'reservation_id' => $reservation->id,
                'assets_id' => $assetId
            ]);
        }

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
    public function delete($id)
    {
        Reservation::destroy($id);
        return response()->noContent();
    }

    public function report() { 
        $reservations = Reservation::with('assets_reservation.assets')->get();
        return view('reservation_report', compact('reservations'));
    }
}
