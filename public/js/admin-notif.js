let lastOrderCount = null;

async function checkOrders() {
    try {
        const res = await fetch("/admin/order-count-check");
        const data = await res.json();

        const currentCount = data.count;

        // PLAY SOUND jika ada order masuk (count naik)
        if (lastOrderCount !== null && currentCount > lastOrderCount) {
            const audio = new Audio("/storage/sounds/new_order.mp3");
            audio.volume = 0.7;
            audio.play();
        }

        // REFRESH BADGE jika count berubah (naik atau turun)
        if (lastOrderCount !== null && currentCount !== lastOrderCount) {

            // cara aman untuk Filament 3
            window.dispatchEvent(new CustomEvent('filament-refresh-navigation', {
                bubbles: true
            }));

            console.log("Navigation refreshed");
        }

        lastOrderCount = currentCount;

    } catch (e) {
        console.error("Polling error:", e);
    }
}

setInterval(checkOrders, 3000); // 3 detik
