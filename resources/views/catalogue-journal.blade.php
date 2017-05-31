@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Jurnal Pos Katalog</div>

                    <div class="panel-body">
                        <form action="{{ route('catalogue_journal') }}" method="post" id="catalogue_journal" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <div class="form-group">
                                <label for="url" class="control-label col-sm-2">
                                    Pos URL
                                </label>

                                <div class="col-sm-10">
                                    <input type="url" class="form-control" name="url" required autofocus>

                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="website_id" class="control-label col-sm-2">
                                    Alamat website
                                </label>

                                <div class="col-sm-10">
                                    <select name="website_id" class="form-control">
                                        @foreach ($websites as $option)
                                            <option value="{{ $option->id }}">{{ $option->domain }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('website_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('website_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="product_id" class="control-label col-sm-2">
                                    Nama produk
                                </label>

                                <div class="col-sm-10">
                                    <select name="product_id" class="form-control">
                                        @foreach ($products as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="panel-footer">
                        <div class="btn-group btn-group-justified" role="group">
                            <div class="btn-group" role="group">
                                <button type="reset" class="btn btn-default" form="catalogue_journal">Batal</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="submit" class="btn btn-primary" form="catalogue_journal">Catat</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

