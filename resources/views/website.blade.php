@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($request->is('website'))
            @include('website.index')
        @elseif ($request->is('website/create'))
            @include('website.create')
        @endif
    </div>
@endsection
