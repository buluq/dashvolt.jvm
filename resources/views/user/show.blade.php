@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-10">
                        <h1>{{ $user->name }}<br><small>{{ $user->email }}</small></h1>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-block" role="button">Edit</a>
                        <a href="{{ route('user.index') }}" class="btn btn-default btn-block" role="button">Lihat semua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
