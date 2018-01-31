{{-- \resources\views\roles\create.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class='col-md-8 col-md-offset-2'>
                @component('components.panel-default')
                    @slot('panel_class')
                        panel-primary
                    @endslot

                    @slot('panel_title')
                        Tambah Penugasan
                    @endslot

                    @slot('panel_action')
                        <div class="btn-group btn-group-justified" role="group">
                            {{ link_to(url()->previous(), 'Batal', ['class' => 'btn btn-default']) }}

                            <div class="btn-group" role="group">
                                {{ Form::reset('Reset', ['form' => 'role-create', 'class' => 'btn btn-default']) }}
                            </div>

                            <div class="btn-group" role="group">
                                {{ Form::submit('Tambah', ['form' => 'role-create', 'class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                    @endslot

                    {{ Form::open(['url' => 'roles', 'class' => 'form-horizontal', 'id' => 'role-create']) }}
                        <div class="form-group">
                            {{ Form::label('name', 'Nama Tugas', ['class' => "control-label col-sm-3"]) }}

                            <div class="col-sm-9">
                                {{ Form::text('name', '', ['class' => 'form-control', 'required', 'autofocus']) }}
                            </div>
                        </div>

                        <hr>

                        <h3>Penerapan Perizinan</h3>

                        <div class="form-group">
                            @foreach ($permissions as $permission)
                                <div class="checkbox col-sm-offset-1">
                                    {{ Form::checkbox('permissions[]', $permission->id) }}
                                    {{ Form::label($permission->name, ucfirst($permission->name)) }}
                                </div>
                            @endforeach
                        </div>
                    {{ Form::close() }}
                @endcomponent
            </div>
        </div>
    </div>
@endsection
