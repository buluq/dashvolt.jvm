{{-- \resources\views\permissions\edit.blade.php --}}

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
                        Penyuntingan Izin <em>{{ $permission->name }}</em>
                    @endslot

                    @slot('panel_action')
                        <div class="btn-group btn-group-justified" role="group">
                            {{ link_to(url()->previous(), 'Batal', ['class' => 'btn btn-default']) }}

                            <div class="btn-group" role="group">
                                {{ Form::reset('Reset', ['class' => 'btn btn-default', 'form' => 'permission-edit', 'type' => 'reset']) }}
                            </div>
                            <div class="btn-group" role="group">
                                {{ Form::button('Ubah', ['class' => 'btn btn-primary', 'form' => 'permission-edit', 'type' => 'submit']) }}
                            </div>
                        </div>
                    @endslot

                    {{ Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'put', 'class' => 'form-horizontal', 'id' => 'permission-edit']) }}

                    <div class="form-group">
                        {{ Form::label('name', 'Nama Perizinan', ['class' => 'control-label col-sm-3']) }}

                        <div class="col-sm-9">
                            {{ Form::text('name', null, ['class' => 'form-control']) }}
                        </div>
                    </div>

                    {{ Form::close() }}
                @endcomponent
            </div>
        </div>
    </div>
@endsection
