@component('components.widget-panel', ['panel_class' => 'panel-info', 'panel_title' => 'Statistik Saya',])
    @slot('panel_body')
        <table class="table table-hover">
            <tr>
                <th>Jumlah pos keseluruhan</th>
                <td>{{ $stats['total'] }}</td>
            </tr>

            <tr>
                <th>Jumlah pos bulan ini</th>
                <td>{{ $stats['monthly'] }}</td>
            </tr>

            <tr>
                <th>Jumlah pos hari ini</th>
                <td>{{ $stats['today'] }}</td>
            </tr>

            <tr>
                <th>Pencapaian target bulan lalu</th>
                <td>{{ $stats['lastmonth'] }} / {{ round(($stats['lastmonth']/480)*100, 2) }} %</td>
            </tr>

            <tr>
                <th>Pencapaian target bulan ini</th>
                <td>{{ round(($stats['monthly']/480)*100, 2) }} %</td>
            </tr>
        </table>
    @endslot

    @slot('panel_actions')
        <div class="btn-group btn-group-justified" role="group">
            <a href="{{ route('catalogue.index') }}" class="btn btn-default" role="button">Lihat katalog</a>
            <a href="{{ route('catalogue.create') }}" class="btn btn-primary" role="button">Kirim pos</a>
        </div>
    @endslot
@endcomponent
