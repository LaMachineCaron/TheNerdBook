@extends('navbar')

@section('script_header')
    <script src="{{ asset('/js/home.js') }}"></script>
@endsection

@section('content')

        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div id="youtube-panel" class="panel panel-default">
                    <div class="panel-heading">
                        Youtube
                    </div>
                    <div class="panel-body spy-youtube">
                        @if (!Auth::user()->token_youtube)
                            <div  id="video_list" >
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
                            <a href="#" id="btn-youtube-connect" class="btn btn-default btn-lg center">Connexion Youtube</a>
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
                    <div class="panel-body text-center">
                        @if (Auth::user()->token_youtube)

                        @else
                            <a href="#" id="btn-twitch-connect" class="btn btn-default btn-lg center">Connexion Twitch</a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
@endsection
