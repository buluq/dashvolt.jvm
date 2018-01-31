{{-- \resources\views\users\index.blade.php --}}

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
                        Daftar Pengguna
                    @endslot

                    @slot('table_header')
                        <th>Nama</th>
                        <th>Surel</th>
                        <th>Dibuat pada</th>
                        <th>Status</th>
                        <th>Tugas</th>
                        <th>&nbsp;</th>
                    @endslot

                    @slot('table_id')
                        users-table
                    @endslot

                    @slot('panel_action')
                        <div class="btn-group btn-group-justified">
                            <a href="{{ route('staff.create') }}" class="btn btn-primary">Tambah Pengguna</a>
                        </div>
                    @endslot

                    @slot('route')
                        {{ route('staff.index') }}
                    @endslot

                    @slot('columns')
                        { data: 'name' },
                        { data: 'email' },
                        { data: 'created_at' },
                        { data: 'status', searchable: false },
                        { data: 'role', orderable: false },
                        { data: 'action', orderable: false },
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection
