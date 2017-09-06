@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @component('components.datatable-panel')
                    @slot('panel_class')
                        panel-info
                    @endslot

                    @slot('panel_title')
                        Pos Saya
                    @endslot

                    @slot('table_id')
                        catalogue-table
                    @endslot

                    @slot('table_headers')
                        <th>URL Pos</th>
                        <th>Website</th>
                        <th>Tanggal Update</th>
                    @endslot

                    @slot('panel_actions')
                        <div class="btn-group btn-group-justified" role="group">
                            <a href="{{ route('catalogue.index') }}" class="btn btn-default" role="button">Lihat semua pos katalog</a>
                            <a href="{{ route('catalogue.create') }}" class="btn btn-primary" role="button">Kirim pos katalog</a>
                        </div>
                    @endslot
                @endcomponent
            </div>

            <div class="col-md-4">
                @component('components.widget-panel', ['panel_class' => 'panel-primary', 'panel_title' => 'Profilku',])
                    @slot('panel_body')
                        <form  id="profile" class="form-horizontal">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>
                        </form>
                    @endslot

                    @slot('panel_actions')
                        <div class="btn-group btn-group-justified" role="group">
                            <div class="btn-group" role="group">
                                <button type="button" id="edit" class="btn btn-default" form="profile">Edit</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="reset" id="cancel" class="btn btn-primary" form="profile">Cancel</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="submit" id="submit" class="btn btn-danger" form="profile" disabled>Update</button>
                            </div>
                        </div>
                    @endslot
                @endcomponent

                @component('components.widget-panel', ['panel_class' => 'panel-info', 'panel_title' => 'Statistik Pos Saya',])
                    @slot('panel_body')
                        <table class="table table-hover">
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
                                <td>{{ $stats['lastmonth'] }} ({{ round(($stats['lastmonth']/480)*100, 2) }}) %</td>
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
            </div>
        </div>

        <div class="row">

        </div>
    </div>
@endsection

@push('pagetitle')
    - Beranda
@endpush

@push('javascripts')
    <script>
        $(document).ready(function() {
            $('#catalogue-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url()->current() }}',
                    columns: [
                    { data: 'url' },
                    { data: 'website.domain' },
                    { data: 'updated_at' },
                ]
            });
        });
    </script>

    <script>
        $("#edit").click(
            function(event) {
                $("#name").prop("readonly", false);
                $("#email").prop("readonly", false);
                $("#edit").prop("disabled", true);
            }
        );

        $("#cancel").click(
            function(event) {
                $("#name").prop("readonly", true);
                $("#email").prop("readonly", true);
                $("#edit").prop("disabled", false);
            }
        );
    </script>
@endpush
