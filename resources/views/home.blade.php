<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <div class="container">
        @if (Auth::check())
            <h1>Welcome, {{ Auth::user()->member_fullname }}!</h1>
            <p>You are logged in as {{ Auth::user()->member_username }}.</p>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        @else
            <h1>Welcome, Guest!</h1>
            <p>Please <a href="{{ route('login') }}">login</a> to continue.</p>
        @endif
    </div>
</body>
</html>