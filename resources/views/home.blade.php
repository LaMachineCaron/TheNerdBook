@extends('navbar')

@section('content')
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div id="youtube-panel" class="panel panel-default">
                    <div class="panel-heading">
                        Youtube
                    </div>
                    <div class="panel-body">
                        @if(! Auth::user()->token_youtube)
                            <a href="{{ $data['youtube_url'] }}">Connexion</a>
                        @else
                            <p>Logged in</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4">

            </div>

            <div class="col-xs-12 col-sm-4">
                <div id="twitch-panel" class="panel panel-default">
                    <div class="panel-heading">
                        Twitch
                    </div>
                    <div class="panel-body">
                        
                    </div>
                </div>
            </div>

        </div>
@endsection
