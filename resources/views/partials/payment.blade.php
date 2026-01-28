 {{-- Payment Modal --}}
    <div class="cart-modal" id="paymentModal">
        <div class="cart-content">
            <div class="cart-header">
                <h2>Pembayaran</h2>
                <button class="close-btn" id="closePayment" aria-label="Close payment">×</button>
            </div>
            <div class="cart-items">
                <div class="payment-section">
                    
                    <div id="qrisSection" style="display: none; margin-bottom: 20px;">
                    <h3 class="payment-subtitle">Pembayaran QRIS</h3>

                    <img src="/storage/qris_ou.png" alt="QRIS" 
                         style="width: 100%; border-radius: 10px; margin-top: 5px;">

                    <p style="margin-top: 5px;">
                        Silahkan scan QRIS di atas dan upload bukti pembayaran Anda.
                    </p>
                
                    <div class="upload-box">
                        <label class="upload-title">Upload Bukti Pembayaran</label>

                        <div class="upload-input-wrapper">
                            <input type="file" id="paymentProof" accept="image/*">
                            <span id="proofError" style="color: red; font-size: 13px; display: none; margin-top: 8px;">
                            Silakan upload bukti pembayaran terlebih dahulu
                        </span>
                        </div>
                        <img id="uploadPreview" style="width: 100%; margin-top: 10px; border-radius: 8px; display: none;">

                        <button id="removeImageBtn" 
                                style="
                                    margin-top: 8px;
                                    display: none;
                                    background: #e53935;
                                    color: white;
                                    border: none;
                                    padding: 6px 10px;
                                    border-radius: 6px;
                                    width: 100%;
                                ">
                            Hapus Gambar
                        </button>
                    
                        <small class="upload-hint">Format: JPG, PNG. Maks 5MB.</small>
                        

                    </div>

                </div>

                <!-- KASIR SECTION -->
                    <h3 class="payment-subtitle">Ringkasan Pesanan</h3>
                    <div id="paymentSummary" class="payment-summary"></div>
                    <div class="payment-total-row">
                    <span>Subtotal</span>
                    <span id="paymentSubtotal">Rp 0</span>
                </div>

                <div class="payment-total-row">
                    <span>Pajak (10%)</span>
                    <span id="paymentTax">Rp 0</span>
                </div>

                <div class="payment-total">
                    <span>Total Pembayaran</span>
                    <span id="paymentTotal" class="payment-total-amount">Rp 0</span>
                </div>

                </div>
                      
               
            </div>
            <div class="cart-footer">
                <button class="checkout-btn" id="paymentBtn"style="background: #c62828;"> Konfirmasi Pembayaran</button>
        </div>
    </div>
