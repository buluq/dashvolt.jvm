{{-- \resources\views\components\panel-default.blade.php --}}

<div class="panel {{ $panel_class }}">
    <div class="panel-heading">
        <h1 class="h4">{{ $panel_title }}</h1>
    </div>

    <div class="panel-body">
        {{ $slot }}
    </div>

    @if (isset($panel_action))
        <div class="panel-footer">
            {{ $panel_action }}
        </div>
    @endif
</div>
