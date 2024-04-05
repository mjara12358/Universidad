<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;

class ClasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clases = Clase::all();
        return view('clase.clases', compact('clases'));
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
            'materia' => 'required',
            'fecha' => 'required',
            'tema' => 'required',
            'actividad' => 'required'
        ]);

        Clase::create($request->all());
    
        return redirect()->route('clases')->with('status', __('Clase Creada Exitosamente'));
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
        return view('clases.edit', compact('clase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clase $clase)
    {
        $request->validate([
            'materia' => 'required',
            'fecha' => 'required',
            'tema' => 'required',
            'actividad' => 'required'
        ]);
    
        $clase->update($request->all());
    
        return redirect()->route('clases')->with('success', 'Clase actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clase $clase)
    {
        $clase->delete();
        return redirect()->route('clases')->with('success', 'Clase eliminado correctamente');
    }
}
