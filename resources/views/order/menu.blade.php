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

    <div id="menuContainer">
        {{-- Menampilkan menu untuk setiap kategori --}}
    </div>

    {{-- Menu Item Details Container --}}

    <!-- Menu Item Details Popup -->
<div id="menuItemDetailsPopup">
    <div class="menu-item-detail-popup">
        <img id="detailImage" src="" alt="Item Image">
        <h2 id="detailName"></h2>
        <p id="detailPrice"></p>
        <p id="detailDescription"></p>
        <button id="backButtonPopup">Kembali</button>
    </div>
</div>

    <!-- Menu Option Modal -->
<div id="optionModal" class="option-modal">
    <div class="option-sheet">

        <div class="option-header">
            <h3 id="optionMenuTitle"></h3>
            <button id="closeOptionModal">&times;</button>
        </div>

        <div id="optionContainer"></div>

        <div class="option-total">
            <strong>Total:</strong>
            <span id="optionTotalPrice"></span>
        </div>

        <button id="confirmOptionBtn" class="option-confirm-btn">
            Tambah ke Keranjang
        </button>

    </div>
</div>

<button id="subNavBtn" class="subnav-float">
    📑
</button>
<div id="subNavPanel" class="subnav-panel">
    <div id="subNavList"></div>
</div>

<div id="bottomCartBar" class="bottom-cart-bar">
    <div class="cart-bar-content">
        <span id="bottomCartText">
            🛒 0 Item
        </span>

        <strong id="bottomCartTotal">
            Rp 0
        </strong>
    </div>
</div>

    @include('partials.cart')
    @include('partials.payment')


    {{-- Success Modal --}}
    <div class="cart-modal" id="successModal">
    <div class="cart-content success-content">
        
        <div class="success-icon" id="successIcon">✓</div>

        <h2 class="success-title" id="successTitle">Pembayaran Berhasil!</h2>

        <p class="success-message" id="successMessage">
            Terima kasih atas pesanan Anda
        </p>

        <div class="success-details" id="successDetails"></div>

        <button class="checkout-btn" id="backToHomeBtn"
            style="background: #666; margin-top: 10px;">
            Kembali ke Beranda
        </button>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('closeOptionModal')
        .addEventListener('click', function() {
            document.getElementById('optionModal').classList.remove('active');
        });

    document.getElementById('optionModal')
    .addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('active');
        }
    });

    document.getElementById('confirmOptionBtn')
    .addEventListener('click', function() {
        if (!validateRequiredOptions()) {
            alert("Silakan pilih opsi terlebih dahulu.");
            return;
        }

        const checkedInputs = document.querySelectorAll('#optionContainer input:checked');
        const selected = [];
        let extra = 0;

        checkedInputs.forEach(input => {
            selected.push({
                id: parseInt(input.dataset.id),
                label: input.dataset.label,
                price: parseInt(input.dataset.price)
            });

            extra += parseInt(input.dataset.price || 0);
        });

        const finalPrice = selectedItemForOption.price + extra;

        addToCartWithOptions(selectedItemForOption, selected, finalPrice);

        document.getElementById('optionModal').classList.remove('active');
    });

    const cartBar = document.getElementById('bottomCartBar');

    if (cartBar) {
        cartBar.addEventListener('click', () => {
            document
                .getElementById('cartModal')
                ?.classList.add('active');
        });
    }

});




    const categories = @json($categories);


    const menuItems = categories.reduce((acc, category) => {
    acc[category.id] = category.children.map(sub => ({
        id: sub.id,
        name: sub.name,
        menus: sub.menus.map(menu => ({
        id: menu.id,
        name: menu.name || 'Unknown Item',
        price: menu.price || 0,
        menu_image: menu.menu_image || 'default_image.jpg',
        description: menu.description || 'Deskripsi tidak tersedia',
        options: (menu.option_groups || []).map(group => ({
            id: group.id,
            name: group.name,
            type: group.type,
            values: group.values || []
        })), //noted koma
        is_available: menu.is_available,
    }))


    }));
    return acc;
}, {});


    let cart = [];
    let activeCategory = categories.find(c => c.children.length > 0)?.id;


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
                buildSubNavigator();

                document.getElementById('subNavPanel').style.display = 'none';
            });

            pillsContainer.appendChild(pill);
        });
    }

    function renderMenu() {
    const container = document.getElementById('menuContainer');
    container.innerHTML = '';

    const currentSubCategories = menuItems[activeCategory] || [];
    if (currentSubCategories.length === 0) return;

    currentSubCategories.forEach(sub => {

        const sectionTitle = document.createElement('div');
        sectionTitle.id = `sub-${sub.id}`;
        sectionTitle.className = "sub-section-title";
        sectionTitle.style.marginTop = "30px";
        sectionTitle.style.paddingLeft = "16px";
        sectionTitle.textContent = sub.name;
        container.appendChild(sectionTitle);

        sub.menus.forEach(item => {
            const isAvailable = item.is_available;
            const card = document.createElement('div');
            card.className = 'menu-card';

            const iconHTML = item.menu_image
                ? `<img src="/storage/${item.menu_image}" style="width:50px;height:50px;border-radius:50%;object-fit:cover;">`
                : '';

            card.innerHTML = `
                <div class="menu-info">
                    <div class="menu-icon">${iconHTML}</div>
                    <div class="menu-text">
                        <h5>${item.name}</h5>
                        <p>Rp ${item.price.toLocaleString('id-ID')}</p>
                    </div>
                </div>
                ${
                isAvailable
                ? `<button class="add-btn" data-id="${item.id}">+</button>`
                : `<button class="add-btn" disabled style="background:#999;cursor:not-allowed;">Habis</button>`
            }
            `;

            container.appendChild(card);
            if (!item.is_available) {
                card.style.opacity = "0.5";
            }

            card.addEventListener('click', function (e) {
    if (e.target.closest('.add-btn')) return;
    showItemDetailsPopup(item);
});


            const addBtn = card.querySelector('.add-btn');

            addBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                openOptionModal(item);
            });


        });
    });
    
                buildSubNavigator();
}

let selectedItemForOption = null;
let selectedOptions = [];

function openOptionModal(item) {
    if (!item.is_available) return;
document.getElementById('menuItemDetailsPopup').style.display = 'none';


    selectedItemForOption = item;
    selectedOptions = [];

    document.getElementById('optionMenuTitle').textContent = item.name;

    const container = document.getElementById('optionContainer');
    container.innerHTML = '';

    if (!item.options || item.options.length === 0) {
        addToCartWithOptions(item, [], item.price);
        return;
    }

    item.options.forEach(opt => {

        const section = document.createElement('div');
        section.innerHTML = `
            <div class="option-group-title"
                 data-group-id="${opt.id}"
                 data-type="${opt.type}">
                ${opt.name}
            </div>
            `;

        opt.values.forEach(val => {

            const inputType = opt.type === "single" ? "radio" : "checkbox";

            const isDisabled = !val.is_available;

            const optionHTML = `
<label class="option-card ${isDisabled ? 'disabled' : ''}">
    
    <input 
        type="${inputType}"
        name="option_${opt.id}"
        data-id="${val.id}"
        data-price="${val.additional_price}"
        data-label="${val.label}"
        ${isDisabled ? 'disabled' : ''}
    >

    <div class="option-content">
        <div class="option-left">
            <div class="option-name">
                ${val.label}
            </div>

            ${
                val.additional_price > 0
                ? `<div class="option-price">
                        + Rp ${val.additional_price.toLocaleString('id-ID')}
                   </div>`
                : `<div class="option-price">Gratis</div>`
            }

            ${
                isDisabled
                ? `<div class="option-stock">(Habis)</div>`
                : ''
            }
        </div>

        <div class="option-check"></div>
    </div>

</label>
`;

            section.innerHTML += optionHTML;
        });

        container.appendChild(section);
    });

    document.getElementById('optionModal').classList.add('active');
    updateOptionPrice();
    toggleConfirmButton();
}

function validateRequiredOptions() {

    const groups = document.querySelectorAll('.option-group-title');

    for (const group of groups) {

        const type = group.dataset.type;
        const groupId = group.dataset.groupId;

        // hanya SINGLE yg wajib
        if (type !== 'single') continue;

        const checked = document.querySelector(
            `input[name="option_${groupId}"]:checked`
        );

        if (!checked) {
            return false;
        }
    }

    return true;
}

function toggleConfirmButton() {
    const btn = document.getElementById('confirmOptionBtn');

    if (validateRequiredOptions()) {
        btn.disabled = false;
        btn.style.opacity = "1";
    } else {
        btn.disabled = true;
        btn.style.opacity = "0.5";
    }
}

function updateOptionPrice() {
    if (!selectedItemForOption) return;

    const basePrice = selectedItemForOption.price;
    let extra = 0;

    const inputs = document.querySelectorAll('#optionContainer input:checked');

    inputs.forEach(input => {
        extra += parseInt(input.dataset.price || 0);
    });

    const final = basePrice + extra;

    document.getElementById('optionTotalPrice')
        .textContent = `Rp ${final.toLocaleString('id-ID')}`;
}


document.addEventListener('change', function(e) {
    if (e.target.closest('#optionContainer')) {
        updateOptionPrice();
        toggleConfirmButton();
    }
});

function buildSubNavigator() {

    const currentSubs = menuItems[activeCategory] || [];

    const btn = document.getElementById('subNavBtn');
    const list = document.getElementById('subNavList');

    // AUTO HIDE kalau sedikit
    if (currentSubs.length <= 1) {
        btn.style.display = 'none';
        return;
    }

    btn.style.display = 'block';

    list.innerHTML = '';

    currentSubs.forEach(sub => {

        const item = document.createElement('div');
        item.className = 'subnav-item';
        item.textContent = sub.name;

        item.onclick = () => {
            document
                .getElementById(`sub-${sub.id}`)
                ?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

            document.getElementById('subNavPanel')
                .style.display = 'none';
        };

        list.appendChild(item);
    });
}

document
.getElementById('subNavBtn')
.addEventListener('click', () => {

    const panel = document.getElementById('subNavPanel');

    panel.style.display =
        panel.style.display === 'block'
            ? 'none'
            : 'block';
});

function renderSubCategory(subId) {
    const container = document.getElementById('menuContainer');
    container.innerHTML = '';

    const currentSubCategories = menuItems[activeCategory] || [];
    const selectedSub = currentSubCategories.find(s => s.id == subId);

    if (!selectedSub) return;

    selectedSub.menus.forEach(item => {
        const card = document.createElement('div');
        card.className = 'menu-card';

        const iconHTML = item.menu_image
            ? `<img src="/storage/${item.menu_image}" style="width:50px;height:50px;border-radius:50%;object-fit:cover;">`
            : '';

        card.innerHTML = `
            <div class="menu-info">
                <div class="menu-icon">${iconHTML}</div>
                <div class="menu-text">
                    <h5>${item.name}</h5>
                    <p>Rp ${item.price.toLocaleString('id-ID')}</p>
                </div>
            </div>
            <button class="add-btn" data-id="${item.id}">+</button>
        `;

        container.appendChild(card);

        card.addEventListener('click', function () {
            showItemDetailsPopup(item);
        });

        const addBtn = card.querySelector('.add-btn');

addBtn.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    e.stopPropagation();

    openOptionModal(item);
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

    function addToCartWithOptions(item, options, finalPrice) {

    const optionKey = options
    .map(o => `${o.label}-${o.price}`)
    .sort()
    .join('|');

const cartKey = `${item.id}__${optionKey}`;


    const existingItem = cart.find(i => i.cartKey === cartKey);

    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push({
            cartKey: cartKey,
            id: item.id,
            name: item.name,
            price: finalPrice,
            base_price: item.price,
            options: options,
            quantity: 1
        });
    }

    updateCart();
}


    function updateCart() {

    const totalItems =
        cart.reduce((sum, item) => sum + item.quantity, 0);

    const subtotal =
        cart.reduce((sum, item) =>
            sum + (item.price * item.quantity), 0);

    const tax = Math.floor(subtotal * 0.10);
    const total = subtotal + tax;

    const bar = document.getElementById('bottomCartBar');

    // ✅ SHOW / HIDE
    if (totalItems > 0) {

        bar.classList.add('show');

        document.getElementById('bottomCartText')
            .textContent = `🛒 ${totalItems} Item`;

        document.getElementById('bottomCartTotal')
            .textContent =
            `Rp ${total.toLocaleString('id-ID')}`;

    } else {
        bar.classList.remove('show');
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
                ${item.options ? item.options.map(o => 
                    `<small>+ ${o.label}</small>`
                ).join('<br>') : ''}

                <p>Rp ${item.price.toLocaleString('id-ID')}</p>
            </div>
            <div class="cart-item-controls">
                <button class="qty-btn" data-key="${item.cartKey}" data-action="decrease">−</button>
                <span class="qty-display">${item.quantity}</span>
                <button class="qty-btn" data-key="${item.cartKey}" data-action="increase">+</button>
            </div>
        `;
        cartItemsContainer.appendChild(cartItem);
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


    function updateQuantity(cartKey, action) {
    const item = cart.find(i => i.cartKey === cartKey);

    if (!item) return;

    if (action === 'increase') {
        item.quantity++;
    } else if (action === 'decrease') {
        item.quantity--;
        if (item.quantity === 0) {
            cart = cart.filter(i => i.cartKey !== cartKey);
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

    // Close Cart Modal
    document.getElementById('closeCart').addEventListener('click', function () {
        document.getElementById('cartModal').classList.remove('active');
    });

    document.getElementById('closePayment').addEventListener('click', function () {
        document.getElementById('paymentModal').classList.remove('active');
    });

    // Show Payment Modal on Checkout
    // document.getElementById('checkoutBtn').addEventListener('click', function () {
    //     const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;
    //     window.selectedPaymentMethod = selectedMethod;

    document.getElementById('checkoutBtn')
        .addEventListener('click', function () {
        
            const selectedMethod = 'kasir';
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

    console.log(cart);

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

document.addEventListener('click', function (e) {
    const btn = e.target.closest('.qty-btn');
    if (!btn) return;

    const cartKey = btn.dataset.key;
    const action = btn.dataset.action;

    updateQuantity(cartKey, action);
});



    // Initialize the page
    renderCategories();
    renderMenu();
    buildSubNavigator();
    updateCart();
</script>
@endpush
