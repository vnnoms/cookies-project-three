
let cart = {};

async function post(url, payload) {
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector(
                'meta[name="csrf-token"]'
            ).content
        },
        body: JSON.stringify(payload)
    });

    const data = await response.json();

    if (!response.ok) {
        throw new Error(JSON.stringify(data, null, 2));
    }

    return data;
}

async function add(id) {
    try {
        const data = await post(
            '/stateless-cart/add',
            {
                cart: cart,
                product_id: id
            }
        );

        cart = Object.fromEntries(
            data.items.map(item => [item.id, item.quantity])
        );

        render(data);
    } catch (error) {
        showError(error);
    }
}

async function recalculate() {
    if (Object.keys(cart).length === 0) {
        alert('Keranjang kosong.');
        return;
    }

    try {
        const data = await post(
            '/stateless-cart/update',
            { cart: cart }
        );

        render(data);
    } catch (error) {
        showError(error);
    }
}

function render(data) {
    const container = document.getElementById('items');

    container.replaceChildren();

    if (data.items.length === 0) {
        const empty = document.createElement('p');
        empty.className = 'empty';
        empty.textContent = 'Keranjang masih kosong.';
        container.appendChild(empty);
    }

    data.items.forEach(item => {
        const row = document.createElement('p');
        row.className = 'cart-item';

        row.textContent =
            `${item.name} × ${item.quantity} = Rp` +
            item.subtotal.toLocaleString('id-ID');

        container.appendChild(row);
    });

    document.getElementById('total').textContent =
        'Total: Rp' + data.total.toLocaleString('id-ID');

    document.getElementById('response').textContent =
        JSON.stringify(data, null, 2);
}

function clearCart() {
    cart = {};

    render({
        items: [],
        total: 0
    });

    document.getElementById('response').textContent =
        'Keranjang dikosongkan di browser. Belum ada request ke Laravel.';
}

function showError(error) {
    document.getElementById('response').textContent =
        'Terjadi kesalahan:\n' + error.message;
}
