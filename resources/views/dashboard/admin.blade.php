<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hade | Dashboard</title>

    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
</head>
<body class="store-page">

    <nav class="store-navbar">
        <a href="{{ route('dashboard') }}" class="store-logo">
            Hade<span>.</span>
        </a>

        <div class="store-nav-links">
            <a href="{{ route('dashboard') }}" class="active">Dashboard</a>

            @if (in_array(auth()->user()->role, ['admin', 'staff'], true))
                <a href="{{ route('inventory.index') }}">Inventory</a>
            @endif

            @can('manage-roles')
                <a href="{{ route('admin.users.index') }}">Role Management</a>
            @endcan
        </div>

        <div class="store-nav-actions">
            <span class="store-user">
                {{ auth()->user()->username }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="store-login-btn">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="dashboard-main">
        <section class="dashboard-welcome">
            <div>
                <p class="dashboard-eyebrow">HADE / WORKSPACE</p>
                <h1>Welcome back, {{ auth()->user()->username }}.</h1>
                <p>
                    Manage store activities and monitor product inventory
                    through your Hade dashboard.
                </p>
            </div>

            <div class="dashboard-role">
                <span>YOUR ROLE</span>
                <strong>{{ ucfirst(auth()->user()->role) }}</strong>
            </div>
        </section>

        <section class="dashboard-section">
            <div class="dashboard-section-heading">
                <div>
                    <p class="dashboard-eyebrow">QUICK ACCESS</p>
                    <h2>Management Workspace</h2>
                </div>
                <span class="dashboard-section-note">Hade Store</span>
            </div>

            <div class="dashboard-grid">
                @if (in_array(auth()->user()->role, ['admin', 'staff'], true))
                    <article class="dashboard-card">
                        <div class="dashboard-card-icon">01</div>
                        <p class="dashboard-card-label">INVENTORY</p>
                        <h3>Inventory Management</h3>
                        <p class="dashboard-card-description">
                            Monitor product quantities, identify low-stock
                            items, and manage store inventory.
                        </p>
                        <a href="{{ route('inventory.index') }}"
                           class="dashboard-card-link">
                            Open Inventory <span>&rarr;</span>
                        </a>
                    </article>
                @endif

                @can('manage-roles')
                    <article class="dashboard-card">
                        <div class="dashboard-card-icon">02</div>
                        <p class="dashboard-card-label">USER ACCESS</p>
                        <h3>Role Management</h3>
                        <p class="dashboard-card-description">
                            View registered users and manage customer
                            and staff role assignments.
                        </p>
                        <a href="{{ route('admin.users.index') }}"
                           class="dashboard-card-link">
                            Manage Users <span>&rarr;</span>
                        </a>
                    </article>
                @endcan
            </div>
        </section>

        <section class="dashboard-note">
            <div class="dashboard-note-mark"></div>
            <div>
                <h3>Keep Everything Organized.</h3>
                <p>
                    Use the available menus according to your access
                    permissions to keep store operations organized.
                </p>
            </div>
        </section>
    </main>

    <footer class="store-footer">
        <a href="{{ route('dashboard') }}" class="store-logo">
            Hade<span>.</span>
        </a>
        <p>&copy; {{ date('Y') }} Hade Store</p>
        <span>Inventory &amp; Store Management</span>
    </footer>

</body>
</html>
