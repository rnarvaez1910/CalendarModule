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

    public function verifyClassroom(Request $request)
    {
        try {
            $start = $request->query('start');
            $end = $request->query('end');

            $reservations = Reservation::where(function ($q) use ($start, $end) {
                $q->whereBetween('reservation_start', [$start, $end])
                    ->orWhereBetween('reservation_end', [$start, $end])
                    ->orWhere(function ($subQuery) use ($start, $end) {
                        $subQuery->where('reservation_start', '<=', $start)
                            ->where('reservation_end', '>=', $end);
                    });
            })->get();

            return response()->json($reservations);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error verifying classroom: ' . $e->getMessage()], 500);
        }
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
            $mail->Password = 'iqlxcsnodtqiwlaf';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('rnarvaez.5304@unimar.edu.ve', 'Raymond UNIMAR');
            // $mail->addAddress('raymondnarvaez19@gmail.com', 'Yo')
            $mail->addAddress($reservation->professor_email);
            $mail->isHTML(true);
            $mail->Subject = 'Información sobre su reserva de insumos';

            // Prepara los insumos reservados
            $chainNames = "";
            for ($i = 0; $i < $reservation->assets_reservation->count(); $i++) {
                $chainNames .= $reservation->assets_reservation[$i]->assets->name . ', ';
            }
            $chainNames = rtrim($chainNames, ', ');

            // Formatea la fecha
            $fechaReserva = $reservation->reservation_start->format('Y-m-d H:i:s');

            // Plantilla HTML
            $mail->Body = '
        <div style="background-color:#f4f6f8;padding:20px;font-family:sans-serif;">
            <div style="max-width:550px;margin:0 auto;background:white;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:32px;">
                <h2 style="color:#233269;text-align:center;margin-bottom:8px;">¡Hola!</h2>
                <p style="text-align:center;">Tu reserva de insumos ha sido procesada exitosamente. Aquí tienes los detalles:</p>
                
                <div style="display:flex;justify-content:center;align-items:center;flex-direction:column;margin:30px 0;">
                    <div style="margin-bottom:18px;">
                        <span style="font-weight:bold;font-size:16px; gap: 30px">Insumos reservados:</span><br>
                        <span style="font-size:15px;color:#004680;">' . $chainNames . '</span><br>
                    </div>
                    <div>
                        <span style="font-weight:bold;font-size:16px;">Fecha de la reserva:</span><br>
                        <span style="font-size:15px;color:#004680;">' . $fechaReserva . '</span>
                    </div>
                </div>
                <p style="text-align:center;color:#666;font-size:13px;">Si tienes algún problema, responde a este correo o contacta al administrador.</p>
                <hr style="margin:24px 0;">
                <p style="text-align:center;font-size:11px;color:#bbb;">© ' . date("Y") . ' Universidad de Margarita, Rif: J-30660040-0. Teléfono: 800-UNIMAR (800-864627). Isla de Margarita - Venezuela.</p>
            </div>
        </div>
        ';
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
            $declined = $request->query('declined') == "true";

            $reservationsBuilder = Reservation::with('assets_reservation.assets')
                ->where(function ($query) use ($start, $end) {
                    $query->whereBetween('reservation_start', [$start, $end])
                        ->orWhereBetween('reservation_end', [$start, $end]);
                });

            if ($declined) {
                $reservationsBuilder = $reservationsBuilder->where('declined', true);
            } else {
                $reservationsBuilder = $reservationsBuilder->where('approved', true);
            }

            $reservations = $reservationsBuilder->get();
            return view('reservation_report', compact('reservations', 'declined'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error generating report: ' . $e->getMessage()], 500);
        }
    }
}
