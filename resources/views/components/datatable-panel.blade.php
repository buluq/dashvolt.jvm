<div class="panel {{ $panel_class }}">
    <div class="panel-heading">{{ $panel_title }}</div>

    <div class="panel-body">
        <table class="table table-hover" id="{{ $table_id }}">
            <thead>
                <tr>
                    {{ $table_headers }}
                </tr>
            </thead>
        </table>
    </div>

    <div class="panel-footer">
        {{ $panel_actions }}
    </div>
</div>

@push('css')
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@push('javascripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
@endpush
