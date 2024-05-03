<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Permission as ContractsPermission;
use Spatie\Permission\Models\Permission;

class PermisosController extends Controller
{
    public function index(){

        $user = Auth::user();
        if($user->hasRole('Admin')){
            return view('seguridad.permisos', [
                'permisos' => Permission::all()
            ]);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);

        Permission::create($request->all());
    
        return redirect()->route('permisos.index')->with('status', __('Permiso Creado Exitosamente'));
    }

    public function update(Request $request, Permission $permiso) {

        $request->validate([
            'name' => 'required'
        ]);
    
        $permiso->update($request->all());

        return redirect()->route('permisos.index')->with('status', 'Permiso Actualizado Correctamente');
    }

    public function destroy($id){
        DB::table('permissions')->where('id', $id)->delete();
        return redirect()->route('permisos.index')->with('status', 'Permiso Eliminado Correctamente');
    }
}
