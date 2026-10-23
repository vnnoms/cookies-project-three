<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hade | Inventory Management</title>

    @vite(['resources/css/inventory.css', 'resources/js/app.js'])
</head>

<body class="inventory-page">

    <nav class="inventory-navbar">
        <a href="{{ route('dashboard') }}" class="inventory-logo">
            Hade<span>.</span>
        </a>

        <div class="inventory-nav-links">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('inventory.index') }}" class="active">
                Inventory
            </a>
        </div>

        <div class="inventory-account">
            <span>
                {{ Auth::user()->username }}
                <small>{{ ucfirst(Auth::user()->role) }}</small>
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="inventory-logout">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="inventory-container">

        <header class="inventory-header">
            <div>
                <p class="inventory-eyebrow">HADE / INVENTORY</p>
                <h1>Product Management</h1>
                <p>Maintain product in store.</p>
            </div>

            @can('manage-products')
                <a href="#add-product" class="inventory-add-button">
                    + Add Product
                </a>
            @endcan
        </header>

        @if (session('success'))
            <div class="inventory-alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="inventory-error">
                <strong>Validate.</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="inventory-stats">
            <article class="inventory-stat-card">
                <span> Total Product</span>
                <strong>{{ $items->count() }}</strong>
                <small>Registered Products.</small>
            </article>

            <article class="inventory-stat-card">
                <span>Stock is Almost Empty.</span>
                <strong>
                    {{ $items->filter(fn ($item) => $item->stock > 0 && $item->stock <= 5)->count() }}
                </strong>
                <small>Products with 1-5 units</small>
            </article>

            <article class="inventory-stat-card">
                <span>Product is Empty.</span>
                <strong>
                    {{ $items->filter(fn ($item) => $item->stock <= 0)->count() }}
                </strong>
                <small>Need Stock Renewal</small>
            </article>
        </section>

        @can('manage-products')
            <section class="inventory-add-card" id="add-product">
                <div class="inventory-section-heading">
                    <div>
                        <p class="inventory-eyebrow">ADMIN ONLY</p>
                        <h2>Add New Product</h2>
                    </div>
                    <span class="inventory-admin-badge">Admin</span>
                </div>

                <form
                    action="{{ route('inventory.store') }}"
                    method="POST"
                    class="inventory-product-form"
                >
                    @csrf

                    <div class="inventory-field">
                        <label for="name">Product Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Buku Tulis"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="inventory-field">
                        <label for="price">Price (Rp)</label>
                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="{{ old('price') }}"
                            placeholder="50000"
                            min="0"
                            step="0.01"
                            required
                        >
                    </div>

                    <div class="inventory-field">
                        <label for="stock">Initiated Stock</label>
                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            value="{{ old('stock', 0) }}"
                            min="0"
                            max="1000000"
                            required
                        >
                    </div>

                    <button type="submit" class="inventory-primary-button">
                        Save Product
                    </button>
                </form>
            </section>
        @endcan

        <section class="inventory-list-section">
            <div class="inventory-section-heading">
                <div>
                    <p class="inventory-eyebrow">PRODUCT CATALOG</p>
                    <h2>Product List</h2>
                </div>

                <span class="inventory-count">
                    {{ $items->count() }} Product
                </span>
            </div>

            <div class="inventory-table-wrapper">
                <table class="inventory-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Maintain stock</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>
                                    <div class="inventory-product-name">
                                        <span class="inventory-product-icon">
                                            {{ strtoupper(substr($item->name, 0, 1)) }}
                                        </span>

                                        <strong>{{ $item->name }}</strong>
                                    </div>
                                </td>

                                <td class="inventory-price">
                                    Rp{{ number_format($item->price, 0, ',', '.') }}
                                </td>

                                <td>
                                    <strong>{{ $item->stock }}</strong>
                                    <small class="inventory-unit">Unit</small>
                                </td>

                                <td>
                                    @if ($item->stock <= 0)
                                        <span class="inventory-badge out">
                                            Empty.
                                        </span>
                                    @elseif ($item->stock <= 5)
                                        <span class="inventory-badge low">
                                            Stock almost empty.
                                        </span>
                                    @else
                                        <span class="inventory-badge available">
                                            Available.
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @can('adjust-stock')
                                        <form
                                            action="{{ route('inventory.stock.update', $item->id) }}"
                                            method="POST"
                                            class="inventory-stock-form"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="number"
                                                name="stock"
                                                value="{{ $item->stock }}"
                                                min="0"
                                                max="1000000"
                                                aria-label="Stok {{ $item->name }}"
                                                required
                                            >

                                            <button type="submit">
                                                Save
                                            </button>
                                        </form>
                                    @else
                                        <span class="inventory-muted">
                                            Restricted. 
                                        </span>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="inventory-empty">
                                    There's no product to be displayed. 
                                    Admin can add new product on the form. 
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <footer class="inventory-footer">
            <span>&copy; {{ date('Y') }} Hade</span>
            <span>Inventory Management System</span>
        </footer>

    </main>

</body>
</html>
