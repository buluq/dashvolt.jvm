@extends('layouts.app')

@section('content')
    @php
        $component_data = array(
            'panel_class' => 'panel-primary',
            'form_id'     => 'catalogue_journal',
            'form_action' => route('catalogue.store'),
            'products'    => $products,
            'panel_input' => array(
                'url' => array(
                    'name'      => 'url',
                    'label'     => 'Pos URL',
                    'type'      => 'url',
                    'required'  => 1,
                    'autofocus' => 1,
                    'option'    => null,
                ),
                'website' => array(
                    'name'      => 'website_id',
                    'label'     => 'Alamat website',
                    'type'      => 'option',
                    'required'  => 1,
                    'autofocus' => 0,
                    'options'   => $websites,
                ),
                'product' => array(
                    'name'      => 'product_id',
                    'label'     => 'Nama produk',
                    'type'      => 'option',
                    'required'  => 1,
                    'autofocus' => 0,
                    'options'   => $products,
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
