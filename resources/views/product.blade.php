@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Daftar Produk</div>

                    <div class="panel-body">
                        <table class="table table-hover" id="product-table">
                            <thead>
                                <tr>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="panel-footer">
                        <div class="btn-group btn-group-justified">
                            <a href="{{ route('product.create') }}" class="btn btn-primary" role="button">Tambahkan produk</a>
                            <a href="{{ route('import_product') }}" class="btn btn-default" role="button">Import data CSV</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('cssinline')
    <style>
        #product-table_length select,
        #product-table_filter input {
            display: inline-block;
            width: inherit;
        }
    </style>
@endsection

@section('jsinline')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#product-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('product.index') !!}',
                columns: [
                    { data: 'name' },
                    { data: 'title' },
                ]
            });
        });


        $(document).ready(function() { $("#product-table_length select, #product-table_filter input").ready().addClass("form-control"); });
    </script>
@endsection
