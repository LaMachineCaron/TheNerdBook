@extends('navbar')

@section('content')
    <h1>Liste des usagers qui commencent avec {{strtoupper($input)}}</h1>

    @if(!empty($foundUsers))
        @foreach($foundUsers as $user)
            <div style=" border-width:1px; border-style:dotted; border-color:black; margin-bottom: 10px; padding: 15px; border-radius: 10px">
                <a href="{{ url('user/'.$user->id) }}">
                    <h3>{{$user->first_name}} {{$user->last_name}}</h3>
                </a>
                <p>{{$user->email}}</p>
                @if (Auth::user()->id != $user->id)
                    @if (Auth::user()->following()->where('id', $user->id)->count())
                        <a href="{{ url('follow/'.$user->id) }}">unfollow </a>
                    @else
                        <a href="{{ url('follow/'.$user->id) }}">follow </a>
                    @endif
                @endif
            </div>
        @endforeach
    @else
        <p>Aucun usager n'a été trouvé</p>
    @endif
@endsection