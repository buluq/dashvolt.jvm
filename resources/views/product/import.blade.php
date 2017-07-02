@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Import Data Produk</div>

                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="file" name="import_file">

                                @if ($message = Session::get('success'))
                                    <span class="help-block">
                                        <strong>{{ Session::get('success') }}</strong>
                                    </span>
                                @endif

                                @if ($message = Session::get('error'))
                                    <span class="help-block">
                                        <strong>{{ Session::get('error') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Import file</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
