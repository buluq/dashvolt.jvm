<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$users = \App\User::query();

		$request->user()->authorizeRoles(['sysadmin']);

		if (request()->ajax()) {
            return Datatables::of($users)
                ->addColumn('edit', function($user) {
                    return '<a href="' . route('user.edit', $user->id) . '" class="btn btn-warning btn-block" role="button">Edit</a>';
                })
                ->addcolumn('show', function($user) {
                    return '<a href="' . route('user.show', $user->id) . '" class="btn btn-primary btn-block" role="button">Lihat</a>';
                })
                ->rawColumns(['edit', 'show'])
                ->make(true);
		}

		return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'name'     => 'required',
                'email'    => 'required',
                'password' => 'required',
                'status'   => 'required',
            )
        );

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $record = new \App\User;

        if ($record->where('email', $request->email)->count() > 0) {
            return back()->with('error', 'Email sudah terdaftar.');
        }

        $record->name     = $request->name;
        $record->email    = $request->email;
        $record->password = bcrypt($request->password);
        $record->status   = $request->status;
        $record->save();

        return redirect('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\User::find($id);

        return view('user.show', compact('user', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::find($id);

        return view('user.edit', compact('user', 'id'));
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
        $user = \App\User::find($id);

        $user->name     = $request->get('name');
        $user->email    = $request->get('email');
        if ($user->password !== $request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }
        $user->status   = $request->get('status');
        $user->save();

        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::find($id);

        $user->delete();

        return redirect(route('user.index'));
    }
}
