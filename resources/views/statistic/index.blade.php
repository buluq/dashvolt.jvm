@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @component('components.widget-panel', ['panel_class' => 'panel-info', 'panel_title' => 'Statistik Pos Tim',])
                    @slot('panel_body')
                        <table class="table table-hover">
                            <tr>
                                <th>Jumlah pos keseluruhan</th>
                                <td>{{ $data['total'] }} pos</td>
                            </tr>

                            <tr>
                                <th>Jumlah pos bulan ini</th>
                                <td>{{ $data['month'] }} pos</td>
                            </tr>
                        </table>
                    @endslot

                    @slot('panel_actions')
                    @endslot
                @endcomponent
            </div>

            <div class="col-md-6">
                @component('components.widget-panel', ['panel_class' => 'panel-info', 'panel_title' => 'Statistik Pos Saya',])
                    @slot('panel_body')
                        <table class="table table-hover">
                            <tr>
                                <th>Jumlah pos keseluruhan</th>
                                <td>{{ $data['user_total'] }} pos</td>
                            </tr>

                            <tr>
                                <th>Jumlah pos bulan ini</th>
                                <td>{{ $data['user_month'] }} pos</td>
                            </tr>
                        </table>
                    @endslot

                    @slot('panel_actions')
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection

@push('javascripts')
    <script src="{{ asset('js/d3.min.js') }}"></script>
@endpush
