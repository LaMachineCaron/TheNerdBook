

<h1>Liste des usagers qui commencent avec {{strtoupper($input)}}</h1>

@if(!empty($foundUsers))
    @foreach($foundUsers as $user)

    <div>
        <a href="{{ url('user/'.$user->id) }}">
            <h2>{{$user->first_name}} {{$user->last_name}}</h2>
        </a>
        <p>{{$user->email}}</p>

        @if (Auth::user()->id == $user->id)

        @elseif (Auth::user()->following()->where('id', $user->id)->count())
            <a href="{{ url('follow/'.$user->id) }}">unfollow </a>
        @else
            <a href="{{ url('follow/'.$user->id) }}">follow </a>
        @endif

    </div>

    @endforeach
@else
    <p>Aucun usager n'a été trouvé</p>
@endif

<style>
    div{
        border-style: solid;
    }
</style>