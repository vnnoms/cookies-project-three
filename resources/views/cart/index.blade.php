
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Hade</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="cart-page">

    {{-- Navbar --}}
    <nav class="store-navbar">
        <a href="{{ route('products.index') }}" class="store-logo">
            Hade<span>.</span>
        </a>

        <div class="store-nav-links">
            <a href="{{ route('dashboard') }}">Home</a>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('cart.index') }}" class="active">Cart</a>
        </div>

        <a href="{{ route('products.index') }}" class="return-button">
            Return
        </a>
    </nav>

    {{-- Main Content --}}
    <main class="cart-container">

        <header class="cart-heading">
            <h1>My Shopping Cart</h1>
            <p>Review your selected items before checkout.</p>
        </header>

        {{-- Notifications --}}
        @if (session('success'))
            <div class="cart-alert cart-alert-success auto-dismiss">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="cart-alert cart-alert-error auto-dismiss">
                {{ session('error') }}
            </div>
        @endif

        @php
            $cart = $cart ?? session('cart', []);
        @endphp

        @if (count($cart) > 0)

            <div class="cart-layout">

                {{-- Product List --}}
                <section class="cart-items">

                    @foreach ($cart as $id => $item)

                        <article
                            class="cart-card"
                            data-price="{{ $item['price'] }}"
                        >

                            {{-- Checkbox --}}
                            <input
                                type="checkbox"
                                class="cart-check"
                                checked
                                aria-label="Select {{ $item['name'] }}"
                            >

                            {{-- Product Image --}}
                            <div class="cart-product-image">
                                {{ strtoupper(substr($item['name'], 0, 1)) }}
                            </div>

                            {{-- Product Information --}}
                            <div class="cart-product-info">
                                <h2>{{ $item['name'] }}</h2>

                                <p class="cart-product-price">
                                    Rp{{ number_format($item['price'], 0, ',', '.') }}
                                </p>

                                <p class="cart-product-stock">
                                    Quantity: {{ $item['quantity'] }}
                                </p>
                            </div>

                            {{-- Quantity and Actions --}}
                            <div class="cart-card-bottom">

                                <form
                                    action="{{ route('cart.update', $id) }}"
                                    method="POST"
                                    class="cart-quantity-form"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <label for="quantity-{{ $id }}">
                                        Qty:
                                    </label>

                                    <input
                                        type="number"
                                        id="quantity-{{ $id }}"
                                        name="quantity"
                                        class="cart-quantity"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                        required
                                    >

                                    <button
                                        type="submit"
                                        class="cart-btn cart-btn-primary"
                                    >
                                        Update
                                    </button>
                                </form>

                                <form
                                    action="{{ route('cart.remove', $id) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="cart-btn cart-btn-remove"
                                    >
                                        Remove
                                    </button>
                                </form>

                            </div>

                        </article>

                    @endforeach

                </section>

                {{-- Order Summary --}}
                <aside class="cart-summary">

                    <h2>Order Summary</h2>

                    <div class="cart-summary-row">
                        <span>Selected Items</span>
                        <span id="selected-items">0</span>
                    </div>

                    <div class="cart-summary-row">
                        <span>Subtotal</span>
                        <span id="cart-subtotal">Rp0</span>
                    </div>

                    <div class="cart-summary-row cart-summary-total">
                        <span>Total</span>
                        <span id="cart-total">Rp0</span>
                    </div>

                    <p class="cart-summary-note">
                        The total is calculated from the products you select.
                        Checkout is not available yet.
                    </p>

                    <a
                        href="{{ route('products.index') }}"
                        class="cart-btn cart-btn-primary cart-continue"
                    >
                        Continue Shopping
                    </a>

                </aside>

            </div>

        @else

            {{-- Empty Cart --}}
            <section class="cart-empty">

                <div class="cart-empty-icon">🛒</div>

                <h2>Your cart is empty</h2>

                <p>
                    Looks like you haven't added anything to your cart yet.
                </p>

                <a
                    href="{{ route('products.index') }}"
                    class="cart-btn cart-btn-primary"
                >
                    Explore Products
                </a>

            </section>

        @endif

    </main>

    {{-- Footer --}}
    <footer class="cart-footer">

        <a href="{{ route('products.index') }}" class="store-logo">
            Hade<span>.</span>
        </a>

        <p>Find what suits you.</p>

        <p>&copy; {{ date('Y') }} Hade. All rights reserved.</p>

    </footer>

</body>
</html>
