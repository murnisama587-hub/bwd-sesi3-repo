<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrace.io | Export Etalase & Transaction</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root { --primary-teal: #16a085; --dark-navy: #243444; --accent-gold: #f39c12; }
        body { font-family: 'Open Sans', sans-serif; background-color: #f4f7f6; color: var(--dark-navy); }
        h1, h2, h3 { font-family: 'Montserrat', sans-serif; }
        
        .navbar { background-color: var(--dark-navy); border-bottom: 3px solid var(--primary-teal); }
        .product-card { border: none; border-radius: 15px; transition: 0.3s; cursor: pointer; overflow: hidden; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card-img-top { height: 150px; object-fit: cover; }
        
        .transaction-box { background: white; border-radius: 20px; padding: 30px; border-left: 5px solid var(--primary-teal); }
        .price-tag { color: var(--primary-teal); font-weight: 700; font-size: 1.2rem; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-leaf text-success me-2"></i>EcoTrace.io <span class="badge bg-warning text-dark ms-2" style="font-size: 0.7rem;">PRO VERSION</span></a>
        </div>
    </nav>

    <main class="container my-5">
        <div class="row">
            
            <div class="col-lg-7">
                <h2 class="h4 mb-4 fw-bold">Pilih Komoditas Ekspor</h2>
                <div class="row g-3">
                    <div class="col-md-6 col-xl-4">
                        <div class="card product-card h-100" onclick="pilihProduk('Biji Kopi Gayo', 150000)">
                            <img src="https://images.unsplash.com/photo-1559056199-641a0ac8b55e?auto=format&fit=crop&q=80&w=400" class="card-img-top" alt="Kopi">
                            <div class="card-body">
                                <h5 class="card-title h6 fw-bold">Biji Kopi Gayo</h5>
                                <p class="price-tag mb-0">Rp 150.000<span class="text-muted small">/Kg</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card product-card h-100" onclick="pilihProduk('Karet Alam Premium', 85000)">
                            <img src="https://images.unsplash.com/photo-1535930749574-139a327ce807?auto=format&fit=crop&q=80&w=400" class="card-img-top" alt="Karet">
                            <div class="card-body">
                                <h5 class="card-title h6 fw-bold">Karet Alam Premium</h5>
                                <p class="price-tag mb-0">Rp 85.000<span class="text-muted small">/Kg</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card product-card h-100" onclick="pilihProduk('Cengkeh Maluku', 120000)">
                            <img src="https://images.unsplash.com/photo-1599147785616-95e21758f844?auto=format&fit=crop&q=80&w=400" class="card-img-top" alt="Cengkeh">
                            <div class="card-body">
                                <h5 class="card-title h6 fw-bold">Cengkeh Maluku</h5>
                                <p class="price-tag mb-0">Rp 120.000<span class="text-muted small">/Kg</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 p-4 bg-white rounded-4 shadow-sm">
                    <h3 class="h5 mb-3 fw-bold">History Verifikasi Ekspor</h3>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th>Total Bayar</th>
                                    <th>Pajak Karbon</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tabelData">
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="transaction-box shadow-sm sticky-top" style="top: 100px;">
                    <h3 class="h5 mb-4 fw-bold text-uppercase" style="letter-spacing: 1px;">Kalkulator Ekspor</h3>
                    <form id="exportForm">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Produk Terpilih</label>
                            <input type="text" id="displayProduk" class="form-control bg-light" readonly placeholder="Klik kartu produk di kiri">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Volume Ekspor (Kg)</label>
                            <input type="number" id="inputBerat" class="form-control" onkeyup="hitungOtomatis()" placeholder="Masukkan berat">
                        </div>
                        
                        <div class="p-3 rounded-3 mb-4" style="background-color: #f8fcfb; border: 1px dashed var(--primary-teal);">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small">Harga Subtotal:</span>
                                <span class="fw-bold" id="subtotal">Rp 0</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small">Pajak Karbon (2%):</span>
                                <span class="text-danger fw-bold" id="pajakKarbon">Rp 0</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">TOTAL BAYAR:</span>
                                <span class="text-success fw-bold h5 mb-0" id="totalAkhir">Rp 0</span>
                            </div>
                        </div>

                        <button type="button" onclick="checkout()" class="btn btn-dark w-100 py-3 fw-bold rounded-pill">
                            PROSES TRANSAKSI <i class="fa-solid fa-file-shield ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-4 text-center text-muted">
        <small>&copy; 2026 Murni Agustina Andini - 25120100018 | EcoTrace Sesi 3 Pro</small>
    </footer>

    <script>
        let hargaPerKg = 0;
        let produkAktif = "";

        function pilihProduk(nama, harga) {
            produkAktif = nama;
            hargaPerKg = harga;
            document.getElementById('displayProduk').value = nama;
            hitungOtomatis(); // Update harga kalau user ganti produk
        }

        function hitungOtomatis() {
            const berat = document.getElementById('inputBerat').value || 0;
            const subtotal = hargaPerKg * berat;
            const pajak = subtotal * 0.02; // Asumsi pajak karbon 2%
            const total = subtotal + pajak;

            document.getElementById('subtotal').innerText = "Rp " + subtotal.toLocaleString();
            document.getElementById('pajakKarbon').innerText = "Rp " + pajak.toLocaleString();
            document.getElementById('totalAkhir').innerText = "Rp " + total.toLocaleString();
        }

        function checkout() {
            const berat = document.getElementById('inputBerat').value;
            const total = document.getElementById('totalAkhir').innerText;
            const pajak = document.getElementById('pajakKarbon').innerText;

            if (!produkAktif || berat <= 0) {
                alert("Murni, pilih produk dan isi beratnya dulu ya!");
                return;
            }

            // Tambahkan ke tabel history
            const tabel = document.getElementById('tabelData');
            const row = tabel.insertRow(0);
            row.innerHTML = `
                <td class="fw-bold">${produkAktif}</td>
                <td>${total}</td>
                <td class="text-danger">${pajak}</td>
                <td><span class="badge bg-success"><i class="fa-solid fa-check me-1"></i>Verified</span></td>
            `;

            alert("Transaksi Ekspor Berhasil Diverifikasi!");
            document.getElementById('exportForm').reset();
            pilihProduk('', 0); // Reset kalkulator
        }
    </script>
</body>
</html>