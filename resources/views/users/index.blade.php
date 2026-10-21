
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Role Management | Hade</title>

    @vite(['resources/css/user-role.css', 'resources/js/app.js'])
</head>

<body class="users-page">
    <main class="users-container">

        <!-- Header -->
        <header class="users-header">
            <div>
                <p class="users-eyebrow">HADE / ADMINISTRATION</p>

                <h1>User Role Management</h1>

                <p class="users-description">
                    Accesibbility surveillance. 
                </p>
            </div>
        </header>

        <!-- Notifications -->
        @if (session('status'))
            <div class="notice" role="status">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <ul class="error-list" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <!-- User Summary -->
        <section class="users-summary">
            <span class="summary-number">{{ $users->count() }}</span>

            <div>
                <div class="summary-label">Total Users</div>
                <strong>Registered at Hade.</strong>
            </div>
        </section>

        <!-- Users Table -->
        <div class="users-table-wrapper">
            <table class="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Current Role</th>
                        <th>Change Role</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="user-id">
                                #{{ $user->id }}
                            </td>

                            <td class="username">
                                {{ $user->username }}
                            </td>

                            <td>
                                <span class="role-badge {{ $user->role }}">
                                    {{ $user->role }}
                                </span>
                            </td>

                            <td>
                                @if ($user->role !== 'admin')
                                    <form
                                        method="POST"
                                        class="role-form"
                                        action="{{ route('admin.users.role.update', $user->id) }}"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <select
                                            name="role"
                                            class="role-select"
                                            aria-label="Pilih role untuk {{ $user->username }}"
                                            required
                                        >
                                            <option
                                                value="customer"
                                                @selected($user->role === 'customer')
                                            >
                                                Customer
                                            </option>

                                            <option
                                                value="staff"
                                                @selected($user->role === 'staff')
                                            >
                                                Staff
                                            </option>
                                        </select>

                                        <button
                                            type="submit"
                                            class="role-button"
                                        >
                                            Change Role
                                        </button>
                                    </form>
                                @else
                                    <span class="protected-role">
                                        Admin role is protected
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-state">
                                No users is registered. 
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <footer class="users-footer">
            <span>&copy; {{ date('Y') }} Hade</span>
            <span>User Role Management</span>
        </footer>

    </main>
</body>
</html>
