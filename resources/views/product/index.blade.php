@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @component('components.datatable-panel')
                    @slot('panel_class')
                        panel-primary
                    @endslot

                    @slot('panel_title')
                        Daftar Produk
                    @endslot

                    @slot('table_id')
                        product-table
                    @endslot

                    @slot('table_headers')
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                    @endslot

                    @slot('panel_actions')
                        <div class="btn-group btn-group-justified">
                            <a href="{{ route('product.create') }}" class="btn btn-primary" role="button">Tambahkan produk</a>
                            <a href="{{ route('import_product') }}" class="btn btn-default" role="button">Import data CSV</a>
                        </div>
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection

@push('javascripts')
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
    </script>
@endpush
