@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Daftar Produk</div>

                    <div class="panel-body">
                        <ol>
                            @foreach ($product as $item)
                                <li>{{ $item->name }}</li>
                            @endforeach

                        </ol>

                        {{ $product->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
