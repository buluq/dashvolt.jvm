<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Daftar Website</div>

                <div class="panel-body">
                    <ol>
                        @foreach ($sites as $website)
                            <li>
                                <a href="//{{ $website->domain }}" target="_blank" rel="noopener noreferrer">
                                    {{ $website->domain }}
                                </a>
                            </li>
                        @endforeach
                    </ol>
                </div>

                <div class="panel-footer">
                    <a href="{{ route('website.create') }}" class="btn btn-primary btn-block" role="button">Tambahkan website</a>
                </div>
            </div>
        </div>
    </div>
</div>
