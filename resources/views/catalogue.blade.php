@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Daftar Katalog Online</div>

                    <div class="panel-body">
                        <?php /* <ol>
                            @foreach ($links as $link)
                                <li>
                                    <a href="//{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                                        {{ $link->url }}
                                    </a>
                                </li>
                            @endforeach

                        </ol>

                        {{ $links->links() }}
                        */ ?>

                        <table class="table table-hover" id="catalogue-table">
                            <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>Produk</th>
                                    <th>Website</th>
                                    <th>Penulis</th>
                                    <th>Pembaruan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('cssinline')
    <style>
        #catalogue-table_length select,
        #catalogue-table_filter input {
            display: inline-block;
            width: inherit;
        }
    </style>
@endsection

@section('jsinline')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            $('#catalogue-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('catalogue') !!}',
                columns: [
                    { data: 'url', name: 'url' },
                    { data: 'product.name', name: 'product.name' },
                    { data: 'website.domain', name: 'website.domain' },
                    { data: 'user.name', name: 'user.name' },
                    { data: 'updated_at', name: 'updated_at' },
                ]
            });
        });


        $.when($.ready).then(function() { $("#catalogue-table_length select, #catalogue-table_filter input").ready().addClass("form-control"); });
    </script>
@endsection
