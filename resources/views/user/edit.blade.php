@extends('layouts.app')

@section('content')
    @php
        $component_data = array(
            'panel_class' => 'panel-primary',
            'form_id'     => 'edit_user',
            'form_title'  => 'Edit data akun',
            'form_action' => '/user/' . $id,
            'panel_input' => array(
                'name' => array(
                    'name'      => 'name',
                    'label'     => 'Nama lengkap',
                    'type'      => 'text',
                    'value'     => $user->name,
                    'required'  => 0,
                    'autofocus' => 1,
                    'option'    => null,
                ),
                'email' => array(
                    'name'      => 'email',
                    'label'     => 'Email',
                    'type'      => 'email',
                    'value'     => $user->email,
                    'required'  => 0,
                    'autofocus' => 0,
                    'option'    => null,
                ),
                'password' => array(
                    'name'      => 'password',
                    'label'     => 'Kata sandi',
                    'type'      => 'password',
                    'value'     => $user->password,
                    'required'  => 0,
                    'autofocus' => 0,
                    'option'    => null,
                ),
                'status' => array(
                    'name'      => 'status',
                    'label'     => 'Status',
                    'type'      => 'text',
                    'value'     => $user->status,
                    'required'  => 0,
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
                        {{ method_field('PATCH') }}
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection
