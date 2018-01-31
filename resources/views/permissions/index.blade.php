{{-- \resources\views\permissions\index.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @component('components.panel-datatable')
                    @slot('panel_class')
                        panel-primary
                    @endslot

                    @slot('panel_title')
                        Daftar Perizinan Pengguna
                    @endslot

                    @slot('table_header')
                        <th>Perizinan</th>
                        <th>&nbsp;</th>
                    @endslot

                    @slot('table_id')
                        permissions-table
                    @endslot

                    @slot('panel_action')
                        <div class="btn-group btn-group-justified">
                            <a href="{{ route('permissions.create') }}" class="btn btn-primary">Tambah Perizinan</a>
                        </div>
                    @endslot

                    @slot('route')
                        {{ route('permissions.index') }}
                    @endslot

                    @slot('columns')
                        { data: 'name' },
                        { data: 'action', orderable: false, searchable: false },
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection
