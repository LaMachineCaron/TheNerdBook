

<h1>Liste des usagers qui commencent avec {{strtoupper($input)}}</h1>

@if(!empty($foundUsers))
    @foreach($foundUsers as $user)
    <div>
        <h2>{{$user->first_name}} {{$user->last_name}}</h2>
        <p>{{$user->email}}</p>
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