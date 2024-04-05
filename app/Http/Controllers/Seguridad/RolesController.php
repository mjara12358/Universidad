<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{

    public function index(){
        $roles = Role::select('id','name')->with('permissions')->orderByDesc('id')->get();

        return view('Seguridad.roles', [
            'roles' => Role::select('id','name')->with('permissions')->orderByDesc('id')->paginate(10)
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);

        Role::create($request->all());
    
        return redirect()->route('roles')->with('status', __('Rol Creado Exitosamente'));
    }

    public function update(Request $request, Role $rol) {
    
    }

    public function destroy($id){
        DB::table('roles')->where('id', $id)->delete();
        return redirect()->route('roles')->with('success', 'Rol eliminado correctamente');
    }
}
