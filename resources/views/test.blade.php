@extends('navbar')

@section('styles')
    <link rel="stylesheet" href="{{ asset('/css/search.css') }}">
@endsection

@section('content')
    <h1>Liste des usagers qui commencent avec {{strtoupper($input)}}</h1>

    @if(!empty($foundUsers))
        @foreach($foundUsers as $user)
            <div class="message-box">
                <a href="{{ url('user/'.$user->id) }}">
                    <h3>{{$user->first_name}} {{$user->last_name}}</h3>
                </a>
                <p>{{$user->email}}</p>
                @if (Auth::user()->id != $user->id)
                    @if (Auth::user()->following()->where('id', $user->id)->count())
                        <a href="{{ url('follow/'.$user->id) }}" class="btn btn-danger">unfollow </a>
                    @else
                        <a href="{{ url('follow/'.$user->id) }}" class="btn btn-primary">follow </a>
                    @endif
                @endif
            </div>
        @endforeach
    @else
        <p>Aucun usager n'a été trouvé</p>
    @endif
@endsection