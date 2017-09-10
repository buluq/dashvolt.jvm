<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Tambah Website</div>

                <div class="panel-body">
                    <form action="{{ route('website.store') }}" method="post" id="create_website" class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="domain" class="control-label col-sm-2">
                                Nama domain
                            </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="domain" required autofocus>

                                @if ($message = Session::get('error'))
                                    <span class="help-block">
                                        <strong>{{ Session::get('error') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <div class="panel-footer">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <button type="reset" class="btn btn-default" form="create_website">Batal</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary" form="create_website">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
