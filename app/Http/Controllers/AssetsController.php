<?php

namespace App\Http\Controllers;

use App\Assets;
use App\AssetsReservation;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findAllAssets(Request $request)
    {
        try {
            $assets = Assets::get();
            return response()->json($assets);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function verifyAvailability($id, Request $request)
    {
        try {
            $start = $request->query('start');
            $end = $request->query('end');

            // Buscar el asset por ID con las assets_reservation filtradas por fecha
            $asset = Assets::with([
                'assets_reservation' => function ($query) use ($start, $end) {
                    $query->whereHas('reservation', function ($reservationQuery) use ($start, $end) {
                        $reservationQuery->where(function ($dateQuery) use ($start, $end) {
                            $dateQuery
                                ->whereBetween('reservation_start', [$start, $end])
                                ->orWhereBetween('reservation_end', [$start, $end])
                                ->orWhere(function ($subQuery) use ($start, $end) {
                                    $subQuery->where('reservation_start', '<=', $start)->where('reservation_end', '>=', $end);
                                });
                        });
                    });
                },
                'assets_reservation.reservation',
            ])->find($id);

            if (!$asset) {
                return response()->json(['error' => 'Asset not found'], 404);
            }

            $reservations = $asset->assets_reservation->map(function ($assets_reservation) {
                return $assets_reservation->reservation;
            });

            // Crear el resultado con el asset y sus reservas
            $result = [
                'asset' => $asset,
                'reservations' => $reservations,
            ];

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $json = $request->validate([
                'name' => 'required|string',
                'serial' => 'required|string',
                'quantity' => 'required|integer',
            ]);
            $assets = Assets::create($json);
            return response()->json($assets);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating asset: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Assets::destroy($id);
            return response()->noContent();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating assets: ' . $e->getMessage()], 500);
        }
    }
}
