@extends('navbar')

@section('script_header')
    <script src="{{ asset('/js/home.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}">
@endsection

@section('content')
    @if (session()->has('status'))
        <div class="alert alert-success">
            {{ Session::get('status') }}
        </div>
    @endif
    <form role="form" method="post" action="{{ url('/profil') }}">
        {{csrf_field()}}
        <div class="form-group">
            <label for="firstName">Prénom</label>
            <input name="firstName" type="text" class="form-control" id="firstName" value="{{Auth::user()->first_name}}">
        </div>
        <div class="form-group">
            <label for="lastName">Nom de famille</label>
            <input name="lastName" type="text" class="form-control" id="lastName" value="{{Auth::user()->last_name}}">
        </div>
        <div class="checkbox">
            <label><input name="youtubeDisconnect" type="checkbox" {!! Auth::user()->access_token_youtube ? "" : 'disabled' !!} value="disconnect">Déconnexion Youtube</label>
        </div>
        <div class="checkbox">
            <label><input name="twitchDisconnect" type="checkbox" {!! Auth::user()->token_twitch ? "" : 'disabled' !!} value="disconnect">Déconnexion Twitch</label>
        </div>
        <button type="submit" class="btn btn-primary btn-success">Soumettre</button>
    </form>
@endsection