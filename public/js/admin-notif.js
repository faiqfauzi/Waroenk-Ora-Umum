let lastOrderCount = null;

async function checkOrders() {
    try {
        const res = await fetch("/admin/order-count-check");
        const data = await res.json();

        const currentCount = data.count;

        if (lastOrderCount !== null && currentCount > lastOrderCount) {

            // 🔊 Sound
            const audio = new Audio("/storage/sounds/new_order.mp3");
            audio.volume = 0.7;
            audio.play();

            // 🔢 Update badge manual
            const badge = document.querySelector('.fi-sidebar .fi-badge');
            if (badge) {
                badge.textContent = currentCount;
            }

            Swal.close(); 

            // 💬 Popup Toast
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Order Baru!',
                text: 'Ada pesanan masuk 🎉',
                showConfirmButton: false,
                showCloseButton: true,
                background: '#ffffff',
                customClass: {
                    popup: 'rounded-xl shadow-xl'
                }
            });
        }

        lastOrderCount = currentCount;

    } catch (e) {
        console.error("Polling error:", e);
    }
}

setInterval(checkOrders, 3000);