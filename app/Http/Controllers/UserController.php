<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;

class UserController extends Controller
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
        $users = User::all();

        if (request()->ajax()) {
            return Datatables::of($users)
                ->addColumn('role', function ($users) {
                    return $users->roles()->pluck('name')->implode(', ');
                })
                ->addColumn('action', function (User $user) {
                    $action  = '<div class="btn-group pull-right" role="group">';
                    $action .= '<a href="' . route('staff.edit', $user->id) . '" class="btn btn-default btn-sm">Ubah</a>';
                    $action .= '<div class="btn-group" role="group">';
                    $action .= \Form::open(['route' => ['staff.destroy', $user->id], 'method' => 'delete']);
                    $action .= \Form::button('Hapus', ['class' => 'btn btn-danger btn-sm', 'type' => 'submit']);
                    $action .= \Form::close();
                    $action .= '</div></div>';

                    return $action;
                })
                ->make(true);
        }

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();

        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            array(
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'status' => 'required',
            )
        );

        $user = User::create($request->only('email', 'name', 'password', 'status'));
        $roles = $request['roles'];

        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_assigned = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_assigned);
            }
        }

        return redirect()->route('staff.index')->with('flash_message', 'Pengguna sudah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('staff');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();

        return view('users.edit', compact('user', 'roles'));

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
        $user = User::findOrFail($id);

        $this->validate(
            $request,
            array(
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'status' => 'required',
            )
        );

        $input = $request->only(['name', 'email', 'status']);
        $roles = $request['roles'];

        $user->fill($input)->save();

        if (isset($roles)) {
            $user->roles()->sync($roles);
        }
        else {
            $user->roles()->detach();
        }

        return redirect()->route('staff.index')->with('flash_message', 'Pengguna berhasil disunting.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->name == 'Administrator Sistem') {
            return redirect()->route('staff.index')->with('flash_message', 'Tidak dapat menghapus pengguna.');
        }

        $user->delete();

        return redirect()->route('staff.index')->with('flash_message', 'Pengguna sudah dihapuskan.');
    }
}
