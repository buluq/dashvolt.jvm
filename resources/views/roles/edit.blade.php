{{-- \resources\views\roles\edit.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-offset-2">
                @component('components.panel-default')
                    @slot('panel_class')
                        panel-primary
                    @endslot

                    @slot('panel_title')
                        Penyuntingan Tugas <em>{{ $role->name }}
                    @endslot

                    @slot('panel_action')
                        <div class="btn-group btn-group-justified" role="group">
                            <a href="{{ url()->previous() }}" class="btn btn-default">Kembali</a>
                            <div class="btn-group" role="group">
                                {{ Form::button('Ubah', ['class' => 'btn btn-primary', 'form' => 'role-edit', 'type' => 'submit']) }}
                            </div>
                        </div>
                    @endslot

                    {{ Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'put', 'id' => 'role-edit']) }}

                    <div class="form-group">
                        {{ Form::label('name', 'Nama') }}
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                    </div>

                    <h3>Penerapan Perizinan</h3>

                    @foreach ($permissions as $permission)
                        {{ Form::checkbox('permissions[]',  $permission->id, $role->permissions) }}
                        {{ Form::label($permission->name, ucfirst($permission->name)) }}
                        <br>
                    @endforeach

                    {{ Form::close() }}
                @endcomponent
            </div>
        </div>
    </div>
@endsection
