document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.cart-check');
    const selectedItems = document.getElementById('selected-items');
    const subtotalElement = document.getElementById('cart-subtotal');
    const totalElement = document.getElementById('cart-total');

    function formatRupiah(amount) {
        return 'Rp' + amount.toLocaleString('id-ID');
    }

    function calculateTotal() {
        let total = 0;
        let count = 0;

        checkboxes.forEach(function (checkbox) {
            const card = checkbox.closest('.cart-card');

            if (!card || !checkbox.checked) return;

            const price = Number(card.dataset.price) || 0;
            const quantityInput = card.querySelector('.cart-quantity');
            const quantity = Math.max(
                0,
                Number(quantityInput.value) || 0
            );

            total += price * quantity;
            count += quantity;
        });

        selectedItems.textContent = count;
        subtotalElement.textContent = formatRupiah(total);
        totalElement.textContent = formatRupiah(total);
    }

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', calculateTotal);
    });

    document.querySelectorAll('.cart-quantity').forEach(function (input) {
        input.addEventListener('input', calculateTotal);
    });

    calculateTotal();
    console.log('KALKULATOR JALAN');
});


    // =========================
    // AUTO-FADE NOTIFICATION
    // =========================
    document.querySelectorAll('.auto-dismiss').forEach(function (notification) {
        setTimeout(function () {
            notification.style.transition = 'opacity 0.5s ease';
            notification.style.opacity = '0';

            setTimeout(function () {
                notification.remove();
            }, 500);
        }, 5000);
    });
