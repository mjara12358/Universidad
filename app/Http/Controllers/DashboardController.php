<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario tiene el rol de "Docente"
        if ($user->hasRole('Docente')) {
            // Obtener las materias vinculadas al docente
            $materias = Materia::where('idProfesor', $user->id)->get();
        } else {
            // Si el usuario tiene otro rol, obtener todas las materias
            $materias = Materia::all();
        }

        return view('dashboard', ['materias' => $materias]);
    }
}