<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome to the Admin Dashboard</h1>

    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <a href="{{ route('admin.membersTable') }}"><button>Members</button></a>
</body>
</html>