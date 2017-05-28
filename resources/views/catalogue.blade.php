@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Daftar Katalog Online</div>

                    <div class="panel-body">
                        <ol>
                            @foreach ($links as $link)
                                <li>
                                    <a href="//{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                                        {{ $link->url }}
                                    </a>
                                </li>
                            @endforeach

                        </ol>

                        {{ $links->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


