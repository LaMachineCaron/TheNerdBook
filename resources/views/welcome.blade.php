@extends('navbar')

@section('content')
    <div class="panel panel-default" style="border-color: transparent;">
        <div class="panel-heading" style="background-color: transparent; border-color: transparent">
            <h4 class="text-center">Bienvenue sur le site officiel des nerds</h4>
            <h4 class="text-center">Veuillez vous connecter</h4>
        </div>

        <div class="panel-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form role="form" method="POST" action="{{ url('/register') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        {!! Form::label('first_name:', 'Prénom:') !!}
                                        {!! Form::text('first_name',null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('last_name:', 'Nom:') !!}
                                        {!! Form::text('last_name',null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('email:', 'Courriel:') !!}
                                        {!! Form::text('email',null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('password:', 'Mot de passe:') !!}
                                        {!! Form::input('password','password',null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('password_confirmation:', 'Confirmation:') !!}
                                        {!! Form::input('password','password_confirmation',null, ['class' => 'form-control']) !!}
                                    </div>

                                    {!! Form::button('Register', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
