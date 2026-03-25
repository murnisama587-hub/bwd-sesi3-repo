// ==========================================
// MVP ARCHITECTURE: BUSINESS LOGIC & UI (Sesi 3)
// ==========================================

// 1. TEMPORARY DATABASE (Product Data Array Simulation)
const dataProduk = [
    { id: 1, nama: "Origin Traceability Report", harga: 150, icon: "fa-map-location-dot" },
    { id: 2, nama: "Carbon Footprint Audit", harga: 120, icon: "fa-leaf" },
    { id: 3, nama: "EUDR Compliance Cert", harga: 200, icon: "fa-certificate" }
];

// APPLICATION STATE (Variables to track transaction status)
let totalKeranjang = 0;
let jumlahItem = 0;

// DOM SELECTION
const btnTampilkan = document.getElementById('btn-tampilkan-produk');
const katalogContainer = document.getElementById('katalog-container');
const displayTotal = document.getElementById('display-total');
const badgeKeranjang = document.getElementById('cart-badge');
const btnCheckout = document.getElementById('btn-checkout');
const promoAlert = document.getElementById('promo-alert');


// ==========================================
// TASK 1: LOOPS (UI Automation)
// ==========================================
btnTampilkan.addEventListener('click', function() {
    // 1. Clear empty message
    katalogContainer.innerHTML = '';

    // 2. Looping EcoTrace product data
    for (let i = 0; i < dataProduk.length; i++) {
        const item = dataProduk[i];
        
        // Injecting HTML into container
        katalogContainer.innerHTML += `
            <div class="col-md-4 mb-3">
                <div class="card p-3 shadow-sm h-100 text-center product-card">
                    <i class="fa-solid ${item.icon} fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">${item.nama}</h5>
                    <p class="text-muted small">International Export Standard Audit</p>
                    <p class="fw-bold text-success fs-5">$ ${item.harga}</p>
                    <button class="btn btn-primary w-100" onclick="tambahKeKeranjang(${item.harga})">
                        Add to Report
                    </button>
                </div>
            </div>
        `;
    }

    // Change button status after click
    btnTampilkan.disabled = true;
    btnTampilkan.innerHTML = '<i class="fa-solid fa-check"></i> Data Loaded';
});


// ==========================================
// TASK 2: TRANSACTION LOGIC (Add to Cart)
// ==========================================
function tambahKeKeranjang(hargaProduk) {
    // 1. Update State (Data)
    totalKeranjang += hargaProduk;
    jumlahItem += 1;

    // 2. Update UI (DOM Manipulation)
    badgeKeranjang.textContent = jumlahItem;
    // Formatting currency to USD
    displayTotal.textContent = '$ ' + totalKeranjang.toLocaleString('en-US');
    
    // Enable checkout button as the cart is no longer empty
    btnCheckout.classList.remove('disabled');

    // Call promo check function
    cekPromoOtomatis();
}


// ==========================================
// TASK 3: CONDITIONALS (Business Promo Logic)
// ==========================================
function cekPromoOtomatis() {
    const teksPromo = document.getElementById('promo-text');
    
    // TODO MAHASISWA: Logic for Bulk Discount.
    // Adjusted threshold to $500 for a more realistic international audit fee.
    const threshold = 500;

    if (totalKeranjang >= threshold) {
        // Show promo success
        promoAlert.classList.remove('d-none');
        promoAlert.classList.replace('alert-info', 'alert-success');
        teksPromo.textContent = "Congratulations! You've unlocked the 10% Bulk Export Discount.";
    } else {
        // Upselling message
        promoAlert.classList.remove('d-none');
        promoAlert.classList.replace('alert-success', 'alert-info');
        teksPromo.textContent = `Add $ ${(threshold - totalKeranjang).toLocaleString('en-US')} more to get a 10% discount!`;
    }
}


// ==========================================
// TASK 4: EVENT LISTENER (Conversion Point)
// ==========================================
btnCheckout.addEventListener('click', function() {
    // Visual feedback for processing
    btnCheckout.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Processing Reports...';
    btnCheckout.classList.replace('btn-primary', 'btn-success');
    
    // Simulate server delay
    setTimeout(() => {
        alert(`Certification Successful!\nTotal Fee: $ ${totalKeranjang.toLocaleString('en-US')}\nThank you for choosing EcoTrace.io.`);
        
        // Reset application
        location.reload(); 
    }, 1500);
});