<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hade | Products</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="store-page">

    <nav class="store-navbar">
        <a href="{{ route('dashboard') }}" class="store-logo">
            Hade<span>.</span>
        </a>

        <div class="store-nav-links">
            <a href="{{ route('dashboard') }}">Home</a>
            <a href="{{ route('products.index') }}" class="active">Products</a>
            <a href="{{ route('cart.index') }}">My Cart</a>
        </div>

        <a href="{{ route('cart.index') }}" class="store-registry-btn">
            View Cart
        </a>
    </nav>

    <main class="store-products">
        <h1>Our Products</h1>

        <p>
            Discover stationery essentials for your study, work,
            and everyday creativity.
        </p>

        @if (session('success'))
            <div class="store-notice">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="store-notice">
                {{ session('error') }}
            </div>
        @endif

        <section class="store-product-grid">
            @forelse ($items as $item)
                <article class="store-product-card">

                    <div class="store-product-image">
                        <span>
                            {{ strtoupper(substr($item->name, 0, 1)) }}
                        </span>
                    </div>

                    <h2>{{ $item->name }}</h2>

                    <p class="store-product-price">
                        Rp{{ number_format($item->price, 0, ',', '.') }}
                    </p>

                    <p>
                        @if ($item->stock > 0)
                            Stock: {{ $item->stock }} units
                        @else
                            Out of stock
                        @endif
                    </p>

                    @if ($item->stock > 0)
                        <form
                            action="{{ route('cart.add', $item->id) }}"
                            method="POST"
                        >
                            @csrf

                            <button type="submit">
                                Add to Cart
                            </button>
                        </form>
                    @else
                        <button type="button" disabled>
                            Out of Stock
                        </button>
                    @endif

                </article>
            @empty
                <p>No products available yet.</p>
            @endforelse
        </section>
    </main>

    <footer class="store-footer">
        <p>&copy; {{ date('Y') }} Hade Store</p>
        <p>Made for your everyday needs.</p>
    </footer>

</body>
</html>
