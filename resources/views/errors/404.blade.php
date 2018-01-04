@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="jumbotron">
					<h1>Tidak Ditemukan</h1>

					<p>Mohon maaf, halaman yang Anda cari tidak ditemukan</p>

					<p><a href="{{ route('home') }}" class="btn btn-primary btn-lg" role="button">Kembali ke beranda</a></p>
				</div>
			</div>
		</div>
	</div>
@endsection
