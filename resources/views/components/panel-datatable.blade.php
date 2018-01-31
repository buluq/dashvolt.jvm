{{-- \resources\views\components\panel-datatable.blade.php --}}

<div class="panel {{ $panel_class }}">
    <div class="panel-heading">
        <h1 class="h4">{{ $panel_title }}</h1>
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover" id="{{ $table_id }}">
                <thead>
                    <tr>
                        {{ $table_header }}
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="panel-footer">
        {{ $panel_action }}
    </div>
</div>

@push('stylesheet')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
@endpush

@push('javascript')
    <script src="{{ asset('js/datatables.min.js') }}"></script>

    <script>
        $(function() {
            $('#{{ $table_id }}').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ $route }}',
                columns: [ {{ $columns}} ]
            });
        });
    </script>
@endpush
