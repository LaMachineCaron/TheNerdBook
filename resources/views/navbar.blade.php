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
                            <div class="form-group">
                                {!! Form::label('email:', 'Email:') !!}
                                {!! Form::text('email',null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password:', 'Password:') !!}
                                {!! Form::text('password',null, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::button('Login', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                        </div>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endsection