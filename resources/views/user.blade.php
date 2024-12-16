<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container1 {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header1 {
            padding: 20px 0;
            text-align: center;
        }
        .header h2 {
            font-size: 2em;
            color: #333;
        }
        .btn1 {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn1:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .actions {
            display: flex;
            gap: 8px;
        }
    </style>
</head>
<body>
    <div class="container1">
        <div class="header1">
            <h2>User Information</h2>
            <a href="/users-create" class="btn1">Add a User</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['age'] }}</td>
                        <td>{{ $user['title'] }}</td>
                        <td>{{ $user['description'] }}</td>
                        <td>{{ $user['date_published'] }}</td>
                        <td class="actions">
                            <a href="/users/{{ $user['id'] }}" class="btn">View</a>
                            <a href="/users/{{ $user['id'] }}/edit" class="btn">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
