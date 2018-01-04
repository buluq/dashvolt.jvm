<div class="panel {{ $panel_class }}">
    <div class="panel-heading">{{ $form_title }}</div>

    <div class="panel-body">
        <form action="{{ $form_action }}" method="post" id="{{ $form_id }}" class="form-horizontal">
            {{ csrf_field() }}
            {{ $user_id }}

            @foreach ($panel_input as $input => $parameter)
                <div class="form-group">
                    <label for="{{ $parameter['name'] }}" class="control-label col-sm-3">
                        {{ $parameter['label'] }}
                    </label>

                    <div class="col-sm-9">
                        @if ($parameter['type'] == 'option')
                            <select name="{{ $parameter['name'] }}" class="form-control">
                                @if($parameter['name'] == 'website_id')
                                    @foreach ($parameter['options'] as $option)
                                        <option value="{{ $option->id }}">{{ $option->domain }}</option>
                                    @endforeach
                                @else
                                    @foreach ($parameter['options'] as $option)
                                        <option value="{{ $option->id }}">{{ $option->name }} - {{ $option->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        @else
                            <input type="{{ $parameter['type'] }}" class="form-control" name="{{ $parameter['name'] }}" @if ($parameter['value'] !== null) value="{{ $parameter['value'] }}" @endif  @if($parameter['required'] === 1) required @endif @if($parameter['autofocus'] === 1) autofocus @endif>
                        @endif

                        @if (Session::get('error'))
                            <span class="help-block">
                                <strong>{{ Session::get('error') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </form>
    </div>

    <div class="panel-footer">
        <div class="btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
                <a href="{{ url()->previous() }}" type="button" class="btn btn-default" form="{{ $form_id }}">Batal</a>
            </div>

            <div class="btn-group" role="group">
                <button type="reset" class="btn btn-default" form="{{ $form_id }}">Reset</button>
            </div>

            <div class="btn-group" role="group">
                <button type="submit" class="btn btn-primary" form="{{ $form_id }}">Kirim</button>
            </div>
        </div>
    </div>
</div>
