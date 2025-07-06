<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\AssetsReservation;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findAll(Request $request)
    {
        try {
            $start = $request->query('start');
            $end = $request->query('end');

            $reservations = Reservation::with('assets_reservation.assets')
                ->whereBetween('reservation_start', [$start, $end])
                ->orWhereBetween('reservation_end', [$start, $end])
                ->get();
            
            return response()->json($reservations);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving reservations: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $reservationInfo = $request->validate(['professor_name' => 'required|string', 'professor_email' => 'required|email', 'asignature' => 'required|string', 'classroom' => 'required|string', 'reservation_start' => 'required|date', 'reservation_end' => 'required|date', 'assets_reservation' => 'array']);
        $reservation = Reservation::create($reservationInfo);

        foreach ($reservationInfo['assets_reservation'] as $assetId) {
            AssetsReservation::create([
                'reservation_id' => $reservation->id,
                'assets_id' => $assetId,
            ]);
        }

        return response()->json($reservation, 201);
    }

    public function verify($id)
    {
        try {
            $reservation = Reservation::with("assets_reservation.assets")->find($id);
            $reservation->approved = true;
            $reservation->save();

            $mail = new PHPMailer(true);
            $mail->CharSet = "UTF-8";
            
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true; 
            $mail->Username = 'rnarvaez.5304@unimar.edu.ve'; 
            $mail->Password = 'zivhihopqeakubhk'; 
            $mail->SMTPSecure = 'ssl'; 
            $mail->Port = 465; 
            
            $mail->setFrom('rnarvaez.5304@unimar.edu.ve', 'Raymond UNIMAR');
            // $mail->addAddress('raymondnarvaez19@gmail.com', 'Yo')
            $mail->addAddress($reservation->professor_email);
            $mail->isHTML(true);
            $mail->Subject = 'Información sobre su reserva de insumos';
            $chainNames = "";
            for ($i = 0; $i < $reservation->assets_reservation->count(); $i++) {
                $chainNames .= $reservation->assets_reservation[$i]->assets->name . ', ';
            }
            $chainNames = rtrim($chainNames, ', ');
            $mail->Body = 'Su reserva de ' . $chainNames . ', para el día ' . $reservation->reservation_start->format('Y-m-d H:i:s') . ', ha sido aprobada.';
            $mail->send();
            return response()->json(['message' => 'Reservation verified and email sent successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving reservations: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $reservation = Reservation::find($id);
            
            if (!$reservation) {
                return response()->json(['error' => 'Reservation not found'], 404);
            }

            $validatedData = $request->validate([
                'id' => 'required|integer',
                'professor_name' => 'required|string',
                'professor_email' => 'required|email',
                'asignature' => 'required|string',
                'classroom' => 'required|string',
                'reservation_start' => 'required|date',
                'reservation_end' => 'required|date',
                'assets_reservation' => 'array'
            ]);

            $assetsReservation = $validatedData['assets_reservation'] ?? [];
            unset($validatedData['assets_reservation']);

            $reservation->assets_reservation()->delete();

            $reservation->update($validatedData);

            if (!empty($assetsReservation)) {
                foreach ($assetsReservation as $assetId) {
                    echo "Asset ID: $assetId\n";
                    AssetsReservation::firstOrCreate([
                        'reservation_id' => $reservation->id,
                        'assets_id' => $assetId,
                    ]);
                }
            }

            return response()->json("hola", 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating reservation: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $reservation = Reservation::with("assets_reservation.assets")->find($id);
        $reservation->declined = true;
        $reservation->save();
        return response()->noContent();
    }

    public function report(Request $request)
    {
        try { 
            $start = $request->query('start');
            $end = $request->query('end');

            $reservations = Reservation::with('assets_reservation.assets')
                ->where(function ($query) use($start, $end) { 
                    $query->whereBetween('reservation_start', [$start, $end])
                    ->orWhereBetween('reservation_end', [$start, $end]);
                })
                ->where('approved', true)
                ->get();
            return view('reservation_report', compact('reservations'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error generating report: ' . $e->getMessage()], 500);
        }
    }
}
