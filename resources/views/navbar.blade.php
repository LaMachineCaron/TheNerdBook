@extends('master')

@section('navbar')
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="{{ asset('img/logoText.png') }}"/></a>
            </div>
            <div id="navbar-collapse" class="collapse navbar-collapse" aria-expanded="false">
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <div class="form-inline center">
                            <form role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    {!! Form::label('email:', 'Email:') !!}
                                    {!! Form::text('email',null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('password:', 'Password:') !!}
                                    {!! Form::input('password','password',null, ['class' => 'form-control']) !!}
                                </div>

                                {!! Form::button('Login', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                            </form>
                        </div>
                    @else
                        <li class="dropdown">
                            <a id="test" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: white;">
                                {{ Auth::user()->first_name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('logout') }}" method="get" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
                {!! Form::open(['action'=> 'HomeController@test', 'method'=>'get', 'class'=>'navbar-form navbar-center']) !!}
                <div class="input-group">
                    {!! Form::text('search', null,
                                       array('required',
                                            'class'=>'form-control',
                                            'placeholder'=>'Rechercher un usager')) !!}
                    <div class="input-group-btn">
                        {!! Form::button('Rechercher',['type' => 'submit', 'class'=>'btn btn-info']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </nav>
@endsection