<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = \App\Catalogue::query()
            ->with('user')
            ->with('product')
            ->with('website');

        if (request()->ajax()) {
            return Datatables::of($model)->make(true);
        }

        return view('catalogue.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $websites = \App\Website::orderBy('domain', 'asc')->get();
        $products = \App\Product::orderBy('name', 'asc')->get();

        return view('catalogue.create', ['websites' => $websites, 'products' => $products]);
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
                'url'        => 'required|max:255',
                'website_id' => 'required',
                'product_id' => 'required',
                'user_id'    => 'required',
            )
        );

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $record             = new \App\Catalogue;

        if ($record->where('url', $request->url)->count() > 0) {
            return back()->with('error', 'Double input. Please check your input.');
        }

        $record->url        = $request->url;
        $record->user_id    = $request->user_id;
        $record->product_id = $request->product_id;
        $record->website_id = $request->website_id;
        $record->save();

        return redirect('/');
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
}
