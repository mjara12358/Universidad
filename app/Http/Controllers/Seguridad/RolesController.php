<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{

    public function index(){
        $roles = Role::with('permissions')->get();
        $permisos = Permission::all();

        $user = Auth::user();
        if($user->hasRole('Admin')){
            return view('Seguridad.roles', compact('roles', 'permisos'));
        }else{
            return redirect()->route('dashboard');
        }

        // return view('Seguridad.roles', [
        //     'roles' => Role::select('id','name')->with('permissions')->orderByDesc('id')->paginate(10)
        // ]);
    }

    public function ver(){
        $roles = Role::select('id','name')->with('permissions')->orderByDesc('id')->get();

        return $roles;
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'permissions' => 'array'
        ]);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);
    
        return redirect()->route('roles.index')->with('status', __('Rol Creado Exitosamente'));
    }

    public function update(Request $request, Role $role) {

        $request->validate([
            'name' => 'required',
            'permissions' => 'array'
        ]);
    
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('status', 'Rol Actualizado Correctamente');
    }

    public function destroy($id){
        DB::table('roles')->where('id', $id)->delete();
        return redirect()->route('roles.index')->with('status', 'Rol Eliminado Correctamente');
    }
}
