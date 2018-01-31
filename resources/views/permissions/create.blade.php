{{-- \resources\views\permissions\create.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @component('components.panel-default')
                    @slot('panel_class')
                        panel-primary
                    @endslot

                    @slot('panel_title')
                        Tambah Perizinan
                    @endslot

                    @slot('panel_action')
                        <div class="btn-group btn-group-justified" role="group">
                            {{ link_to(url()->previous(), 'Batal', ['class' => 'btn btn-default']) }}

                            <div class="btn-group" role="group">
                                {{ Form::reset('Reset', ['form' => 'permission-create', 'class' => 'btn btn-default']) }}
                            </div>

                            <div class="btn-group" role="group">
                                {{ Form::submit('Tambah', ['form' => 'permission-create', 'class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                    @endslot

                    {{ Form::open(['url' => 'permissions', 'class' => 'form-horizontal', 'id' => 'permission-create']) }}
                        <div class="form-group">
                            {{ Form::label('name', 'Nama Perizinan', ['class' => "control-label col-sm-3"]) }}

                            <div class="col-sm-9">
                                {{ Form::text('name', '', ['class' => 'form-control', 'required', 'autofocus']) }}
                            </div>
                        </div>

                        <hr>

                        @if(!$roles->isEmpty())
                            <h3>Terapkan Perizinan Terhadap Tugas</h3>

                            <div class="form-group">
                                @foreach($roles as $role)
                                    <div class="checkbox col-sm-offset-1">
                                        {{ Form::checkbox('roles[]', $role->id) }}
                                        {{ Form::label($role->name, ucfirst($role->name)) }}
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    {{ Form::close() }}
                @endcomponent
            </div>
        </div>
    </div>
@endsection
