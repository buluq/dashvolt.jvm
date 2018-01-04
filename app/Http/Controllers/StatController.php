<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'total' => $this->getTotal(),
            'month' => $this->getMonth(),
            'user_total' => $this->getTotal(Auth::id()),
            'user_month' => $this->getMonth(Auth::id()),
        );

        return view('statistic.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getToday()
    {
        $today_count = \App\Catalogue::whereDate('updated_at', date('Y-m-d'))->count();

        return $today_count;
    }

    public function getMonth($user_id = false)
    {
        if ($user_id == false)
        {
            $month_count = \App\Catalogue::whereBetween('updated_at', [date('Y-m', strtotime('first day of last month')) . '-26', date('Y-m') . '-25'])->count();
        }
        else
        {
            $month_count = \App\Catalogue::whereBetween('updated_at', [date('Y-m', strtotime('first day of last month')) . '-26', date('Y-m') . '-25'])->where('user_id', $user_id)->count();
        }

        return $month_count;
    }

    public function getTotal($user_id = false)
    {
        if ($user_id == false)
        {
            $total_count = \App\Catalogue::count();
        }
        else
        {
            $total_count = \App\Catalogue::where('user_id', $user_id)->count();
        }

        return $total_count;
    }
}
