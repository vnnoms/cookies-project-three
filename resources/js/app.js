import './bootstrap';


import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const notifications = document.querySelectorAll('.auto-dismiss');

    notifications.forEach(function (notification) {
        setTimeout(function () {
            notification.style.transition = 'opacity 0.5s ease';
            notification.style.opacity = '0';

            setTimeout(function () {
                notification.remove();
            }, 500);
        }, 5000);
    });
});

