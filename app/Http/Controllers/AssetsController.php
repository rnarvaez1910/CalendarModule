<?php

namespace App\Http\Controllers;

use App\Assets;
use App\AssetsReservation;
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
            // $start = $request->query('start');
            // $end = $request->query('end');
    
            $assets = Assets::get();
    
            // $occupied_assets = Assets::with([
            //         'assets_reservation' => function($query) use($start, $end) { 
            //             $query->whereHas('reservation', function($query) use ($start, $end) { 
            //                 $query->whereBetween('reservation_start', [$start, $end])
            //                     ->whereBetween('reservation_end', [$start, $end]);
            //             });
            //         },
            //         'assets_reservation.reservation'
            //     ])
            //     ->whereHas('assets_reservation.reservation', function (Builder $query) use($start, $end) {
            //         $query->whereBetween('reservation_start', [$start, $end])
            //             ->whereBetween('reservation_end', [$start, $end]);
            //     })
            //     ->get();
    
            // $free_assets = Assets::with([
            //         'assets_reservation' => function($query) use($start, $end) { 
            //             $query->whereHas('reservation', function($query) use ($start, $end) { 
            //                 $query->whereBetween('reservation_start', [$start, $end])
            //                     ->whereBetween('reservation_end', [$start, $end]);
            //             });
            //         },
            //         'assets_reservation.reservation'
            //     ])
            //     ->whereHas('assets_reservation.reservation', function (Builder $query) use($start, $end) {
            //         $query->whereBetween('reservation_start', [$start, $end])
            //             ->whereBetween('reservation_end', [$start, $end]);
            //     })
            //     ->whereNotIn('id', $occupied_assets->map(function($asset) { 
            //         return $asset->id;
            //     }))
            //     ->orWhereDoesntHave('assets_reservation.reservation')
            //     ->get();
    
            // $assets = $occupied_assets->concat($free_assets);
    
            return response()->json($assets);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function show(Assets $assets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function edit(Assets $assets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assets $assets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assets $assets)
    {
        
    }
}
