@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="jumbotron">
					<h1>Tidak Diizinkan</h1>

					<p>Mohon maaf, Anda tidak diizinkan untuk mengakses fitur ini.</p>

					<p><a href="{{ route('home') }}" class="btn btn-primary btn-lg" role="button">Kembali ke beranda</a></p>
				</div>
			</div>
		</div>
	</div>
@endsection
