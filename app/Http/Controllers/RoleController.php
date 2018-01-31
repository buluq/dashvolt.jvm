<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        if (request()->ajax()) {
            return Datatables::of($roles)
                ->addColumn('permissions', function ($roles) {
                    return $roles->permissions()->pluck('name')->implode(", ");
                })
                ->addColumn('action', function (Role $roles) {
                    $action  = '<div class="btn-group pull-right" role="group">';
                    $action .= '<a href="' . route('roles.edit', $roles->id) . '" class="btn btn-default btn-sm">Ubah</a>';
                    $action .= '<div class="btn-group" role="group">';
                    $action .= \Form::open(['route' => ['roles.destroy', $roles->id], 'method' => 'delete']);
                    $action .= \Form::button('Hapus', ['class' => 'btn btn-danger btn-sm', 'type' => 'submit']);
                    $action .= \Form::close();
                    $action .= '</div></div>';

                    return $action;
                })
                ->make(true);
        }

        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();

        $this->validate(
            $request,
            array(
                'name' => 'required|unique:roles',
                'permissions' => 'required',
            )
        );

        $name = $request['name'];
        $role->name = $name;

        $permissions = $request['permissions'];

        $role->save();

        foreach ($permissions as $permission) {
            $permission_assigned = Permission::where('id', '=', $permission)->firstOrFail();
            $role = Role::where('name', '=', $name)->first();
            $role->givePermissionTo($permission_assigned);
        }

        return redirect()->route('roles.index')->with('flash_message', 'Role ' . $role->name . ' ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $this->validate(
            $request,
            array(
                'name' => 'required|unique:roles,name,' . $id,
                'permissions' => 'required',
            )
        );

        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];

        $role->fill($input)->save();

        $all_permission = Permission::all();
        foreach ($all_permission as $permission) {
            $role->revokePermissionTo($permission);
        }

        foreach ($permissions as $permission) {
            $permission_assigned = Permission::where('id', '=', $permission)->firstOrFail();

            $role->givePermissionTo($permission_assigned);
        }

        return redirect()->route('roles.index')->with('flash_message', 'Role ' . $role->name . ' diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role->name == 'Administrator Sistem') {
            return redirect()->route('roles.index')->with('flash_message', 'Tidak dapat menghapus perizinan.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('flash_message', 'Role dihapus.');
    }
}
