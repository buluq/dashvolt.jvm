<?php

namespace App\Http\Controllers;

use Excel;
use \DateTime;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return Datatables::of(Product::query())->make(true);
        }

        return view('product');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
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
                'product' => 'required|max:255',
            )
        );

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $record = new \App\Product;
        $record->name = $request->product;
        $record->save();

        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * Display import file form.
     *
     * @return \Illuminate\Http\Response
     */
    public function importForm()
    {
        return view('product.import');
    }

    public function import(Request $request)
    {
        if ($request->hasFile('import_file') || $request->file('import_file')->isValid()) {
            $path = $request->file('import_file')->getRealPath();
            $row = Excel::load($path, function ($reader) {})->all();

            if (!empty($row) && $row->count()) {
                foreach ($row->toArray() as $key => $cell) {
                    $datetime = new DateTime;

                    $insert[] = array(
                        'name'  => $cell['name'],
                        'title' => $cell['title'],
                        'created_at' => $datetime->format('m-d-y H:i:s'),
                        'updated_at' => $datetime->format('m-d-y H:i:s'),
                    );
                }

                if (!empty($insert)) {
                    Product::insert($insert);
                    return back()->with('success', 'Berhasil.');
                }
            }
        }

        return back()->with('error', 'Please check your file.');
    }

    public function export(Request $request, $type)
    {
        $data = Item::get()->toArray();

        return Excel::create(
            'product_export',
            function ($excel) use ($data) {
                $excel->sheet(
                    'product',
                    function ($sheet) use ($data) {
                        $sheet->fromArray($data);
                    }
                );
            })->download($type);
    }
}
