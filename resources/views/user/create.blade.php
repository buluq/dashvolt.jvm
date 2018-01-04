@extends('layouts.app')

@section('content')
    @php
        $component_data = array(
            'panel_class' => 'panel-primary',
            'form_id'     => 'create_user',
            'form_title'  => 'Tambah akun pengguna',
            'form_action' => route('user.store'),
            'panel_input' => array(
                'name' => array(
                    'name'      => 'name',
                    'label'     => 'Nama lengkap',
                    'type'      => 'text',
                    'required'  => 1,
                    'autofocus' => 1,
                    'option'    => null,
                ),
                'email' => array(
                    'name'      => 'email',
                    'label'     => 'Email',
                    'type'      => 'email',
                    'required'  => 1,
                    'autofocus' => 0,
                    'option'    => null,
                ),
                'password' => array(
                    'name'      => 'password',
                    'label'     => 'Kata sandi',
                    'type'      => 'password',
                    'required'  => 1,
                    'autofocus' => 0,
                    'option'    => null,
                ),
                'status' => array(
                    'name'      => 'status',
                    'label'     => 'Status',
                    'type'      => 'text',
                    'required'  => 1,
                    'autofocus' => 0,
                    'options'   => null,
                ),
            ),
        );
    @endphp

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @component('components.form-panel', $component_data)
                    @slot('user_id')
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection
