<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.role', compact('roles'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|min:3|unique:roles,name',
        ]);
        
        try {
            $role = new Role();
            $role->name = $request->name;
            $role->save();
            $notification = array(
                'message'=>'New Role Added!',
                'alert-type'=>'success'
            );
            return back()->with($notification);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $action = route('role.update', $role->id);

        return response()->json([
            'role'      => $role,
            'action'    => $action,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id
        ]);
        
        try {
            $role = Role::find($id);
            $role->name = $request->name;
            $role->save();
            $notification = array(
                'message'=>'Role Updated!',
                'alert-type'=>'success'
            );
            return back()->with($notification);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id) 
    {
        Role::find($id)->delete();
        $notification = array(
            'message'=>'Role Delete!',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    public function permissioin($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::orderBy('name', 'asc')->get();
        $role_permissions = $role->permissions->pluck('id')->toArray();
        return view('admin.permission', compact('role', 'permissions', 'role_permissions'));
    }

    public function permissioinAssign($id, Request $request)
    {
        $role = Role::findOrFail($id);

        $role->syncPermissions($request->permission);

        $notification = array(
            'message'=>'Permission Set!',
            'alert-type'=>'success'
        );
        return redirect()->back()->with( $notification);
    }
}
