@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Profil</div>

                <div class="panel-body">
                    <form class="form-horizontal">
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

                        <hr>

                        <div class="form-group">
                            <div class="col-sm-4">
                                <button type="button" id="edit" class="btn btn-default btn-block">Edit</button>
                            </div>
                            <div class="col-sm-4">
                                <button type="reset" id="cancel" class="btn btn-primary btn-block">Cancel</button>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" id="submit" class="btn btn-danger btn-block" disabled>Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">Pos Katalog Saya</div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>URL Pos</th>
                                <th>Tanggal Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>
                                        <a href="//{{ $post->url }}" target="_blank" rel="noopener noreferrer">
                                            {{ $post->url }}
                                        </a>
                                    </td>
                                    <td>{{ $post->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $posts->links() }}
                </div>

                <div class="panel-footer">
                    <div class="btn-group btn-group-justified" role="group">
                        <a href="{{ route('catalogue') }}" class="btn btn-default" role="button">Lihat semua pos katalog</a>
                        <a href="{{ route('catalogue_journal') }}" class="btn btn-primary" role="button">Kirim pos katalog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsinline')
<script>
    $("#edit").click(
        function(event)
        {
            // event.preventDefault();
            $("#name").prop("readonly", false);
            $("#email").prop("readonly", false);
            $("#edit").prop("disabled", true);
            // $("#submit").prop("disabled", false);
        }
    );

    $("#cancel").click(
        function(event)
        {
            $("#name").prop("readonly", true);
            $("#email").prop("readonly", true);
            $("#edit").prop("disabled", false);
            // $("#submit").prop("disabled", true);
        }
    );
</script>
@endsection
