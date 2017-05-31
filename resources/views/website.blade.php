@extends('layouts.app')

@section('content')
    @if ($request->is('website'))
        @include('website.index')
    @elseif ($request->is('website/create'))
        @include('website.create')
    @endif
@endsection
