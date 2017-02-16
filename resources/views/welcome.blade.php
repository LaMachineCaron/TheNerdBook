@extends('navbar')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">

        </div>
    </div>

    <form role="form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}
        <input name="first_name">
        <input name="last_name">
        <input name="email">
        <input name="password">
        <input name="password_confirmation">
        <button type="submit">Register</button>
    </form>
@endsection
