<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrace.io | Global Supply Chain Ultimate</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root { --primary-teal: #16a085; --dark-navy: #243444; --premium-gold: #d4af37; --eco-bg: #f4f8f7; }
        body { font-family: 'Open Sans', sans-serif; background-color: var(--eco-bg); color: var(--dark-navy); }
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; }
        
        /* UI COMPONENTS */
        .navbar { background-color: var(--dark-navy); border-bottom: 4px solid var(--primary-teal); }
        .stats-card { border: none; border-radius: 15px; background: white; border-left: 5px solid var(--primary-teal); padding: 15px; }
        
        .product-card { border: none; border-radius: 12px; transition: 0.3s; cursor: pointer; background: white; height: 100%; border: 1px solid transparent; }
        .product-card:hover { transform: translateY(-5px); border-color: var(--primary-teal); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        
        .featured-card { border: 2px solid var(--premium-gold) !important; position: relative; overflow: hidden; }
        .featured-label { position: absolute; top: 10px; right: -30px; background: var(--premium-gold); color: white; padding: 5px 35px; transform: rotate(45deg); font-size: 0.6rem; font-weight: bold; }

        .verification-panel { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); position: sticky; top: 90px; }
        .table-record { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-leaf text-success me-2"></i>EcoTrace Global Enterprise</a>
            <div class="text-white d-none d-md-block small opacity-75">
                <i class="fa-solid fa-user-circle me-1"></i> Murni Agustina Andini | 25120100018
            </div>
        </div>
    </nav>

    <main class="container my-4">
        
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="stats-card shadow-sm">
                    <small class="text-muted fw-bold text-uppercase">Total Sync</small>
                    <h3 id="statTotal" class="mb-0">1</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card shadow-sm" style="border-left-color: var(--premium-gold);">
                    <small class="text-muted fw-bold text-uppercase">Verified Weight</small>
                    <h3 id="statVol" class="mb-0">0 <span class="h6 text-muted">Ton</span></h3>
                </div>
            </div>
            <div class="col-md-6 text-end d-flex align-items-center justify-content-end">
                <input type="text" id="mainSearch" onkeyup="globalFilter()" class="form-control w-75 rounded-pill border-2" placeholder="Cari 100+ komoditas global...">
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-8">
                
                <div id="spotlightArea">
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-star text-warning me-2"></i>Archipelago Premium Origin</h5>
                    <div class="row g-2 mb-4" id="featuredGrid"></div>
                </div>

                <h5 class="fw-bold mb-3"><i class="fa-solid fa-earth-americas text-primary me-2"></i>Global Marketplace Hub</h5>
                <div class="row g-2 mb-5" id="globalGrid" style="max-height: 400px; overflow-y: auto;"></div>

                <div class="table-record">
                    <div class="p-3 bg-dark text-white d-flex justify-content-between">
                        <h6 class="m-0 fw-bold">DATABASE RECORD LOG</h6>
                        <span class="badge bg-success small">Secure Sync Active</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.8rem;">
                            <thead class="table-light text-uppercase">
                                <tr>
                                    <th>Batch ID</th>
                                    <th>Type</th>
                                    <th>Commodity</th>
                                    <th>Route</th>
                                    <th>Value (USD)</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dbLog">
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="verification-panel">
                    <h5 class="fw-bold mb-4">Verifikasi Transaksi Global</h5>
                    <form id="tradeForm">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Trade Category</label>
                            <select id="tradeType" class="form-select border-primary fw-bold">
                                <option value="EKSPOR">EKSPOR (Luar Negeri)</option>
                                <option value="IMPOR">IMPOR (Dalam Negeri)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Item Terpilih</label>
                            <input type="text" id="vItem" class="form-control bg-light fw-bold" readonly placeholder="Pilih dari katalog">
                            <input type="hidden" id="vPrice">
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold">Origin</label>
                                <input type="text" id="vOrigin" class="form-control bg-light small" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold">Destination</label>
                                <select id="vDest" class="form-select small">
                                    <option value="USA">United States</option>
                                    <option value="Germany">Germany (EU)</option>
                                    <option value="Japan">Japan</option>
                                    <option value="China">China</option>
                                    <option value="Indonesia">Indonesia</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Volume (Ton)</label>
                            <input type="number" id="vVol" onkeyup="recalc()" class="form-control border-success" placeholder="0">
                        </div>
                        
                        <div class="p-3 rounded-3 bg-light border mb-4" style="font-size: 0.85rem;">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Subtotal:</span>
                                <span class="fw-bold" id="resSub">$0</span>
                            </div>
                            <div class="d-flex justify-content-between text-danger mb-1">
                                <span>Pajak Karbon (1%):</span>
                                <span class="fw-bold" id="resTax">$0</span>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between h6 mb-0 text-success">
                                <span class="fw-bold">GRAND TOTAL:</span>
                                <span class="fw-bold" id="resTotal">$0</span>
                            </div>
                        </div>

                        <button type="button" onclick="syncToDB()" class="btn btn-dark w-100 py-3 fw-bold shadow">
                            SIMPAN KE DATABASE <i class="fa-solid fa-cloud-arrow-up ms-2 text-success"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-4 text-center text-muted border-top mt-5 bg-white">
        <small>&copy; 2026 Murni Agustina Andini - 25120100018 | EcoTrace Ultimate Edition</small>
    </footer>

    <script>
        // DATA MASTER 100 ITEM
        const raw = ["1,Daun Matcha,Dedaunan,Jepang,100","2,Biji Kopi Arabika,Minuman,Brasil,150","3,Saffron,Rempah,Iran,2000","4,Minyak Zaitun,Bahan Pangan,Italia,80","5,Daun Stevia,Pemanis,Tiongkok,40","6,Ginseng Merah,Kesehatan,Korea Selatan,300","7,Bunga Tulip,Florikultura,Belanda,50","8,Daging Wagyu A5,Protein,Jepang,500","9,Quinoa Organik,Serealia,Peru,45","10,Daun Eucalyptus,Minyak Atsiri,Australia,60","11,Kurma Medjool,Buah,Mesir,35","12,Keju Parmesan,Diary,Italia,120","13,Vanila Bean,Rempah,Madagaskar,400","14,Kacang Hazelnut,Snack,Turki,30","15,Wine Bordeaux,Minuman,Prancis,250","16,Cokelat Couverture,Olahan,Belgia,95","17,Beras Basmati,Pangan,India,25","18,Daun Rosemary,Herbal,Yunani,55","19,Kulit Sapi (Leather),Fashion,Italia,180","20,Mesin Presisi,Teknologi,Jerman,5000","21,Biji Kakao,Bahan Baku,Ghana,40","22,Daun Teh Oolong,Dedaunan,Taiwan,120","23,Minyak Argan,Kosmetik,Maroko,350","24,Salmon Atlantik,Seafood,Norwegia,90","25,Daun Sage,Herbal,Spanyol,45","26,Keramik Porselen,Dekorasi,Tiongkok,220","27,Chip Semikonduktor,Elektronik,Taiwan,8000","28,Susu Bubuk,Diary,Selandia Baru,50","29,Daun Bay (Salam),Rempah,Turki,30","30,Parfum,Kecantikan,Prancis,1500","31,Gandum Hard Wheat,Pangan,Kanada,20","32,Buah Pir (Singo),Buah,Korea Selatan,45","33,Daun Thyme,Herbal,Prancis,50","34,Biji Wijen,Bahan Baku,Ethiopia,35","35,Mesin Kopi,Elektronik,Italia,1200","36,Sutra Alam,Tekstil,Tiongkok,400","37,Garam Himalaya,Bumbu,Pakistan,15","38,Daun Mint Kering,Dedaunan,Maroko,40","39,Kacang Almond,Snack,Amerika Serikat,75","40,Wine Prosecco,Minuman,Italia,180","41,Kristal Swarowski,Aksesori,Austria,900","42,Daun Oregano,Herbal,Yunani,35","43,Biji Kedelai,Pangan,Amerika Serikat,18","44,Kayu Jati,Bahan Bangunan,Myanmar,1500","45,Minyak Kanola,Bahan Pangan,Kanada,30","46,Jam Tangan,Aksesori,Swiss,3500","47,Daun Pandan Bubuk,Dedaunan,Thailand,65","48,Madu Manuka,Kesehatan,Selandia Baru,850","49,Udang Vaname,Seafood,Ekuador,60","50,Biji Chia,Superfood,Meksiko,55","51,Daun Lemon Verbena,Herbal,Chili,45","52,Ban Mobil,Otomotif,Thailand,120","53,Karpet Rajut,Dekorasi,Iran,4500","54,Kertas Kraft,Industri,Finlandia,15","55,Daun Dill,Herbal,Rusia,35","56,Biji Jagung Pipil,Pakan Ternak,Brasil,12","57,Mentega (Butter),Diary,Prancis,85","58,Tepung Tapioka,Bahan Baku,Vietnam,18","59,Daun Kaffir Lime,Dedaunan,Thailand,70","60,Serat Kapas,Tekstil,Uzbekistan,45","61,Minyak Kelapa Sawit,Industri,Malaysia,22","62,Beras Melati,Pangan,Thailand,28","63,Daun Lemongrass,Herbal,Vietnam,40","64,Alat Kesehatan,Medis,Jerman,8500","65,Biji Pinus,Snack,Rusia,95","66,Buah Kiwi,Buah,Selandia Baru,65","67,Daun Parsley,Herbal,Italia,35","68,Ikan Makarel,Seafood,Jepang,45","69,Biji Mustard,Rempah,Kanada,30","70,Susu Kedelai Bubuk,Minuman,Tiongkok,40","71,Daun Basil,Herbal,Italia,45","72,Lensa Kamera,Fotografi,Jepang,2500","73,Biji Bunga Matahari,Pangan,Ukraina,22","74,Madu Akasia,Kesehatan,Hungaria,150","75,Daun Shiso,Dedaunan,Jepang,120","76,Kain Wol,Tekstil,Inggris,350","77,Buah Naga,Buah,Vietnam,35","78,Minyak Wijen,Bumbu,Korea Selatan,85","79,Daun Lavender,Herbal,Prancis,120","80,Pupuk Kalium,Pertanian,Belarusia,180","81,Biji Kacang Tanah,Snack,India,25","82,Cuka Balsamik,Bumbu,Italia,650","83,Daun Marjoram,Herbal,Mesir,35","84,Tablet/Gadget,Elektronik,Vietnam,600","85,Biji Kopi Robusta,Minuman,Vietnam,45","86,Buah Ceri,Buah,Chili,120","87,Daun Tarragon,Herbal,Prancis,65","88,Produk Perawatan Pria,Kosmetik,Inggris,150","89,Biji Sorghum,Pangan,Amerika Serikat,20","90,Kulit Domba,Fashion,Selandia Baru,220","91,Daun Senna,Kesehatan,India,55","92,Ikan Tuna Bluefin,Seafood,Jepang,9500","93,Kacang Pistachio,Snack,Iran,180","94,Minyak Alpukat,Bahan Pangan,Meksiko,120","95,Daun Fenugreek,Rempah,India,40","96,Keramik Industri,Konstruksi,Spanyol,85","97,Biji Rami (Flaxseed),Superfood,Kanada,55","98,Cokelat Swiss,Olahan,Swiss,450","99,Daun Chives,Herbal,Jerman,35","100,Robot Industri,Manufaktur,Jepang,15000"];

        const items = raw.map(l => {
            const p = l.split(',');
            return { id: p[0], nama: p[1], kat: p[2], asal: p[3], harga: parseInt(p[4]) };
        });

        let totalT = 0, totalV = 0;

        function render(filter = "") {
            const fGrid = document.getElementById('featuredGrid');
            const gGrid = document.getElementById('globalGrid');
            fGrid.innerHTML = ""; gGrid.innerHTML = "";

            // Spotlight Indonesia (Hanya saat tidak mencari)
            if(filter === "") {
                items.filter(i => i.asal === "Indonesia" || i.id === "1").slice(0,4).forEach(i => {
                    fGrid.innerHTML += `
                        <div class="col-6 col-md-3">
                            <div class="product-card featured-card p-3 shadow-sm" onclick="selectItem('${i.nama}')">
                                <div class="featured-label">TOP</div>
                                <h6 class="fw-bold mb-1 small">${i.nama}</h6>
                                <span class="badge bg-light text-dark border small" style="font-size:0.6rem;">Origin: ${i.asal}</span>
                            </div>
                        </div>
                    `;
                });
                document.getElementById('spotlightArea').style.display = "block";
            } else {
                document.getElementById('spotlightArea').style.display = "none";
            }

            // Global Grid
            items.filter(i => i.nama.toLowerCase().includes(filter.toLowerCase()) || i.asal.toLowerCase().includes(filter.toLowerCase()))
                .forEach(i => {
                    const badge = i.asal === "Indonesia" ? '<span class="badge bg-success ms-1" style="font-size:0.5rem;">Local Premium</span>' : '';
                    gGrid.innerHTML += `
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="product-card p-2 shadow-sm" onclick="selectItem('${i.nama}')">
                                <p class="mb-1 text-primary fw-bold small" style="font-size:0.7rem;">${i.asal} ${badge}</p>
                                <h6 class="fw-bold mb-0 small">${i.nama}</h6>
                            </div>
                        </div>
                    `;
                });
        }

        function globalFilter() { render(document.getElementById('mainSearch').value); }

        function selectItem(name) {
            const i = items.find(x => x.nama === name);
            document.getElementById('vItem').value = i.nama;
            document.getElementById('vPrice').value = i.harga;
            document.getElementById('vOrigin').value = i.asal;
            recalc();
        }

        function recalc() {
            const p = document.getElementById('vPrice').value || 0;
            const v = document.getElementById('vVol').value || 0;
            const sub = p * v;
            const tax = sub * 0.01;
            const grand = sub + tax;

            document.getElementById('resSub').innerText = "$" + sub.toLocaleString();
            document.getElementById('resTax').innerText = "$" + tax.toLocaleString();
            document.getElementById('resTotal').innerText = "$" + grand.toLocaleString();
        }

        function syncToDB() {
            const n = document.getElementById('vItem').value;
            const v = document.getElementById('vVol').value;
            const t = document.getElementById('tradeType').value;
            const o = document.getElementById('vOrigin').value;
            const d = document.getElementById('vDest').value;
            const g = document.getElementById('resTotal').innerText;

            if(!n || v <= 0) { alert("Lengkapi data transaksi!"); return; }

            const batch = "#DB-" + Math.floor(Math.random()*9000+1000);
            const row = document.getElementById('dbLog').insertRow(0);
            row.innerHTML = `
                <td><small class="fw-bold">${batch}</small></td>
                <td><span class="badge ${t === 'EKSPOR' ? 'bg-warning text-dark' : 'bg-info'}">${t}</span></td>
                <td>${n}</td>
                <td class="small">${o} &rarr; ${d}</td>
                <td class="fw-bold text-success">${g}</td>
                <td><span class="text-success small fw-bold"><i class="fa-solid fa-check"></i> SYNCED</span></td>
            `;

            totalT++; totalV += parseInt(v);
            document.getElementById('statTotal').innerText = totalT;
            document.getElementById('statVol').innerHTML = totalV + " <span class='h6 text-muted'>Ton</span>";
            
            alert("Transaksi " + batch + " Berhasil Dicatat!");
            document.getElementById('tradeForm').reset(); recalc();
        }

        render();
    </script>
</body>
</html>