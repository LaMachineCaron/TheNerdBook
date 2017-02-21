{{ $user->first_name }}
{{ $user->last_name }}
{{ $user->email }}
@if (Auth::check())
    @if (Auth::user()->following()->where('id', $user->id)->count())
        <a href="{{ url('follow/' . $user->id) }}">Unfollow</a>
    @else
        <a href="{{ url('follow/' . $user->id) }}">Follow</a>
    @endif
    
    <div>
    	<h1>Personnes suivies</h1>
    	@if(!$user->following->isEmpty())
	    	@foreach($user->following as $following_user)
	    		<a href="{{ url('user/'.$following_user->id) }}">
		            <h2>{{$following_user->first_name}} {{$following_user->last_name}}</h2>
		        </a>
		        <p>{{$following_user->email}}</p>
			        @if (Auth::user()->id != $following_user->id)
				        @if (Auth::user()->following()->where('id', $following_user->id)->count())
				            <a href="{{ url('follow/'.$following_user->id) }}">unfollow </a>
				        @else
				            <a href="{{ url('follow/'.$following_user->id) }}">follow </a>
				        @endif
			        @endif
	    	@endforeach
	    @else
	    	<p>Rien</p>
    	@endif
    	
    	<h1>Suiveux</h1>
    	@if(!$user->followers->isEmpty())
	    	@foreach($user->followers as $follower)
	    		<a href="{{ url('user/'.$follower->id) }}">
		            <h2>{{$follower->first_name}} {{$follower->last_name}}</h2>
		        </a>
		        <p>{{$follower->email}}</p>
			        @if (Auth::user()->id != $follower->id)
				        @if (Auth::user()->following()->where('id', $follower->id)->count())
				            <a href="{{ url('follow/'.$follower->id) }}">unfollow </a>
				        @else
				            <a href="{{ url('follow/'.$follower->id) }}">follow </a>
				        @endif
			        @endif
	    	@endforeach
	    @else
	    	<p>Rien</p>
    	@endif
    </div>
@endif