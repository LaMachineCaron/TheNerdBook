<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>Laravel</title>
    </head>
    <body>
        <form role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <input name="email">
            <input name="password">
            <button type="submit">Login</button>
        </form>
        <form role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <input name="first_name">
            <input name="last_name">
            <input name="email">
            <input name="password">
            <input name="password_confirmation">
            <button type="submit">Register</button>
        </form>
    </body>
</html>
