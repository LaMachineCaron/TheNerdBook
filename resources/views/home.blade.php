@extends('navbar')

@section('script_header')
    <script src="{{ asset('/js/home.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}">
@endsection

@section('content')
    <div id="mobile" class="container-fluid hidden-lg">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#youtube-mobile" aria-controls="youtube" role="tab" data-toggle="tab">Youtube</a></li>
            <li role="presentation"><a href="#post-mobile" aria-controls="post" role="tab" data-toggle="tab">Posts</a></li>
            <li role="presentation"><a href="#twitch-mobile" aria-controls="twitch" role="tab" data-toggle="tab">Twitch</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div id="youtube-mobile" role="tabpanel" class="tab-pane active col col-xs-12 col-sm-12">
                <div id="youtube-section" class="panel-body spy-youtube">
                    @if (Auth::user()->token_youtube)
                        <div id="video_list" >
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="row" style="height: 140px">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <img width="140px" height="140px" src="{{ asset('img/logo2.png') }}" class="img-thumbnail img-responsive center-block">
                                        </div>
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 video_description">
                                            <h4>Title</h4>
                                            <p>Pseudo</p>
                                            <p>Il y a 4 sec</p>
                                            <p>Voici une description qui est pas long. Ça fait des cool shit.</p>
											<a href="#" id="btn-share" class="btn btn-primary btn-lg center">Partager</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row" style="height: 140px">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <img width="140px" height="140px" src="{{ asset('img/logo2.png') }}" class="img-thumbnail img-responsive center-block">
                                        </div>
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 video_description">
                                            <h4>Title</h4>
                                            <p>Pseudo</p>
                                            <p>Il y a 4 sec</p>
                                            <p>Voici une description qui est pas long. Ça fait des cool shit.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row" style="height: 140px">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <img width="140px" height="140px" src="{{ asset('img/logo2.png') }}" class="img-thumbnail img-responsive center-block">
                                        </div>
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 video_description">
                                            <h4>Title</h4>
                                            <p>Pseudo</p>
                                            <p>Il y a 4 sec</p>
                                            <p>Voici une description qui est pas long. Ça fait des cool shit.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row" style="height: 140px">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <img width="140px" height="140px" src="{{ asset('img/logo2.png') }}" class="img-thumbnail img-responsive center-block">
                                        </div>
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 video_description">
                                            <h4>Title</h4>
                                            <p>Pseudo</p>
                                            <p>Il y a 4 sec</p>
                                            <p>Voici une description qui est pas long. Ça fait des cool shit.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ $data['youtube_url'] }}" id="btn-youtube-connect" class="btn btn-default btn-lg center">Connexion Youtube</a>
                    @endif
                </div>
            </div>

            <div id="post-mobile" role="tabpanel" class="tab-pane col-xs-12 col-sm-12">
                <div id="post-section">

                </div>
            </div>

            <div id="twitch-mobile" role="tabpanel" class="tab-pane col-xs-12 col-sm-12">
                <div id="twitch-section" class="panel-body spy-twitch">
                    @if (Auth::user()->token_twitch)
                        <div id="video_list" >
                            <ul class="list-group">
                                <?php
                                $streams = $data['streams']['streams'];
                                ?>
                                @foreach($streams as $stream)
                                    <li class="list-group-item">
                                        <div class="row" style="height: 80px">
                                            <div class="col-xs-2 col-sm-4 col-md-4 col-lg-4">
                                                <a href="{{ $stream['channel']['url'] }}" >
                                                    <img width="80px" height="80px" src="{{ $stream['channel']['logo'] }}" class="img-thumbnail img-responsive center-block">
                                                </a>

                                            </div>
                                            <div class="col-xs-10 col-sm-8 col-md-8 col-lg-8 video_description">
                                                <h4>{{ $stream['channel']['display_name'] }}</h4>
                                                <p>Playing: {{ $stream['game'] }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
						<a href="{{ $data['twitch_url'] }}" id="btn-twitch-connect" class="btn btn-default btn-lg center">Connexion Twitch</a>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div id="desktop" class="container-fluid hidden-xs hidden-sm">
        <div id="desktop-section" class="row">
            <div class="col-xs-12 col-sm-4">
                <div id="youtube-desktop" class="panel panel-default">
                    <div class="panel-heading">
                        Youtube
                    </div>
                </div>
            </div>

            <div id="post-desktop" class="col-xs-12 col-sm-4">

            </div>

            <div class="col-xs-12 col-sm-4">
                <div id="twitch-desktop" class="panel panel-default">
                    <div class="panel-heading">
                        Twitch
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
