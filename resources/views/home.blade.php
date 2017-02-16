@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(['action'=> 'HomeController@test', 'method'=>'get', 'class'=>'form navbar-form navbar-right searchform']) !!}
            {!! Form::text('search', null,
                                   array('required',
                                        'class'=>'form-control',
                                        'placeholder'=>'Search for a tutorial...')) !!}
            {!! Form::button('Search',['type' => 'submit', 'class'=>'btn btn-default']) !!}
            {!! Form::close() !!}
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
