@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@component('components.datatable-panel')
					@slot('panel_class')
						panel-primary
					@endslot

					@slot('panel_title')
						Daftar Akun Pengguna
					@endslot

					@slot('table_id')
						user-table
					@endslot

					@slot('table_headers')
						<th>Nama</th>
						<th>Email</th>
						<th>Status</th>
					@endslot

					@slot('panel_actions')
						<a href="{{ route('user.create') }}" class="btn btn-block btn-primary" role="button">Buat akun baru</a>
					@endslot
				@endcomponent
			</div>
		</div>
	</div>
@endsection

@push('javascripts')
	<script>
		$(function() {
			$('#user-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: '{{ route('user.index') }}',
				columns: [
					{ data: 'name', name: 'name' },
					{ data: 'email', name: 'email' },
					{ data: 'status', name: 'status' },
				]
			});
		});
	</script>
@endpush
