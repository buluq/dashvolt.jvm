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
        $query = \App\Catalogue::query()
            ->with('user')
            ->with('product')
            ->with('website');

        if (request()->ajax()) {
            return Datatables::of($query->where('user_id', Auth::id()))->make(true);
        }

        $stats = array(
            'total'   => $query->where('user_id', Auth::id())->count(),
            'monthly' => $query
                ->whereMonth('updated_at', date('m'))
                ->whereYear('updated_at', date('Y'))
                ->count(),
            'lastmonth' => $query
                ->whereMonth('updated_at', date('m', strtotime("first day of previous month")))
                ->whereYear('updated_at', date('Y'))
                ->count(),
        );


        return view('home', ['stats' => $stats]);
    }
}
