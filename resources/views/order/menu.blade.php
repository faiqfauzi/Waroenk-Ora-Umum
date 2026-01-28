@extends('layouts.app')

@section('title', 'Menu')

@section('content')
    {{-- Header Image --}}
    <div class="header-img">
        <img src="{{ asset('storage/bg_menu/header.png') }}" alt="Header Image">
    </div>
    
    <div class="profile-section">
        <div class="profile-icon">
            <img src="{{ asset('storage/bg_menu/profile.jpeg') }}" alt="Profile Image">
        </div>
        <div class="profile-text">
            <h1 id="restaurantName">Waroenk Ora Umum</h1>
            <p>{{ $table->name }}</p>
        </div>
    </div>


    <div class="divider"></div>

    {{-- Categories Section --}}
    <div id="categoryPills">
        @foreach ($categories as $category)
            <button class="category-pill" data-category-id="{{ $category->id }}">
            {{ $category->name }}
            </button>
        @endforeach
    </div>

    {{-- Menu Container --}}
    <div id="menuContainer">
        {{-- Menampilkan menu untuk setiap kategori --}}
    </div>

    {{-- Menu Item Details Container --}}

    <!-- Menu Item Details Popup -->
<div id="menuItemDetailsPopup">
    <div class="menu-item-detail-popup">
        <img id="detailImage" src="" alt="Item Image">
        <h2 id="detailName"></h2>
        <p id="detailPrice"></p></p>
        <p id="detailDescription"></p>
        <button id="backButtonPopup">Kembali</button>
    </div>
</div>

    

    {{-- Cart Button --}}
    <button class="cart-button" id="cartButton" aria-label="Open shopping cart" style="background: #c62828;">
        🛒
        <span class="cart-badge" id="cartBadge" style="display: none;">0</span>
    </button>

    @include('partials.cart')
    @include('partials.payment')

    {{-- Success Modal --}}
    <div class="cart-modal" id="successModal">
    <div class="cart-content success-content">
        
        <div class="success-icon" id="successIcon">✓</div>

        <h2 class="success-title" id="successTitle">Pembayaran Berhasil!</h2>

        <p class="success-message" id="successMessage">Terima kasih atas pesanan Anda</p>

        <div class="success-details" id="successDetails"></div>

        <button class="checkout-btn" id="backToHomeBtn" style="background: #666; margin-top: 10px;">
            Kembali ke Beranda
        </button>

    </div>
</div>


    {{-- Toast Notification --}}
    {{-- <div class="toast" id="toast">
        <span>✓</span> <span id="toastMessage">Item ditambahkan ke keranjang</span>
    </div> --}}

@endsection

@push('scripts')
<script>
    const categories = @json($categories);

    const menuItems = categories.reduce((acc, category) => {
        acc[category.id] = category.menus.map(menu => ({
            id: menu.id,
            name: menu.name || 'Unknown Item',
            price: menu.price || 0,
            // icon: menu.icon || '🍽️',
            menu_image: menu.menu_image || 'default_image.jpg',
            description: menu.description || 'Deskripsi tidak tersedia'
        }));
        return acc;
    }, {});

    let cart = [];
    let activeCategory = categories[0].id;

    function renderCategories() {
        const pillsContainer = document.getElementById('categoryPills');
        pillsContainer.innerHTML = '';

        categories.forEach(category => {
            const pill = document.createElement('button');
            pill.className = 'category-pill';
            pill.dataset.categoryId = category.id;
            pill.textContent = `${category.name}`;

            if (category.id === activeCategory) {
                pill.classList.add('active');
                pill.style.background = '#c62828';
                pill.style.color = 'white';
            } else {
                pill.style.background = '#ffffff';
                pill.style.color = '#333333';
            }

            pill.addEventListener('click', function () {
                activeCategory = category.id;
                renderCategories();
                renderMenu();
            });

            pillsContainer.appendChild(pill);
        });
    }

    function renderMenu() {
    const container = document.getElementById('menuContainer');
    container.innerHTML = ''; // Clear any existing content

    const currentItems = menuItems[activeCategory] || [];

    currentItems.forEach(item => {
        const card = document.createElement('div');
        card.className = 'menu-card';

        const iconHTML = item.menu_image
            ? `<img src="/storage/${item.menu_image}" alt="${item.name} Icon" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">`
            : item.icon;

        card.innerHTML = `
            <div class="menu-info">
                <div class="menu-icon">${iconHTML}</div>
                <div class="menu-text">
                    <h5>${item.name}</h5>
                    <p>Rp ${item.price.toLocaleString('id-ID')}</p>
                </div>
            </div>
            <button class="add-btn" data-id="${item.id}" aria-label="Add ${item.name} to cart">+</button>
        `;
        container.appendChild(card);
document.querySelectorAll('.add-btn').forEach(btn => {
        btn.onclick = (e) => {
            e.stopPropagation(); // Agar tidak memicu detail modal
            addToCart(parseInt(btn.dataset.id));
        };
    });

        // One-click functionality: show item details when clicked
        card.addEventListener('click', function () {
            showItemDetailsPopup(item);
        });
    });
}

 


   function showItemDetailsPopup(item) {
    const detailsContainer = document.getElementById('menuItemDetailsPopup');
    const detailImage = document.getElementById('detailImage');
    const detailName = document.getElementById('detailName');
    const detailPrice = document.getElementById('detailPrice');
    const detailDescription = document.getElementById('detailDescription');
    const backButton = document.getElementById('backButtonPopup');

    // Set the item details
    detailImage.src = `/storage/${item.menu_image || 'default_image.jpg'}`;
    detailName.textContent = item.name;
    detailPrice.textContent = `Rp ${item.price.toLocaleString('id-ID')}`;
    detailDescription.textContent = item.description || "Deskripsi tidak tersedia";

    // Show the details popup
    detailsContainer.style.display = 'flex';

    // Back Button functionality (close the popup)
    backButton.addEventListener('click', function () {
        detailsContainer.style.display = 'none';
    });
}

    function addToCart(itemId) {
        let item = null;
        for (let category in menuItems) {
            item = menuItems[category].find(i => i.id === itemId);
            if (item) break;
        }

        if (!item) return;

        const existingItem = cart.find(i => i.id === itemId);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({ ...item, quantity: 1 });
        }

        updateCart();
        showToast(`${item.name} ditambahkan!`);
    }

    function updateCart() {
        const badge = document.getElementById('cartBadge');
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

        if (totalItems > 0) {
            badge.style.display = 'flex';
            badge.textContent = totalItems;
        } else {
            badge.style.display = 'none';
        }

        renderCart();
    }

    function renderCart() {
    const cartItemsContainer = document.getElementById('cartItems');
    const cartFooter = document.getElementById('cartFooter');

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = `
            <div class="empty-cart">
                <div class="empty-cart-icon">🛒</div>
                <p>Keranjang belanja Anda masih kosong</p>
            </div>
        `;
        cartFooter.style.display = 'none';
        return;
    }

    cartFooter.style.display = 'block';
    cartItemsContainer.innerHTML = '';

    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.innerHTML = `
            <div class="cart-item-info">
                <h6> ${item.name}</h6>
                <p>Rp ${item.price.toLocaleString('id-ID')}</p>
            </div>
            <div class="cart-item-controls">
                <button class="qty-btn" data-id="${item.id}" data-action="decrease">−</button>
                <span class="qty-display">${item.quantity}</span>
                <button class="qty-btn" data-id="${item.id}" data-action="increase">+</button>
            </div>
        `;
        cartItemsContainer.appendChild(cartItem);
    });

    document.querySelectorAll('.qty-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const itemId = parseInt(this.dataset.id);
            const action = this.dataset.action;
            updateQuantity(itemId, action);
        });
    });

    // PERHITUNGAN BARU
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const tax = Math.floor(subtotal * 0.10); // Pajak 10%
    const total = subtotal + tax;

    // UPDATE UI BARU
    document.getElementById('cartSubtotal').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
    document.getElementById('cartTax').textContent = `Rp ${tax.toLocaleString('id-ID')}`;
    document.getElementById('cartTotal').textContent = `Rp ${total.toLocaleString('id-ID')}`;
}


    function updateQuantity(itemId, action) {
        const item = cart.find(i => i.id === itemId);

        if (action === 'increase') {
            item.quantity++;
        } else if (action === 'decrease') {
            item.quantity--;
            if (item.quantity === 0) {
                cart = cart.filter(i => i.id !== itemId);
            }
        }

        updateCart();
    }

    function showToast(message) {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');
        toastMessage.textContent = message;
        toast.classList.add('show');

        setTimeout(() => {
            toast.classList.remove('show');
        }, 2000);
    }
const defaultConfig = {
    primary_action_color: "#c62828", // Set warna default untuk aksi utama
};
    function renderPaymentSummary() {
    const summaryContainer = document.getElementById('paymentSummary');
    summaryContainer.innerHTML = '';
     console.log('Carttt Contents:', cart);  // Clear previous summary if any

    if (cart.length === 0) {
        summaryContainer.innerHTML = '<p>No items in your cart.</p>';
        return;
    }

    // Loop through the cart and create summary items
    cart.forEach(item => {
        const summaryItem = document.createElement('div');
        summaryItem.className = 'payment-summary-item';
        summaryItem.innerHTML = `
            <div class="payment-summary-item-name">
                <span> ${item.name}</span>
                <span class="payment-summary-qty">x${item.quantity}</span>
            </div>
            <span style="font-weight: 600; color: ${defaultConfig.primary_action_color};">Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</span>
        `;
        summaryContainer.appendChild(summaryItem);
    });

    // Calculate the total amount
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const tax = Math.floor(subtotal * 0.10);
    const total = subtotal + tax;

    document.getElementById('paymentSubtotal').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
    document.getElementById('paymentTax').textContent = `Rp ${tax.toLocaleString('id-ID')}`;
    document.getElementById('paymentTotal').textContent = `Rp ${total.toLocaleString('id-ID')}`;
}

    document.getElementById('paymentProof').addEventListener('change', function (e) {

    document.getElementById('proofError').style.display = 'none';
    const file = e.target.files[0];
    if (!file) return;

    const previewUrl = URL.createObjectURL(file);

    const previewImg = document.getElementById('uploadPreview');
    previewImg.src = previewUrl;
    previewImg.style.display = "block";
    });


    // Open Cart Modal
    document.getElementById('cartButton').addEventListener('click', function () {
        document.getElementById('cartModal').classList.add('active');
    });

    // Close Cart Modal
    document.getElementById('closeCart').addEventListener('click', function () {
        document.getElementById('cartModal').classList.remove('active');
    });

    document.getElementById('closePayment').addEventListener('click', function () {
        document.getElementById('paymentModal').classList.remove('active');
    });

    // Show Payment Modal on Checkout
    document.getElementById('checkoutBtn').addEventListener('click', function () {
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;
        window.selectedPaymentMethod = selectedMethod;

        document.getElementById('cartModal').classList.remove('active');
        document.getElementById('paymentModal').classList.add('active');
        
        renderPaymentSummary();
        applyPaymentMethod(); 
    });

    // Confirm Payment (on modal close)
    document.getElementById('paymentBtn').addEventListener('click', function () {

    const method = document.querySelector('input[name="payment_method"]:checked')?.value;
    const proofInput = document.getElementById('paymentProof');
    const proofError = document.getElementById('proofError');

    // VALIDASI khusus QRIS
    if (method === 'qris' && (!proofInput.files || proofInput.files.length === 0)) {
        proofError.style.display = 'block';  // tampilkan pesan
        document.getElementById('qrisSection').scrollIntoView({
            behavior: 'smooth',
            block: 'center' // agar posisi pas di tengah layar
        });
        return; // stop submit
    }

    proofError.style.display = 'none';

    const tableId = {{ $table->id }};
    const paymentMethod = window.selectedPaymentMethod; // qris atau kasir

    // Hitung subtotal, pajak, total
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const tax = Math.floor(subtotal * 0.10);
    const total = subtotal + tax;

    const orderNotes = document.getElementById('orderNotes').value;

    // Karena ada file upload -> gunakan FormData, bukan JSON
    const formData = new FormData();

    formData.append('items', JSON.stringify(cart));
    formData.append('subtotal', subtotal);
    formData.append('tax', tax);
    formData.append('total', total);
    formData.append('method', paymentMethod);
    formData.append('notes', orderNotes);

    // Kalau metode QRIS, sertakan bukti pembayaran
    if (paymentMethod === 'qris') {
        const proofFile = document.getElementById('paymentProof').files[0];
        formData.append('proof', proofFile);
    }

    fetch(`/payment/manual/${tableId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // penting!
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
    if (data.success) {

        // Kirim method ke success modal
            const method = window.selectedPaymentMethod;
        
            showSuccessModal(method, data.order_id);
        
            // Kosongkan cart
            cart = [];
            updateCart();
        } else {
            alert("Terjadi kesalahan saat menyimpan pesanan.");
        }
    });


});


    function applyPaymentMethod() {
    if (window.selectedPaymentMethod === "qris") {
        document.getElementById("qrisSection").style.display = "block";
        document.getElementById("kasirSection").style.display = "none";
    } else {
        document.getElementById("qrisSection").style.display = "none";
        document.getElementById("kasirSection").style.display = "block";
    }
    }

    const fileInput = document.getElementById('paymentProof');
    const previewImg = document.getElementById('uploadPreview');
    const removeBtn = document.getElementById('removeImageBtn');

    fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

        // Validasi tipe file
        if (!allowedTypes.includes(file.type)) {
            alert("Format gambar harus JPG atau PNG.");
            fileInput.value = "";
            previewImg.style.display = "none";
            removeBtn.style.display = "none";
            return;
        }

        // Validasi ukuran file: maks 5 MB
        if (file.size > 5 * 1024 * 1024) {
            alert("Ukuran file maksimal 5MB.");
            fileInput.value = "";
            previewImg.style.display = "none";
            removeBtn.style.display = "none";
            return;
        }

        // Tampilkan preview
        const previewUrl = URL.createObjectURL(file);
        previewImg.src = previewUrl;
        previewImg.style.display = "block";
        removeBtn.style.display = "block";
    });

    // Tombol hapus gambar
    removeBtn.addEventListener('click', function () {
        fileInput.value = "";
        previewImg.src = "";
        previewImg.style.display = "none";
        removeBtn.style.display = "none";
    });

    document.getElementById('backToHomeBtn').addEventListener('click', function () {
    // Tutup modal success
    document.getElementById('successModal').classList.remove('active');

    // Kosongkan cart (agar tidak double)
    cart = [];
    updateCart();

    // Redirect ke halaman menu utama
    window.location.href = "/table/{{ $table->id }}";
});


function showSuccessModal(method, orderId) {
    const modal = document.getElementById('successModal');
    const details = document.getElementById('successDetails');

    const icon   = document.getElementById('successIcon');
    const title  = document.getElementById('successTitle');
    const msg    = document.getElementById('successMessage');

    modal.classList.add('active');

    if (method === 'qris') {
        icon.style.display = 'flex';
        title.style.display = 'block';
        msg.style.display = 'block';
        details.innerHTML = `
            <div>
                <p><strong>Order ID:</strong> ${orderId}</p>
                <p>Pesanan Anda sedang diproses.</p>
            </div>
        `;
    } else {
        icon.style.display = 'none';
        title.style.display = 'none';
        msg.style.display = 'none';
        details.innerHTML = `
            <div style="text-align:center;">
                <h3 style="font-size: 22px; margin-bottom: 10px;">Silahkan Lanjutkan Pembayaran Di Kasir</h3>

                <p style="font-size: 35px; font-weight: bold; margin: 20px 0;">
                    {{ $table->name }}
                </p>

                <p style="margin-top: 10px;">
                    <strong>Total Pembayaran:</strong> 
                    Rp ${document.getElementById('paymentTotal').textContent.replace("Rp ","")}
                </p>
            </div>
        `;
    }
}


    // Initialize the page
    renderCategories();
    renderMenu();
    updateCart();
</script>
@endpush
