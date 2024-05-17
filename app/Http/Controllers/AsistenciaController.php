<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\User;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asistencias = Asistencia::all();
        $estudiantes = User::role('Estudiante')->with('roles')->get();

        return view('asistencia.index', compact('asistencias', 'estudiantes'));
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
        // dd($request->all());
        $request->validate([
            'idClase' => 'required',
            'estado.*' => 'required', // El '*' indica que todos los elementos del array son requeridos
            'idEstudiante.*' => 'required', // El '*' indica que todos los elementos del array son requeridos
        ]);

        // Si el array idAsistencia tiene algún valor diferente a "null", redirige al método update
        if (!empty(array_filter($request->idAsistencia, function($value) {
            return $value !== null;
        }))) {
            return $this->update($request, Asistencia::findOrFail($request->idAsistencia[0]));
        }
    
        // Recorre los arreglos 'estado' y 'idEstudiante' para crear una entrada de asistencia para cada estudiante
        foreach ($request->idEstudiante as $key => $idEstudiante) {
            Asistencia::create([
                'idClase' => $request->idClase,
                'estado' => $request->estado[$key],
                'idEstudiante' => $idEstudiante,
            ]);
        }

        return redirect()->route('materias.show', ['materia' => $request->idMateria])->with('status', __('Asistencia Registrada Exitosamente'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Asistencia $asistencia)
    {
        return view('asistencia.show', compact('asistencia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asistencia $asistencia)
    {
        return view('asistencia.edit', compact('asistencia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        //dd($request->all());
        $request->validate([
            'idClase' => 'required',
            'estado.*' => 'required', // El '*' indica que todos los elementos del array son requeridos
            'idEstudiante.*' => 'required', // El '*' indica que todos los elementos del array son requeridos
        ]);
    
        // Verifica si hay múltiples asistencias para actualizar
        if ($request->has('idAsistencia') && !is_array($request->idClase)) {
            foreach ($request->idAsistencia as $key => $idAsistencia) {
                // Busca y actualiza cada asistencia individualmente
                $asistencia = Asistencia::findOrFail($idAsistencia);
                $asistencia->update([
                    'idClase' => $request->idClase,
                    'estado' => $request->estado[$key],
                    'idEstudiante' => $request->idEstudiante[$key],
                ]);
            }
        } elseif ($request->has('idAsistencia') && !is_array($request->idEstudiante)) {
            // Si solo se proporciona un idEstudiante, actualiza todas las asistencias con ese mismo idEstudiante
            foreach ($request->idAsistencia as $key => $idAsistencia) {
                // Busca y actualiza cada asistencia individualmente
                $asistencia = Asistencia::findOrFail($idAsistencia);
                $asistencia->update([
                    'idClase' => $request->idClase[$key],
                    'estado' => $request->estado[$key],
                    'idEstudiante' => $request->idEstudiante,
                ]);
            }
        } else {
            // Si no hay múltiples asistencias para actualizar, actualiza la única asistencia provista
            $asistencia->update([
                'idClase' => $request->idClase,
                'estado' => $request->estado,
                'idEstudiante' => $request->idEstudiante,
            ]);
        }

        return redirect()->route('materias.show', ['materia' => $request->idMateria])->with('status', __('Asistencia actualizada Exitosamente'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asistencia $asistencia)
    {
        $asistencia->delete();
        return redirect()->route('asistencia.index')->with('status', 'Asistencia eliminada correctamente');
    }
}
