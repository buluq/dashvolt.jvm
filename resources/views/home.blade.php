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
</div>
@endsection

@section('jsinline')
<script>
    $("#edit").click(
        function(event)
        {
            event.preventDefault();
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
