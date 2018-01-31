{{-- \resources\views\users\edit.blade.php --}}

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
                        Penyuntingan akun <em>{{ $user->name }}</em>
                    @endslot

                    @slot('panel_action')
                        <div class="btn-group btn-group-justified" role="group">
                            {{ link_to(url()->previous(), 'Batal', ['class' => 'btn btn-default']) }}

                            <div class="btn-group" role="group">
                                {{ Form::reset('Reset', ['form' => 'user-edit', 'class' => 'btn btn-default']) }}
                            </div>

                            <div class="btn-group" role="group">
                                {{ Form::submit('Ubah', ['form' => 'user-edit', 'class' => 'btn btn-danger']) }}
                            </div>
                        </div>
                    @endslot

                    {{ Form::model($user, ['route' => ['staff.update', $user->id], 'method' => 'put', 'class' => 'form-horizontal', 'id' => 'user-edit']) }}
                        <div class="form-group">
                            {{ Form::label('name', 'Nama', ['class' => 'control-label col-sm-3']) }}

                            <div class="col-sm-9">
                                {{ Form::text('name', null, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Alamat surel', ['class' => 'control-label col-sm-3']) }}

                            <div class="col-sm-9">
                                {{ Form::email('email', null, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('status', 'Status', ['class' => 'control-label col-sm-3']) }}

                            <div class="col-sm-9">
                                {{ Form::select('status', ['Tidak aktif' => 'Tidak aktif', 'Aktif' => 'Aktif'], 'Aktif', ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <hr>

                        <h3>Penugasan Pengguna</h3>

                        <div class="form-group">
                            @foreach ($roles as $role)
                                <div class="checkbox col-sm-9 col-sm-offset-3">
                                    {{ Form::checkbox('roles[]', $role->id, $user->roles) }}
                                    {{ Form::label($role->name, ucfirst($role->name)) }}
                                </div>
                            @endforeach
                        </div>
                    {{ Form::close() }}
                @endcomponent
            </div>
        </div>
    </div>
@endsection
