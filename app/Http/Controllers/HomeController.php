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

    public function website()
    {
        $website = \App\Website::all();

        return view('website', ['sites' => $website]);
    }

    public function product()
    {
        $product = \App\Product::paginate(10);

        return view('product', ['product' => $product]);
    }

    public function catalogue()
    {
        $model = \App\Catalogue::query()
            ->with('user')
            ->with('product')
            ->with('website')
            ->orderBy('updated_at', 'desc');

        if (request()->ajax()) {
            return Datatables::of($model)->make(true);
        }

        $links = \App\Catalogue::paginate(10);

        return view('catalogue', ['links' => $links]);
    }

    public function journalCatalogue()
    {
        $websites = \App\Website::orderBy('domain', 'asc')->get();
        $products = \App\Product::orderBy('name', 'asc')->get();

        return view('catalogue-journal', ['websites' => $websites, 'products' => $products]);
    }

    public function catalogueUpdate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'url' => 'required|max:255',
                'website_id' => 'required',
                'product_id' => 'required',
                'user_id' => 'required',
            )
        );

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $record = new \App\Catalogue;
        $record->url = $request->url;
        $record->user_id = $request->user_id;
        $record->product_id = $request->product_id;
        $record->website_id = $request->website_id;
        $record->save();

        return redirect('/');
    }
}
