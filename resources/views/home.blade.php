@extends('navbar')

@section('content')
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div id="youtube-panel" class="panel panel-default">
                    <div class="panel-heading">
                        Youtube
                    </div>
                    <div class="panel-body">
                        
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4">
				{!! Form::open(['action'=> 'HomeController@test', 'method'=>'get', 'class'=>'form navbar-form navbar-right searchform']) !!}
				{!! Form::text('search', null,
									   array('required',
											'class'=>'form-control',
											'placeholder'=>'Rechercher un usager')) !!}
				{!! Form::button('Rechercher',['type' => 'submit', 'class'=>'btn btn-info']) !!}
				{!! Form::close() !!}
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
