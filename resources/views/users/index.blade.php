<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Roles</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="container">
        <h1>User Roles</h1>

        @if (session('status'))
            <p>{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Current Role</th>
                    <th>Change Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if ($user->role !== 'admin')
                                <form method="POST"
                                    action="{{ route('admin.users.role.update', $user->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <select name="role" required>
                                        <option value="customer"
                                            @selected($user->role === 'customer')>
                                            Customer
                                        </option>
                                        <option value="staff"
                                            @selected($user->role === 'staff')>
                                            Staff
                                        </option>
                                    </select>

                                    <button type="submit">Change Role</button>
                                </form>
                            @else
                                <span>Admin role is protected.</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>
