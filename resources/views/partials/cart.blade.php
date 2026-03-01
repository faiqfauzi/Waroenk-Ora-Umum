 {{-- Cart Modal --}}
    <div class="cart-modal" id="cartModal">
        <div class="cart-content">
            <div class="cart-header">
                <h2>Keranjang Belanja</h2>
                <button class="close-btn" id="closeCart" aria-label="Close cart">×</button>
            </div>
            <div class="cart-items" id="cartItems">
               
            </div>
             <div class="payment-section">
                    <h3 class="payment-subtitle">Catatan Pesanan (Opsional)</h3>
                    <textarea id="orderNotes" class="order-notes" placeholder="Contoh: Tidak pakai keju, pedas ekstra, dll..." rows="3"></textarea>
                </div>
            <div class="cart-footer" id="cartFooter" style="display: none;">

            <div class="cart-row">
                <span>Subtotal:</span>
                <span id="cartSubtotal">Rp 0</span>
            </div>
        
            <div class="cart-row">
                <span>Pajak (10%):</span>
                <span id="cartTax">Rp 0</span>
            </div>
        
            <hr>
        
            <div class="cart-total">
                <h3>Total:</h3>
                <h3 id="cartTotal" style="color: #c62828;">Rp 0</h3>
            </div>
        
            <div class="payment-option-box">
                <h4 style="margin-bottom: 8px;">Metode Pembayaran</h4>
            
                {{-- <label class="payment-option">
                    <input type="radio" name="payment_method" value="qris" checked>
                    <span>QRIS</span>
                </label> --}}
            
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="kasir">
                    <span>Kasir</span>
                </label>
            </div>
        
            <button class="checkout-btn" id="checkoutBtn" style="background: #c62828;">
                Lanjut Pembayaran
            </button>
        
        </div>
        
                </div>
    </div>
