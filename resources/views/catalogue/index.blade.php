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
                        Daftar Katalog Online
                    @endslot

                    @slot('table_id')
                        catalogue-table
                    @endslot

                    @slot('table_headers')
                        <th>URL</th>
                        <th>Produk</th>
                        <th>Website</th>
                        <th>Penulis</th>
                        <th>Pembaruan</th>
                    @endslot

                    @slot('panel_actions')
                        <a href="{{ route('catalogue.create') }}" class="btn btn-block btn-primary" role="button">Kirim pos katalog</a>
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection

@push('javascripts')
    <script>
        $(function() {
            $('#catalogue-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('catalogue.index') }}',
                columns: [
                    { data: 'url' },
                    { data: 'product.name' },
                    { data: 'website.domain' },
                    { data: 'user.name' },
                    { data: 'updated_at' },
                ]
            });
        });
    </script>
@endpush
