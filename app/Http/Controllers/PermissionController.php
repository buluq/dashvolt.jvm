<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;

class PermissionController extends Controller
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
        $permissions = Permission::all();

        if (request()->ajax()) {
            return Datatables::of($permissions)
                ->addColumn('action', function (Permission $permission) {
                    $action  = '<div class="btn-group pull-right" role="group">';
                    $action .= '<a href="' . route('permissions.edit', $permission->id) . '" class="btn btn-default btn-sm">Ubah</a>';
                    $action .= '<div class="btn-group" role="group">';
                    $action .= \Form::open(['route' => ['permissions.destroy', $permission->id], 'method' => 'delete']);
                    $action .= \Form::button('Hapus', ['class' => 'btn btn-danger btn-sm', 'type' => 'submit']);
                    $action .= \Form::close();
                    $action .= '</div></div>';

                    return $action;
                })
                ->make(true);
        }

        return view('permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();

        return view('permissions.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = new Permission();

        $this->validate(
            $request,
            array(
                'name' => 'required',
            )
        );

        $name = $request['name'];
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles'])) {
            foreach ($roles as $role) {
                $role_assigned = Role::where('id', '=', $role)->firstOrFail();
                $permission = Permission::where('name', '=', $name)->first();

                $role_assigned->givePermissionTo($permission);
            }
        }

        return redirect()->route('permissions.index')->with('flash_message', 'Perizinan ' . $permission->name . ' sudah ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('permissions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('permissions.edit', compact('permission'));
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
        $permission = Permission::findOrFail($id);

        $this->validate(
            $request,
            array(
                'name' => 'required',
            )
        );

        $input = $request->all();
        $permission->fill($input)->save();

        return redirect()->route('permissions.index')->with('flash_message', 'Perizinan ' . $permission->name . ' sudah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        if ($permission->name == 'Administrasi Sistem') {
            return redirect()->route('permissions.index')->with('flash_message', 'Tidak dapat menghapus perizinan.');
        }

        $permission->delete();

        return redirect()->route('permissions.index')->with('flash_message', 'Perizinan dihapus.');
    }
}
