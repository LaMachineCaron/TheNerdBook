@extends('layouts.app')

@section('content')
    <div class="container">

        @foreach($foundUsers as $user)
            <p>{{$user->first_name}}</p>
        @endforeach
    </div>
@endsection