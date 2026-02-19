<!doctype html>
<html lang="id">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Menu')</title>
    {{-- Memuat Tailwind CSS dari CDN (atau kompilasi aset Anda sendiri) --}}
    <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
    {{-- Gaya CSS Kustom --}}
    <style>
        body {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f2;
            width: 100%;
            height: 100%;
        }

        html {
            height: 100%;
        }

        * {
            box-sizing: border-box;
        }

        .app-wrapper {
            width: 100%;
            min-height: 100%;
            background: #f5f5f2;
        }

        .header-img {
            width: 100%;
            height: 260px;
            overflow: hidden;
        }

        .header-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;          /* HILANGKAN GAP */
        }

        @media (max-width: 768px) {
            .header-img {
                height: 180px;
            }
        }

        .header-img svg {
            width: 100%;
            height: 100%;
        }

        .profile-section {
            display: flex;
            align-items: center;
            gap: 15px;

            margin-top: -20px;       /* NAIKKAN KE ATAS */
            padding: 0 20px;
        }

        .profile-icon {
            background: #c6282820;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #fff;  /* BIAR NIMPA HEADER */
        }

        .profile-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-text h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }

        .divider {
            height: 8px;
            background: #f5f5f2;
        }

        .category-pills {
            padding: 16px 20px;
            background: white;
            display: flex;
            gap: 10px;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .category-pills::-webkit-scrollbar {
            display: none;
        }

        .category-pill {
            padding: 10px 20px;
            border-radius: 20px;
            border: 2px solid;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.3s;
            flex-shrink: 0;
        }

        .category-pill:hover {
            transform: translateY(-2px);
        }

        .category-pill.active {
            color: white;
        }

        .menu-category {
            padding: 20px 20px 12px 20px;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .menu-container {
            padding: 0 20px 20px 20px;
        }

        .menu-card {
            background: white;
            padding: 16px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            box-shadow: 0px 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .menu-card:hover {
            transform: translateY(-2px);
            box-shadow: 0px 4px 12px rgba(0,0,0,0.12);
        }

        .menu-info {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
        }

        .menu-icon {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            flex-shrink: 0;
        }

        .menu-text {
            flex: 1;
        }

        .menu-text h5 {
            font-size: 16px;
            margin: 0 0 6px 0;
            font-weight: 600;
        }

        .menu-text p {
            margin: 0;
            font-size: 15px;
            font-weight: 600;
        }

     .add-btn {
    background-color: #c62828; /* Red color for the button background */
    color: white; /* White text color */
    border: none; /* Remove default border */
    padding: 10px 20px; /* Padding for better size */
    font-size: 16px; /* Font size */
    border-radius: 8px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.add-btn:hover {
    background-color: #e57373; /* Slightly lighter red when hovered */
    transform: scale(1.05); /* Slightly enlarge the button when hovered */
}

.add-btn:active {
    background-color: #b71c1c; /* Darker red when button is clicked */
    transform: scale(0.95); /* Shrink the button slightly on click */
}


        .cart-button {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
            box-shadow: 0px 6px 20px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            z-index: 1000;
        }

        .cart-button:hover {
            transform: scale(1.1);
        }

        .cart-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            min-width: 24px;
            height: 24px;
            border-radius: 12px;
            color: white;
            font-size: 12px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 6px;
        }

        .cart-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            align-items: flex-end;
        }

        .cart-modal.active {
            display: flex;
        }

        .cart-content {
            background: white;
            width: 100%;
            max-height: 80%;
            border-radius: 24px 24px 0 0;
            overflow-y: auto;
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(100%);
            }
            to {
                transform: translateY(0);
            }
        }

        /* Styling for the Menu Item Details Popup */
#menuItemDetailsPopup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* Centers the popup */
    width: 80%; /* Adjust width */
    max-width: 600px; /* Max width for larger screens */
    height: auto;
    background: rgba(0, 0, 0, 0.7); /* Dark background to highlight the modal */
    display: none; /* Initially hidden */
    justify-content: center;
    align-items: center;
    z-index: 99999; /* Ensure it's above all content */
    transition: opacity 0.3s ease-in-out;
    border-radius: 8px;
    padding: 20px;
}

/* Menu Item Detail Popup Content */
.menu-item-detail-popup {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 100%;
    animation: fadeIn 0.3s ease-in-out;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    overflow: auto;
}

#menuItemDetailsPopup img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
}

.popup-content {
    padding: 20px;
    overflow-y: auto;   /* AKTIFKAN SCROLL */
    flex: 1;
}


#detailName {
    font-size: 24px; /* Adjusted size for better readability */
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
    text-align: center;
}

#detailPrice {
    font-size: 22px;
    font-weight: 600;
    color: #c62828;
    text-align: center;
    margin-bottom: 15px;
}

#detailDescription {
    font-size: 16px;
    color: #555;
    line-height: 1.5;
    margin-bottom: 25px;
    text-align: justify;
}

#backButtonPopup {
    background-color: #c62828;
    color: white;
    padding: 12px 25px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    display: block;
    width: 100%;
    text-align: center;
    transition: background-color 0.3s ease;
    margin-top: 20px;
}

#backButtonPopup:hover {
    background-color: #a52727;
}

/* Fade-in animation */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    #menuItemDetailsPopup {
        width: 90%;
        padding: 10px;
    }

    .menu-item-detail-popup {
        padding: 15px;
    }

    #detailName {
        font-size: 20px;
    }

    #detailPrice {
        font-size: 18px;
    }

    #backButtonPopup {
        font-size: 14px;
        padding: 10px 15px;
    }
}


        .cart-header {
            padding: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
        }

        .cart-header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .cart-items {
            padding: 16px 24px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .cart-item-info h6 {
            margin: 0 0 6px 0;
            font-size: 16px;
            font-weight: 600;
        }

        .cart-item-info p {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }

        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .qty-btn:hover {
            transform: scale(1.1);
        }

        .qty-btn:active {
            transform: scale(0.9);
        }

        .qty-display {
            font-size: 16px;
            font-weight: 600;
            min-width: 24px;
            text-align: center;
        }

        .cart-footer {
            padding: 10px;
            border-top: 2px solid #eee;
            background: white;
            position: sticky;
            bottom: 0;
        }

        .cart-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .cart-total h3 {
            margin: 6px 0;
            font-size: 16px;
            font-weight: 700;
        }

        .cart-row {
            display: flex;
            justify-content: space-between;
            margin: 4px 0;
            font-size: 14px;
        }


        .checkout-btn {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0px 6px 16px rgba(0,0,0,0.2);
        }

        .checkout-btn:active {
            transform: translateY(0);
        }

        .empty-cart {
            padding: 60px 24px;
            text-align: center;
            color: #999;
        }

        .empty-cart-icon {
            font-size: 64px;
            margin-bottom: 16px;
        }

        .empty-cart p {
            font-size: 16px;
            margin: 0;
        }

        .toast {
            position: fixed;
            top: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(-100px);
            background: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0px 6px 20px rgba(0,0,0,0.15);
            font-weight: 600;
            transition: transform 0.3s ease-out;
            z-index: 3000;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .toast.show {
            transform: translateX(-50%) translateY(0);
        }

        .payment-section {
            padding: 20px 16px;
            border-bottom: 1px solid #f0f0f0;
        }

        .payment-section:last-child {
            border-bottom: none;
        }

        .payment-subtitle {
            margin: 0 0 16px 0;
            font-size: 16px;
            font-weight: 700;
        }

        .payment-summary {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 16px;
        }

        .payment-summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .payment-summary-item-name {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .payment-summary-qty {
            background: #f5f5f5;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .payment-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            background: #f8f8f8;
            border-radius: 12px;
            font-weight: 700;
            font-size: 18px;
        }

        .payment-total-amount {
            font-size: 22px;
        }

        .payment-total-row {
            display: flex;
            justify-content: space-between;
            margin: 6px 0;
            font-size: 15px;
        }


        .payment-methods {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .payment-method {
            display: flex;
            align-items: center;
            padding: 16px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .payment-method:hover {
            border-color: #c62828;
            background: #fff5f5;
        }

        .payment-method input[type="radio"] {
            margin-right: 12px;
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #c62828;
        }

        .payment-method-content {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 16px;
            font-weight: 600;
            flex: 1;
        }

        .payment-icon {
            font-size: 24px;
        }

        .payment-option-box {
            margin-top: 8px;
            margin-bottom: 8px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 3px 0;
            cursor: pointer;
        }

        .payment-option input[type="radio"] {
            transform: scale(1.2);
        }

        .upload-box {
            background: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 12px;
            margin-top: 15px;
        }

        .upload-title {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .upload-hint {
            font-size: 12px;
            color: #777;
            margin-top: 6px;
            display: block;
        }

        .upload-input-wrapper {
            background: white;
            border: 1px dashed #ccc;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
        }

        .upload-input-wrapper input[type="file"] {
            width: 100%;
            cursor: pointer;
        }


        .order-notes {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            resize: vertical;
            transition: border-color 0.2s;
        }

        .order-notes:focus {
            outline: none;
            border-color: #c62828;
        }

        .success-content {
            text-align: center;
            padding: 40px 24px;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: #4caf50;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            margin: 0 auto 24px;
            animation: successPop 0.5s ease-out;
        }

        .sub-jump-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
        }

        .sub-jump-modal.active {
            display: flex;
        }

        .sub-jump-content {
            background: white;
            width: 85%;
            max-width: 320px;
            padding: 20px;
            border-radius: 12px;
        }

        .sub-jump-content h4 {
            margin-bottom: 10px;
        }

        .sub-jump-btn {
            position: fixed;
            right: 20px;
            bottom: 160px; /* lebih atas dari cart */
            background: white;
            border: 1px solid #ddd;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 13px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            cursor: pointer;
            z-index: 9999;
        }

        .sub-section-title {
            margin: 30px 0 15px;
            font-weight: 600;
            font-size: 18px;
            padding-bottom: 6px;
            border-bottom: 2px solid #eee;
        }




        @keyframes successPop {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        .success-title {
            margin: 0 0 12px 0;
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .success-message {
            margin: 0 0 24px 0;
            font-size: 16px;
            color: #666;
        }

        .success-details {
            background: #f8f8f8;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            text-align: left;
        }

        .success-detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
        }

        .success-detail-row:last-child {
            border-bottom: none;
        }

        .success-detail-label {
            color: #666;
        }

        .success-detail-value {
            font-weight: 600;
            color: #333;
        }
        /* Add this to your CSS file */
#categoryPills {
    display: flex;  /* Display categories horizontally */
    justify-content: flex-start; /* Align to the left */
    gap: 10px; /* Add spacing between items */
    padding: 10px 16px;
    overflow-x: auto; /* Allow scrolling if the categories overflow horizontally */
}

.category-pill {
    background: #f5f5f2;
    border: 2px solid #e57373;
    color: #333;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.category-pill.active {
    background-color: #c62828;
    color: white;
    border-color: #c62828;
}

    </style>
    @stack('styles')
</head>
<body>
    <div class="app-wrapper">
        @yield('content')
    </div>
    @stack('scripts')
     @yield('sripts')
</body>
</html>