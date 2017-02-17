{{ $user->first_name }}
{{ $user->last_name }}
{{ $user->email }}
@if (Auth::check())
    @if (Auth::user()->following()->where('id', $user->id)->count())
        <a href="{{ url('follow/' . $user->id) }}">Unfollow</a>
    @else
        <a href="{{ url('follow/' . $user->id) }}">Follow</a>
    @endif
@endif