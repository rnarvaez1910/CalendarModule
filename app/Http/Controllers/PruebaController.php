<?php

namespace App\Http\Controllers;

use App\Prueba;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findAll()
    {
        $prueba = Prueba::all();
        return response()->json($prueba);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $json = $request->validate([
                'nombre' => 'required',
                'eliminado' => 'sometimes|boolean',
                'edad' => 'required'
            ]);

            $entidad = Prueba::create($json);
            return response()->json($entidad);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating prueba: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        try {
            $json = $request->validate([
                'id' => 'required|integer',
                'nombre' => 'required',
                'eliminado' => 'sometimes|boolean',
                'edad' => 'required'
            ]);

            $prueba = Prueba::update($json);
            return response()->json($prueba);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating prueba: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prueba  $prueba
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Prueba::destroy($id);
            return response()->noContent();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating prueba: ' . $e->getMessage()], 500);
        }
    }
}
