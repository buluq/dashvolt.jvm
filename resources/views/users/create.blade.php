{{-- \resources\views\users\create.blade.php --}}

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
                        Tambah Pengguna
                    @endslot

                    @slot('panel_action')
                        <div class="btn-group btn-group-justified" role="group">
                            {{ link_to(url()->previous(), 'Batal', ['class' => 'btn btn-default']) }}

                            <div class="btn-group" role="group">
                                {{ Form::reset('Reset', ['form' => 'user-create', 'class' => 'btn btn-default']) }}
                            </div>

                            <div class="btn-group" role="group">
                                {{ Form::submit('Tambah', ['form' => 'user-create', 'class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                    @endslot

                    {{ Form::open(['url' => 'staff', 'class' => 'form-horizontal', 'id' => 'user-create']) }}
                        <div class="form-group">
                            {{ Form::label('name', 'Nama lengkap', ['class' => "control-label col-sm-3"]) }}

                            <div class="col-sm-9">
                                {{ Form::text('name', '', ['class' => 'form-control', 'required', 'autofocus']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Alamat surel', ['class' => 'control-label col-sm-3']) }}

                            <div class="col-sm-9">
                                {{ Form::email('email', '', ['class' => 'form-control', 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Kata sandi', ['class' => 'control-label col-sm-3']) }}

                            <div class="col-sm-9">
                                {{ Form::password('password', ['class' => 'form-control', 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('password_confirmation', 'Konfirmasi sandi', ['class' => 'control-label col-sm-3']) }}

                            <div class="col-sm-9">
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'required']) }}
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
                                <div class="checkbox col-sm-offset-1">
                                    {{ Form::checkbox('roles[]', $role->id) }}
                                    {{ Form::label($role->name, ucfirst($role->name)) }}
                                </div>
                            @endforeach
                        </div>
                    </form>
                @endcomponent
            </div>
        </div>
    </div>
@endsection
