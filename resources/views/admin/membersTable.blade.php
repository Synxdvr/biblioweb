<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members Table</title>
</head>
<body>
    <h1>Members List</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Contact Information</th>
            <th>Address</th>
        </tr>
        @foreach ($members as $member)
        <tr>
            <td>{{ $member->member_name }}</td>
            <td>{{ $member->contact_information }}</td>
            <td>{{ $member->address }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>