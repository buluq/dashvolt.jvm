<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statcontroller = new StatController;

        $query = \App\Catalogue::query()
            ->with('user')
            ->with('product')
            ->with('website');

        if (request()->ajax()) {
            return Datatables::of($query->where('user_id', Auth::id()))->make(true);
        }

        $stats = array(
            'total'   => $statcontroller->getTotal(),
            'monthly' => $statcontroller->getMonth(Auth::id()),
            'lastmonth' => $query
                ->whereMonth('updated_at', date('m', strtotime("first day of previous month")))
                ->whereYear('updated_at', date('Y'))
                ->count(),
            'today' => $statcontroller->getToday(),
        );


        return view('home', ['stats' => $stats]);
    }

    public function profile()
    {
        $user = \App\User::find(Auth::id());

        return redirect(route('user.show', $user->id));
    }
}
