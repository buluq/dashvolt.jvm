{{-- \resources\views\errors\401.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1>Akses Ditolak</h1>

                    <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
                    <p>{{ link_to(route('home'), 'Kembali ke Dashboard', ['class' => 'btn btn-primary']) }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
