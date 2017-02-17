<div class="container">
    <a href="{{ url('/logout') }}">Logout</a>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <!-- User search bar-->
            {!! Form::open(['action'=> 'HomeController@test', 'method'=>'get', 'class'=>'form navbar-form navbar-right searchform']) !!}
            {!! Form::text('search', null,
                                   array('required',
                                        'class'=>'form-control',
                                        'placeholder'=>'Rechercher un usager')) !!}
            {!! Form::button('Rechercher',['type' => 'submit', 'class'=>'btn btn-info']) !!}
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
