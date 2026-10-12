
document.addEventListener('DOMContentLoaded', function () {
    const selectedItems = document.getElementById('selected-items');
    const subtotalElement = document.getElementById('cart-subtotal');
    const totalElement = document.getElementById('cart-total');

    function formatRupiah(amount) {
        return 'Rp' + amount.toLocaleString('id-ID');
    }

    function calculateTotal() {
        let total = 0;
        let count = 0;

        document.querySelectorAll('.cart-card').forEach(function (card) {
            const checkbox = card.querySelector('.cart-check');
            const quantityInput = card.querySelector('.cart-quantity');

            if (!checkbox || !quantityInput || !checkbox.checked) {
                return;
            }

            const price = Number(card.dataset.price);
            const quantity = Math.max(
                0,
                Number(quantityInput.value) || 0
            );

            total += (Number.isFinite(price) ? price : 0) * quantity;
            count += quantity;
        });

        if (selectedItems) {
            selectedItems.textContent = count;
        }

        if (subtotalElement) {
            subtotalElement.textContent = formatRupiah(total);
        }

        if (totalElement) {
            totalElement.textContent = formatRupiah(total);
        }
    }

    document.querySelectorAll('.cart-check').forEach(function (checkbox) {
        checkbox.addEventListener('change', calculateTotal);
    });

    document.querySelectorAll('.cart-quantity').forEach(function (input) {
        input.addEventListener('input', calculateTotal);
        input.addEventListener('change', calculateTotal);
    });
    calculateTotal();

    console.log('Kalkulator keranjang berhasil diinisialisasi.');

    document.querySelectorAll('.auto-dismiss').forEach(function (notification) {
        setTimeout(function () {
            notification.style.transition = 'opacity 0.5s ease';
            notification.style.opacity = '0';

            setTimeout(function () {
                notification.remove();
            }, 500);
        }, 5000);
    });
});
