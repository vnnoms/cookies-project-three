
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="store-page">

    <!-- Navbar -->
    <nav class="store-navbar">
        <a href="{{ route('dashboard') }}" class="store-logo">
            Hade<span>.</span>
        </a>

        <div class="store-nav-links">
            <a href="{{ route('dashboard') }}">Home</a>
            <a href="#kategori">Categories</a>
            <a href="{{ route('products.index') }}">Products</a>
        </div>

        </div>

        <div class="store-nav-actions">
            @auth
                <span class="store-user">
                    Halo, {{ Auth::user()->full_name ?? Auth::user()->username }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="store-login-btn">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="store-login-btn">
                    Login
                </a>
            @endauth
        </div>
    </nav>
    
    <!-- Footer -->
    <footer class="store-footer">
        <a href="#beranda" class="store-logo">
            Hade<span>.</span>
        </a>

        <p>Find what suits you.</p>

        <span>© {{ date('Y') }} Assalammualaikum. All rights reserved.</span>
    </footer>

</body>
</html>
