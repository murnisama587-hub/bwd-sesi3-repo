<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrace.io | Global Commodity Hub - Sesi 3</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root { --primary-teal: #16a085; --dark-navy: #243444; --mint-bg: #f0fcf8; }
        body { font-family: 'Open Sans', sans-serif; background-color: #f4f7f6; color: var(--dark-navy); }
        h1, h2, h3 { font-family: 'Montserrat', sans-serif; }
        
        .navbar { background-color: var(--dark-navy); border-bottom: 3px solid var(--primary-teal); }
        .search-bar { border-radius: 30px; padding: 12px 25px; border: 2px solid #e0e0e0; transition: 0.3s; }
        .search-bar:focus { border-color: var(--primary-teal); box-shadow: none; }
        
        .product-card { border: none; border-radius: 15px; transition: 0.3s; cursor: pointer; overflow: hidden; background: white; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); border: 1px solid var(--primary-teal); }
        .card-img-top { height: 140px; object-fit: cover; transition: 0.5s; }
        .product-card:hover .card-img-top { transform: scale(1.1); }
        
        .transaction-box { background: white; border-radius: 20px; padding: 25px; border-top: 5px solid var(--primary-teal); position: sticky; top: 90px; }
        .empty-search { display: none; padding: 50px; text-align: center; color: #95a5a6; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-leaf text-success me-2"></i>EcoTrace.io <span class="badge bg-info text-dark ms-2" style="font-size: 0.6rem;">ENTERPRISE</span></a>
            <div class="d-flex align-items-center text-white d-none d-md-block">
                <small><i class="fa-solid fa-user-check me-2 text-success"></i>Murni Agustina Andini (25120100018)</small>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <div class="row">
            
            <div class="col-lg-8">
                <div class="d-md-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 fw-bold mb-3 mb-md-0">Katalog Komoditas Terverifikasi</h2>
                    <div class="position-relative" style="width: 300px;">
                        <input type="text" id="inputCari" class="form-control search-bar" onkeyup="cariProduk()" placeholder="Cari kopi, lada, kayu...">
                        <i class="fa-solid fa-magnifying-glass position-absolute" style="right: 20px; top: 15px; color: #ccc;"></i>
                    </div>
                </div>

                <div class="row g-3" id="etalaseProduk">
                    </div>

                <div id="noResult" class="empty-search">
                    <i class="fa-solid fa-box-open fa-3x mb-3"></i>
                    <p>Waduh Murni, komoditas itu belum terverifikasi di database kami.</p>
                </div>

                <div class="text-center mt-5 mb-5">
                    <button class="btn btn-outline-dark px-5 py-2 rounded-pill fw-bold" onclick="alert('Ini adalah limit database simulasi. Hubungi admin untuk akses API penuh!')">
                        Temukan Lebih Banyak Lagi <i class="fa-solid fa-chevron-down ms-2"></i>
                    </button>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="transaction-box shadow">
                    <h3 class="h6 mb-4 fw-bold text-uppercase" style="letter-spacing: 1px;">Kalkulator Verifikasi Transaksi</h3>
                    <form id="exportForm">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Item Terpilih</label>
                            <input type="text" id="displayProduk" class="form-control bg-light fw-bold border-0" readonly placeholder="Pilih produk dari kiri">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Volume Ekspor (Kg)</label>
                            <input type="number" id="inputBerat" class="form-control py-2" onkeyup="hitungOtomatis()" placeholder="0">
                        </div>
                        
                        <div class="p-3 rounded-3 mb-4" style="background-color: #f8fcfb; border: 1px solid #e1eee9;">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small">Subtotal:</span>
                                <span class="fw-bold" id="subtotal">Rp 0</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="small">Carbon Tax (2%):</span>
                                <span class="text-danger fw-bold" id="pajakKarbon">Rp 0</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">ESTIMASI TOTAL:</span>
                                <span class="text-success fw-bold h5 mb-0" id="totalAkhir">Rp 0</span>
                            </div>
                        </div>

                        <button type="button" onclick="checkout()" class="btn btn-dark w-100 py-3 fw-bold rounded-3">
                            PROSES VERIFIKASI <i class="fa-solid fa-shield-check ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-4 text-center text-muted bg-white border-top mt-5">
        <small><strong>EcoTrace Sesi 3 Enterprise</strong> &copy; 2026 Murni Agustina Andini - 25120100018</small>
    </footer>

    <script>
        // Database Produk Terverifikasi (Fix Gambar & Tambah Variasi)
        const databaseProduk = [
            { nama: "Biji Kopi Gayo", harga: 150000, img: "https://images.unsplash.com/photo-1559056199-641a0ac8b55e?q=80&w=400" },
            { nama: "Karet Alam Premium", harga: 85000, img: "https://images.unsplash.com/photo-1535930749574-139a327ce807?q=80&w=400" },
            { nama: "Cengkeh Maluku", harga: 120000, img: "https://images.unsplash.com/photo-1599147785616-95e21758f844?q=80&w=400" },
            { nama: "Teh Putih Java", harga: 350000, img: "https://images.unsplash.com/photo-1544787210-2213d2429f3b?q=80&w=400" },
            { nama: "Lada Hitam Lampung", harga: 110000, img: "https://images.unsplash.com/photo-1532336414038-cf19250c5757?q=80&w=400" },
            { nama: "Arang Batok Kelapa", harga: 25000, img: "https://images.unsplash.com/photo-1622268143282-552735496417?q=80&w=400" },
            { nama: "Vanili Papua", harga: 2500000, img: "https://images.unsplash.com/photo-1509358271058-acd22cc93898?q=80&w=400" },
            { nama: "Kayu Manis Kerinci", harga: 180000, img: "https://images.unsplash.com/photo-1501168134260-038827727181?q=80&w=400" },
            { nama: "Cokelat Luwu", harga: 95000, img: "https://images.unsplash.com/photo-1511381939415-e44015466834?q=80&w=400" },
            { nama: "Kopra Sulawesi", harga: 45000, img: "https://images.unsplash.com/photo-1550143818-4a92c0032906?q=80&w=400" },
            { nama: "Gula Semut Aren", harga: 65000, img: "https://images.unsplash.com/photo-1581447100595-37f09c277712?q=80&w=400" },
            { nama: "Pinang Jambi", harga: 35000, img: "https://images.unsplash.com/photo-1506484381205-f7945653044d?q=80&w=400" }
        ];

        let hargaPerKg = 0;
        let produkAktif = "";

        // Fungsi Render Kartu Produk
        function renderEtalase(data) {
            const container = document.getElementById('etalaseProduk');
            const noResult = document.getElementById('noResult');
            container.innerHTML = "";
            
            if(data.length === 0) {
                noResult.style.display = "block";
            } else {
                noResult.style.display = "none";
                data.forEach(item => {
                    container.innerHTML += `
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card product-card h-100 shadow-sm" onclick="pilihProduk('${item.nama}', ${item.harga})">
                                <img src="${item.img}" class="card-img-top" alt="${item.nama}">
                                <div class="card-body p-2 p-md-3">
                                    <h6 class="fw-bold mb-1" style="font-size: 0.85rem;">${item.nama}</h6>
                                    <p class="text-success fw-bold small mb-0">Rp ${item.harga.toLocaleString()}/Kg</p>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }
        }

        // Fungsi Cari Produk
        function cariProduk() {
            const keyword = document.getElementById('inputCari').value.toLowerCase();
            const hasilFilter = databaseProduk.filter(item => 
                item.nama.toLowerCase().includes(keyword)
            );
            renderEtalase(hasilFilter);
        }

        function pilihProduk(nama, harga) {
            produkAktif = nama;
            hargaPerKg = harga;
            document.getElementById('displayProduk').value = nama;
            hitungOtomatis();
            alert("Murni, kamu memilih " + nama + "!");
        }

        function hitungOtomatis() {
            const berat = document.getElementById('inputBerat').value || 0;
            const subtotal = hargaPerKg * berat;
            const pajak = subtotal * 0.02;
            const total = subtotal + pajak;

            document.getElementById('subtotal').innerText = "Rp " + subtotal.toLocaleString();
            document.getElementById('pajakKarbon').innerText = "Rp " + pajak.toLocaleString();
            document.getElementById('totalAkhir').innerText = "Rp " + total.toLocaleString();
        }

        function checkout() {
            if (!produkAktif || document.getElementById('inputBerat').value <= 0) {
                alert("Data belum lengkap nih, Murni!");
                return;
            }
            alert("VERIFIKASI BERHASIL!\n\nProduk: " + produkAktif + "\nTotal Biaya: " + document.getElementById('totalAkhir').innerText + "\n\nStatus: Eco-Compliant Verified.");
        }

        // Jalankan render pertama kali saat halaman dibuka
        renderEtalase(databaseProduk);
    </script>
</body>
</html>