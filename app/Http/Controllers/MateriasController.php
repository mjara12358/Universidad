<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\clase;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class MateriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materias = Materia::all();
        $profesores = User::role('Docente')->with('roles')->get();

        $user = Auth::user();
        if($user->hasRole('Admin')){
            return view('materia.materias', compact('materias', 'profesores'));
        }else{
            return redirect()->route('dashboard');
        } 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'semestre' => 'required',
            'creditos' => 'required',
            'idProfesor' => 'required',
        ]);

        Materia::create($request->all());

        return redirect()->route('materias.index')->with('status', __('Materia creada exitosamente'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $materias = Materia::all();
        $materia = Materia::findOrFail($id);
        $clases = Clase::where('idMateria', $materia->id)->get();
        $asistencias = Asistencia::whereIn('idClase', $clases->pluck('id'))->get();
        // dd($asistencias->all());
        $estudiantes = User::role('Estudiante')->with('roles')->get();

        return view('materia.materia', compact('clases', 'materias', 'materia', 'asistencias', 'estudiantes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materia $materia)
    {
        return view('materia.edit', compact('materia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'nombre' => 'required',
            'semestre' => 'required',
            'creditos' => 'required',
            'idProfesor' => 'required',
        ]);

        $materia->update($request->all());

        return redirect()->route('materias.index')->with('status', 'Materia actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materia $materia)
    {
        // Obtener todas las clases relacionadas con la materia
        $clases = Clase::where('idMateria', $materia->id)->get();

        // Eliminar todas las clases relacionadas con la materia
        foreach ($clases as $clase) {
            DB::table('asistencias')->where('idClase', $clase->id)->delete();
            $clase->delete();
        }

        $materia->delete();
        return redirect()->route('materias.index')->with('status', 'Materia eliminada correctamente');
    }
}
