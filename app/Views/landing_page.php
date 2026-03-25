<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrace.io | Global Supply Chain Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root { --primary-teal: #16a085; --dark-navy: #243444; --accent-blue: #3498db; }
        body { font-family: 'Open Sans', sans-serif; background-color: #f1f4f7; color: var(--dark-navy); }
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; }
        
        .navbar { background-color: var(--dark-navy); border-bottom: 4px solid var(--primary-teal); }
        .card-stats { border: none; border-radius: 15px; background: white; border-left: 5px solid var(--primary-teal); }
        
        .product-card { border: none; border-radius: 12px; transition: 0.3s; cursor: pointer; background: white; overflow: hidden; height: 100%; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); border: 1px solid var(--primary-teal); }
        .card-img-top { height: 120px; object-fit: cover; }

        .form-section { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); }
        .table-record { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        
        .badge-export { background-color: #e67e22; color: white; }
        .badge-import { background-color: #2980b9; color: white; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-earth-americas text-success me-2"></i>EcoTrace Global <span class="badge bg-danger ms-2" style="font-size: 0.6rem;">ENTERPRISE V1</span></a>
            <div class="text-white d-none d-md-block small">
                <i class="fa-solid fa-circle-user me-2 text-info"></i>Murni Agustina Andini | 25120100018
            </div>
        </div>
    </nav>

    <main class="container my-4">
        
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card card-stats p-3 shadow-sm">
                    <small class="text-muted text-uppercase fw-bold">Total Transaksi</small>
                    <h3 id="statTotal" class="mb-0">1</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats p-3 shadow-sm" style="border-left-color: #3498db;">
                    <small class="text-muted text-uppercase fw-bold">Volume Global</small>
                    <h3 id="statVolume" class="mb-0">500 <span class="h6">Kg</span></h3>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-dark rounded-pill px-4 mt-2" onclick="simulateExport()">
                    <i class="fa-solid fa-file-export me-2"></i>Export to CSV (Database Ready)
                </button>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-8">
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold m-0">Katalog Komoditas Global</h4>
                        <input type="text" id="searchBar" onkeyup="filterCatalog()" class="form-control w-50 rounded-pill shadow-sm" placeholder="Cari komoditas...">
                    </div>
                    <div class="row g-2" id="catalogGrid">
                        </div>
                </div>

                <div class="table-record">
                    <div class="p-3 bg-dark text-white d-flex justify-content-between align-items-center">
                        <h5 class="m-0"><i class="fa-solid fa-list-check me-2 text-success"></i>Riwayat Pencatatan Database</h5>
                        <small class="opacity-75">Data Terenkripsi & Terverifikasi</small>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr class="small text-uppercase">
                                    <th>Batch ID</th>
                                    <th>Tipe</th>
                                    <th>Komoditas</th>
                                    <th>Rute (Origin -> Dest)</th>
                                    <th>Nilai (USD)</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dbRecords">
                                <tr>
                                    <td><small class="fw-bold">#ETC-9981</small></td>
                                    <td><span class="badge badge-export">EXPORT</span></td>
                                    <td>Biji Kopi Gayo</td>
                                    <td class="small">Indonesia <i class="fa-solid fa-arrow-right mx-1 text-muted"></i> Jerman</td>
                                    <td class="fw-bold">$5,400</td>
                                    <td><span class="text-success"><i class="fa-solid fa-circle-check"></i> Verified</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-section sticky-top" style="top: 90px;">
                    <h4 class="fw-bold mb-4 text-center">Form Transaksi Global</h4>
                    <form id="masterForm">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Trade Type</label>
                            <select id="tradeType" class="form-select border-primary">
                                <option value="EXPORT">EKSPOR (Keluar Negeri)</option>
                                <option value="IMPORT">IMPOR (Masuk Negeri)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Item & Harga (USD/Kg)</label>
                            <input type="text" id="selectedItem" class="form-control bg-light" readonly placeholder="Pilih dari katalog">
                            <input type="hidden" id="itemPrice">
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold">Asal (Origin)</label>
                                <select id="origin" class="form-select small">
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Vietnam">Vietnam</option>
                                    <option value="India">India</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold">Tujuan (Dest)</label>
                                <select id="dest" class="form-select small">
                                    <option value="USA">United States</option>
                                    <option value="Germany">Germany (EU)</option>
                                    <option value="Japan">Japan</option>
                                    <option value="China">China</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Volume (Kg)</label>
                            <input type="number" id="volume" onkeyup="recalc()" class="form-control" placeholder="0">
                        </div>
                        
                        <div class="p-3 rounded-3 mb-4 bg-light border">
                            <div class="d-flex justify-content-between mb-1 small">
                                <span>Estimasi Nilai:</span>
                                <span class="fw-bold" id="estValue">$0</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1 small">
                                <span>Carbon Tax (1%):</span>
                                <span class="text-danger fw-bold" id="estTax">$0</span>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">GRAND TOTAL:</span>
                                <span class="text-primary fw-bold h5 mb-0" id="grandTotal">$0</span>
                            </div>
                        </div>

                        <button type="button" onclick="submitToDB()" class="btn btn-teal w-100 py-3 fw-bold shadow" style="background-color: var(--primary-teal); color:white; border:none; border-radius:12px;">
                            SIMPAN KE DATABASE <i class="fa-solid fa-cloud-arrow-up ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-4 text-center text-muted border-top mt-5">
        <p class="small">&copy; 2026 Murni Agustina Andini - Cakrawala University | EcoTrace Sesi 3 Full Stack Business MVP</p>
    </footer>

    <script>
        const commodities = [
            { n: "Kopi Gayo", p: 10, img: "https://images.unsplash.com/photo-1559056199-641a0ac8b55e?q=80&w=200" },
            { n: "Karet Premium", p: 6, img: "https://images.unsplash.com/photo-1535930749574-139a327ce807?q=80&w=200" },
            { n: "Cengkeh Maluku", p: 8, img: "https://images.unsplash.com/photo-1599147785616-95e21758f844?q=80&w=200" },
            { n: "Lada Lampung", p: 7, img: "https://images.unsplash.com/photo-1532336414038-cf19250c5757?q=80&w=200" },
            { n: "Vanili Papua", p: 150, img: "https://images.unsplash.com/photo-1509358271058-acd22cc93898?q=80&w=200" },
            { n: "White Tea Java", p: 25, img: "https://images.unsplash.com/photo-1544787210-2213d2429f3b?q=80&w=200" }
        ];

        let currentTotal = 1;
        let currentVol = 500;

        function renderCatalog(filter = "") {
            const grid = document.getElementById('catalogGrid');
            grid.innerHTML = "";
            commodities.filter(c => c.n.toLowerCase().includes(filter.toLowerCase())).forEach(c => {
                grid.innerHTML += `
                    <div class="col-4 col-md-3 col-lg-2">
                        <div class="card product-card" onclick="selectItem('${c.n}', ${c.p})">
                            <img src="${c.img}" class="card-img-top">
                            <div class="card-body p-2 text-center">
                                <h6 class="small fw-bold mb-0">${c.n}</h6>
                                <span class="text-primary small">$${c.p}/Kg</span>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        function filterCatalog() {
            renderCatalog(document.getElementById('searchBar').value);
        }

        function selectItem(name, price) {
            document.getElementById('selectedItem').value = name;
            document.getElementById('itemPrice').value = price;
            recalc();
        }

        function recalc() {
            const p = document.getElementById('itemPrice').value || 0;
            const v = document.getElementById('volume').value || 0;
            const val = p * v;
            const tax = val * 0.01;
            const grand = val + tax;

            document.getElementById('estValue').innerText = "$" + val.toLocaleString();
            document.getElementById('estTax').innerText = "$" + tax.toLocaleString();
            document.getElementById('grandTotal').innerText = "$" + grand.toLocaleString();
        }

        function submitToDB() {
            const item = document.getElementById('selectedItem').value;
            const vol = document.getElementById('volume').value;
            const type = document.getElementById('tradeType').value;
            const origin = document.getElementById('origin').value;
            const dest = document.getElementById('dest').value;
            const grand = document.getElementById('grandTotal').innerText;

            if(!item || vol <= 0) {
                alert("Murni, lengkapi data transaksinya dulu ya!");
                return;
            }

            const batchId = "#ETC-" + Math.floor(Math.random() * 9000 + 1000);
            const badgeClass = type === 'EXPORT' ? 'badge-export' : 'badge-import';

            const table = document.getElementById('dbRecords');
            const row = table.insertRow(0);
            row.innerHTML = `
                <td><small class="fw-bold">${batchId}</small></td>
                <td><span class="badge ${badgeClass}">${type}</span></td>
                <td>${item}</td>
                <td class="small">${origin} <i class="fa-solid fa-arrow-right mx-1 text-muted"></i> ${dest}</td>
                <td class="fw-bold">${grand}</td>
                <td><span class="text-success"><i class="fa-solid fa-circle-check"></i> Verified</span></td>
            `;

            currentTotal++;
            currentVol += parseInt(vol);
            document.getElementById('statTotal').innerText = currentTotal;
            document.getElementById('statVolume').innerHTML = currentVol + " <span class='h6'>Kg</span>";

            alert("Data Berhasil Disinkronisasi ke Database EcoTrace!");
            document.getElementById('masterForm').reset();
            recalc();
        }

        function simulateExport() {
            alert("Mengekspor " + currentTotal + " catatan transaksi ke file EcoTrace_March2026.csv...\n\nSiap di-import ke Database Utama!");
        }

        renderCatalog();
    </script>
</body>
</html>