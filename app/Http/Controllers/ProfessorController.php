<?php

namespace App\Http\Controllers;

use App\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfessors(Request $request) {
        try {
            $professor = Professor::get();
            return response()->json($professor);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error getting professor: ' . $e->getMessage()], 500);
        }
        
    }


}
