<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;
use App\Http\Controllers\array_replace_key;
use App\Models\Asistencia;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClasesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clases = Clase::all();
        $materias = Materia::all();
        $estudiantes = User::role('Estudiante')->with('roles')->get();
        $asistencias = Asistencia::all();

        $user = Auth::user();
        if($user->hasRole('Admin|Director')){
            return view('clase.clases', compact('clases', 'materias', 'estudiantes', 'asistencias'));
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
        //dd($request->all());
        $request->validate([
            'idMateria' => 'required',
            'fecha' => 'required',
            'tema' => 'required',
            'actividad' => 'required',
            'recursos' => 'required',
            'observaciones' => 'required',
            'estrategia' => 'required'
        ]);

        $requestData = $request->all();
        $fileName = time().$request->file('recursos')->getClientOriginalName();
        $path = $request->file('recursos')->storeAs('recursos', $fileName, 'public');
        $requestData["recursos"] = '/storage/'.$path;
        Clase::create($requestData);
    
        return redirect()->route('materias.show', ['materia' => $request->idMateria])->with('status', __('Clase Creada Exitosamente'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clase $clase)
    {
        return view('clase.edit', compact('clase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clase $clase)
    {
        //dd($request->all(), $clase);

        $request->validate([
            'idMateria' => 'required',
            'fecha' => 'required',
            'tema' => 'required',
            'actividad' => 'required',
            'estrategia' => 'required'
        ]);
    
        $requestData = $request->all();
    
        // Verifica si se ha cargado un archivo de recursos
        if ($request->hasFile('recursos')) {
            $fileName = time().$request->file('recursos')->getClientOriginalName();
            $path = $request->file('recursos')->storeAs('recursos', $fileName, 'public');
            $requestData["recursos"] = '/storage/'.$path;
        }
    
        $clase->update($requestData);
    
        return redirect()->route('materias.show', ['materia' => $request->idMateria])->with('status', __('Clase Actualizada Exitosamente'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clase $clase)
    {
        DB::table('asistencias')->where('idClase', $clase->id)->delete();
        $clase->delete();
        return redirect()->route('materias.show', ['materia' => $clase->idMateria])->with('status', __('Clase Eliminada Exitosamente'));
    }
}
