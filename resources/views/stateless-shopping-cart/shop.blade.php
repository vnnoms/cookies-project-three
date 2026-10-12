
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Stateless Shopping Cart</title>

    <link rel="stylesheet" href="{{ asset('stateless-shopping-cart/css/shop.css') }}">
    <script src="{{ asset('stateless-shopping-cart/js/shop.js') }}" defer></script>

</head>
<body>
    <main class="container">
        <header class="header">
            <p class="eyebrow">LARAVEL PRAKTIKUM</p>
            <h1>Stateless Shopping Cart</h1>
            <p>Belanja sederhana tanpa menyimpan keranjang di session atau cookie.</p>
        </header>

        <div class="layout">
            <section class="panel">
                <h2>Daftar Produk</h2>

                <article class="product">
                    <div>
                        <h3>Buku Tulis</h3>
                        <p>Rp5.000</p>
                    </div>
                    <button onclick="add(1)">+ Tambah</button>
                </article>

                <article class="product">
                    <div>
                        <h3>Pulpen</h3>
                        <p>Rp3.000</p>
                    </div>
                    <button onclick="add(2)">+ Tambah</button>
                </article>

                <article class="product">
                    <div>
                        <h3>Penggaris</h3>
                        <p>Rp4.000</p>
                    </div>
                    <button onclick="add(3)">+ Tambah</button>
                </article>
            </section>

            <section class="panel">
                <h2>Keranjang Belanja</h2>

                <div id="items">
                    <p class="empty">Keranjang masih kosong.</p>
                </div>

                <h3 id="total">Total: Rp0</h3>

                <div class="cart-buttons">
                    <button class="secondary" onclick="recalculate()">
                        Hitung Ulang
                    </button>
                    <button class="danger" onclick="clearCart()">
                        Kosongkan Keranjang
                    </button>
                </div>
            </section>
        </div>

        <section class="panel response-panel">
            <h2>Respons Laravel</h2>
            <pre id="response">Belum ada request.</pre>
        </section>
    </main>
</body>
</html>
