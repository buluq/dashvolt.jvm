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
        $posts = \App\Catalogue::whereHas('user', function ($query) { $query->where('user_id', 'like', Auth::id()); })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        $stats = \App\Catalogue::query()
            ->with('user')
            ->with('product')
            ->with('website');

        $total = array(
            'total'   => $stats->where('user_id', Auth::id())->count(),
            'monthly' => $stats
                ->whereMonth('updated_at', date('m'))
                ->whereYear('updated_at', date('Y'))
                ->count(),
        );

        return view('home', ['posts' => $posts, 'quantity' => $total]);
    }
}
