<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class TeacherController extends Controller
{
    /**
     * Busca un profesor por su nombre y lo busca en la tabla por su user_id
     */
    public function searchByName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);

        // Busqueda exacta
        $user = User::where('name', $request->name)->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'user_id' => $user->id,
                'name' => $user->name
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Teacher not found.'
            ], 404);
        }
    }
}
?>