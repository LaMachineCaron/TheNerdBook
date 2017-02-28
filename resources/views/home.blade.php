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
                    @if (isset($videos))
                        <div id="video_list" >
                            <ul class="list-group">
                                @foreach($videos as $video)
                                    <?php
                                        $snippet = $video['modelData']['snippet'];
                                        $title = $snippet['title'];
                                        $thumbnail = $snippet['thumbnails']['default'];
                                ?>
                                <li class="list-group-item">
                                    <div class="row" style="height: 140px">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <img width="{{ $thumbnail['width'] }}" height="{{ $thumbnail['height'] }}" src="{{ $thumbnail['url'] }}" class="img-thumbnail img-responsive center-block">
                                        </div>
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 video_description">
                                            <h4>{{ $title }}</h4>

                                            
                                            <p>{{ $snippet['channelId'] }}  
                                            
                                            <!-- Button trigger modal -->
											<a href="#" class="glyphicon glyphicon-share-alt text-right" data-toggle="modal" data-target="#modal_{{$video['modeldata']['id']['videoId']}}"></a> 
											
											</p>
                                            <p>{{ $snippet['publishedAt'] }}</p>
                                        </div>
                                    </div>
                                </li>
                                
                                <!-- Modal -->
								<div class="modal fade" id="modal_{{$video['modeldata']['id']['videoId']}}" tabindex="-1" role="dialog" aria-labelledby="modal_{{$video['modeldata']['id']['videoId']}}">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="myModalLabel">Partager la vidéo</h4>
								      </div>
								      <div class="modal-body">
								      	{!! Form::open(['method' => 'POST', 'action' => 'HomeController@create_post_video']) !!}
                                            {!! Form::text('caption') !!}
                                            {!! Form::hidden('video', json_encode($video['modelData'])) !!}
                                            
                                        
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								        {!! Form::submit('Submit here :)') !!}
								      	{!! Form::close() !!}
								      </div>
								    </div>
								  </div>
								</div>
                                
                                @endforeach
                            </ul>
                        </div>
                    @elseif (isset($youtube_url))
                        <a href="{{ $youtube_url }}" id="btn-youtube-connect" class="btn btn-default btn-lg center">Connexion Youtube</a>
                    @endif
                </div>
            </div>

            <div id="post-mobile" role="tabpanel" class="tab-pane col-xs-12 col-sm-12">
                <div id="post-section">
					<div class="post_list">
						@foreach($posts as $post)
				            <div class="message-box">
				                <a href="{{ url('user/'.$post->user_id) }}">
				                    <h3>{{$post->user->first_name}} {{$post->user->last_name}}</h3>
				                </a>
				                <p>{{$post->title}}</p>
				                <p>Lien: {{ $post->url }}</p>
				                <p>{{$post->caption}}</p>
				                @if ($post->type == 1) // If it's a stream
									
								@elseif ($post->type == 2)
									<p>Jeux: {{$post->game_title}}</p>
								@endif
				            </div>
				        @endforeach
					</div>
                </div>
            </div>

            <div id="twitch-mobile" role="tabpanel" class="tab-pane col-xs-12 col-sm-12">
                <div id="twitch-section" class="panel-body spy-twitch">
                    @if (isset($streams))
                        <div id="video_list" >
                            <ul class="list-group">
                                <?php
                                $streams = $streams['streams'];
                                ?>
                                @foreach($streams as $stream)
                                    <li class="list-group-item">
                                        <div class="row" style="height: 80px">
                                            <div class="col-xs-2 col-sm-4 col-md-4 col-lg-4">
                                                <a href="{{ $stream['channel']['url'] }}">
                                                    <img width="80px" height="80px" src="{{ $stream['channel']['logo'] }}" alt="image_{{ $stream['channel']['display_name'] }}" class="img-thumbnail img-responsive center-block">
                                                </a>

                                            </div>
                                            <div class="col-xs-10 col-sm-8 col-md-8 col-lg-8 video_description">
                                                <h4>
                                                    {{ $stream['channel']['display_name'] }}
                                                    <a href="#" class="glyphicon glyphicon-share-alt text-right" data-toggle="modal" data-target="#modal_{{$stream['_id']}}"></a>
                                                </h4>
                                                <p>Playing: {{ $stream['game'] }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <!-- Modal -->
									<div class="modal fade" id="modal_{{$stream['_id']}}" tabindex="-1" role="dialog" aria-labelledby="modal_{{$stream['_id']}}">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        <h4 class="modal-title">Partager la vidéo</h4>
									      </div>
									      <div class="modal-body">
									      	{!! Form::open(['method' => 'POST', 'action' => 'HomeController@create_post_stream']) !!}
	                                            {!! Form::text('caption') !!}
	                                            {!! Form::hidden('video', json_encode($stream)) !!}
	                                            
	                                        
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									        {!! Form::submit('Submit here :)') !!}
									      	{!! Form::close() !!}
									      </div>
									    </div>
									  </div>
									</div>
                                    
                                @endforeach
                            </ul>
                        </div>
                    @elseif (isset($twitch_url))
						<a href="{{ $twitch_url }}" id="btn-twitch-connect" class="btn btn-default btn-lg center">Connexion Twitch</a>
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






<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
