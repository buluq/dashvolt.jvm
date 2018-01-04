<div class="row">
    <div class="col-md-12">
        @component('components.datatable-panel')
            @slot('panel_class')
                panel-primary
            @endslot

            @slot('panel_title')
                Daftar Website
            @endslot

            @slot('table_id')
                website-table
            @endslot

            @slot('table_headers')
                <th>Domain</th>
            @endslot

            @slot('panel_actions')
                <a href="{{ route('website.create') }}" class="btn btn-block btn-primary" role="button">Tambah Website</a>
            @endslot
        @endcomponent
    </div>
</div>

@push('javascripts')
    <script>
        $(function() {
            $('#website-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('website.index') }}',
                columns: [
                    { data: 'domain' },
                ]
            });
        });
    </script>
@endpush
