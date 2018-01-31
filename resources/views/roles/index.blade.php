{{-- \resources\views\roles\index.blade.php --}}

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
                        Daftar Penugasan
                    @endslot

                    @slot('table_header')
                        <th>Tugas</th>
                        <th>Perizinan</th>
                        <th>&nbsp;</th>
                    @endslot

                    @slot('table_id')
                        roles-table
                    @endslot

                    @slot('panel_action')
                        <div class="btn-group btn-group-justified" role="group">
                            <a href="{{ route('roles.create') }}" class="btn btn-primary">Tambah Penugasan</a>
                        </div>
                    @endslot

                    @slot('route')
                        {{ route('roles.index') }}
                    @endslot

                    @slot('columns')
                        { data: 'name' },
                        { data: 'permissions' },
                        { data: 'action', orderable: false, searchable: false },
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection
