
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Hade</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="store-page">

    <nav class="store-navbar">
        <a href="{{ route('products.index') }}" class="store-logo">
            Hade<span>.</span>
        </a>

        <div class="store-nav-links">
            <a href="{{ route('products.index') }}">Home</a>
            <a href="#categories">Categories</a>
            <a href="{{ route('products.index') }}" class="active">Products</a>
        </div>

        <div class="store-nav-actions">
            <a href="{{ route('login') }}" class="store-login-btn">Login</a>
        </div>
    </nav>

    <main class="store-products">
        
    @if (session('success'))
        <p class="alert alert-success auto-dismiss">
            {{ session('success') }}
        </p>
    @endif

    @if (session('error'))
        <p class="alert alert-error auto-dismiss">
            {{ session('error') }}
        </p>
    @endif
        <h1>Our Products</h1>
        <p>Find the perfect stationery for your everyday needs.</p>

        <div class="store-product-grid">
            @forelse ($items as $item)
                <article class="store-product-card">
                    <div class="store-product-image">
                        <span>{{ strtoupper(substr($item->name, 0, 1)) }}</span>
                    </div>

                    <h2>{{ $item->name }}</h2>

                    <p class="store-product-price">
                        Rp{{ number_format($item->price, 0, ',', '.') }}
                    </p>

                    <p>Stock: {{ $item->stock }}</p>

                    <form action="{{ route('cart.add', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" {{ $item->stock < 1 ? 'disabled' : '' }}>
                            {{ $item->stock < 1 ? 'Out of Stock' : 'Add to Cart' }}
                        </button>
                    </form>
                </article>
            @empty
                <p>No products available yet.</p>
            @endforelse
        </div>
    </main>

    <footer class="store-footer">
        <a href="{{ route('products.index') }}" class="store-logo">
            Hade<span>.</span>
        </a>

        <p>Find what suits you.</p>

        <span>© {{ date('Y') }} Hade Store. All rights reserved.</span>
    </footer>

</body>
</html>
