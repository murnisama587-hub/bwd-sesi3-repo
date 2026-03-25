<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrace.io | Global Supply Chain 100+ Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root { --primary-teal: #16a085; --dark-navy: #243444; }
        body { font-family: 'Open Sans', sans-serif; background-color: #f0f4f3; color: var(--dark-navy); }
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; }
        
        .navbar { background-color: var(--dark-navy); border-bottom: 4px solid var(--primary-teal); }
        .search-section { background: white; padding: 20px 0; border-bottom: 1px solid #ddd; position: sticky; top: 70px; z-index: 100; }
        .search-bar { border-radius: 30px; border: 2px solid var(--primary-teal); padding: 12px 25px; }

        /* KOTAK KATALOG */
        .catalog-container { height: 600px; overflow-y: scroll; padding: 15px; background: #e9eeed; border-radius: 15px; }
        .product-card { border: none; border-radius: 12px; transition: 0.3s; cursor: pointer; background: white; overflow: hidden; border-bottom: 4px solid transparent; }
        .product-card:hover { transform: translateY(-5px); border-bottom-color: var(--primary-teal); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card-img-top { height: 110px; object-fit: cover; background: #eee; }
        
        /* FORM & TABLE */
        .form-panel { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); position: sticky; top: 180px; }
        .log-container { background: white; border-radius: 15px; overflow: hidden; margin-top: 30px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-leaf text-success me-2"></i>EcoTrace Global <span class="badge bg-warning text-dark ms-2" style="font-size: 0.6rem;">BIG DATA V2.0</span></a>
            <div class="text-white d-none d-md-block small">
                <i class="fa-solid fa-user-shield me-2 text-info"></i>Murni Agustina Andini | 25120100018
            </div>
        </div>
    </nav>

    <div class="search-section shadow-sm">
        <div class="container text-center">
            <h4 class="fw-bold mb-3 small text-uppercase" style="letter-spacing: 2px;">Global Commodity Search Engine</h4>
            <div class="row justify-content-center">
                <div class="col-md-8 position-relative">
                    <input type="text" id="mainSearch" onkeyup="filterProcess()" class="form-control search-bar" placeholder="Cari 100 Komoditas (Contoh: Matcha, Jepang, Rempah, Elektronik...)">
                    <i class="fa-solid fa-magnifying-glass position-absolute" style="right: 30px; top: 18px; color: var(--primary-teal);"></i>
                </div>
            </div>
        </div>
    </div>

    <main class="container my-5">
        <div class="row g-4">
            
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold m-0"><i class="fa-solid fa-boxes-stacked me-2"></i>Total Komoditas: <span id="count" class="text-primary">100</span></h5>
                </div>
                
                <div class="catalog-container shadow-inner" id="grid">
                    </div>

                <div class="log-container shadow">
                    <div class="p-3 bg-dark text-white d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold"><i class="fa-solid fa-clock-rotate-left me-2 text-success"></i>SYNCED DATABASE RECORDS</h6>
                        <button class="btn btn-sm btn-success" onclick="alert('Exporting to Excel...')">Export Data</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.8rem;">
                            <thead class="table-light">
                                <tr>
                                    <th>Batch ID</th>
                                    <th>Produk</th>
                                    <th>Origin</th>
                                    <th>Keunggulan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="logTable">
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-panel border-top border-4 border-success">
                    <h5 class="fw-bold mb-4">Verifikasi Transaksi</h5>
                    <form id="tradeForm">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Komoditas & Kategori</label>
                            <input type="text" id="vName" class="form-control bg-light fw-bold" readonly placeholder="Pilih dari katalog">
                            <input type="text" id="vCat" class="form-control bg-light mt-1 small" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Negara Asal</label>
                            <input type="text" id="vOrigin" class="form-control bg-light" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Volume Ekspor (Ton)</label>
                            <input type="number" id="volume" class="form-control border-success" placeholder="0">
                        </div>
                        <div class="p-3 rounded-3 bg-light border mb-4">
                            <small class="fw-bold text-muted">Feature Highlight:</small>
                            <p id="vFeat" class="small mb-0 text-dark" style="font-style: italic;">Data belum dimuat...</p>
                        </div>
                        <button type="button" onclick="syncDB()" class="btn btn-dark w-100 py-3 fw-bold rounded-3">
                            SYNC TO DATABASE <i class="fa-solid fa-cloud-arrow-up ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-4 text-center text-muted bg-white border-top mt-5">
        <small><strong>EcoTrace Global Hub</strong> &copy; 2026 Murni Agustina Andini - Cakrawala University</small>
    </footer>

    <script>
        // SISTEM GAMBAR BERDASARKAN KATEGORI (STABIL & ANTI HILANG)
        const imgMap = {
            "Dedaunan": "https://images.unsplash.com/photo-1544787210-2213d2429f3b?q=80&w=300",
            "Herbal": "https://images.unsplash.com/photo-1515442261904-6c301f11c0ee?q=80&w=300",
            "Minuman": "https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=300",
            "Rempah": "https://images.unsplash.com/photo-1509358271058-acd22cc93898?q=80&w=300",
            "Pangan": "https://images.unsplash.com/photo-1532336414038-cf19250c5757?q=80&w=300",
            "Bahan Pangan": "https://images.unsplash.com/photo-1532336414038-cf19250c5757?q=80&w=300",
            "Protein": "https://images.unsplash.com/photo-1551028340-419670135823?q=80&w=300",
            "Seafood": "https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?q=80&w=300",
            "Teknologi": "https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=300",
            "Elektronik": "https://images.unsplash.com/photo-1550009158-9ebf69173e03?q=80&w=300",
            "Fashion": "https://images.unsplash.com/photo-1524380365003-32824e3e346d?q=80&w=300",
            "Tekstil": "https://images.unsplash.com/photo-1524380365003-32824e3e346d?q=80&w=300",
            "Aksesori": "https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=300",
            "Diary": "https://images.unsplash.com/photo-1550583724-125581fe2f8a?q=80&w=300",
            "Kosmetik": "https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=300",
            "Kecantikan": "https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=300",
            "Buah": "https://images.unsplash.com/photo-1610832958506-aa56338406cd?q=80&w=300",
            "Snack": "https://images.unsplash.com/photo-1599490659213-e2b9527bb087?q=80&w=300"
        };
        const defaultImg = "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=300";

        // DATABASE 100 ITEM MURNI
        const murniData = [
            "1,Daun Matcha,Dedaunan,Jepang,Grade seremonial, antioksidan tinggi",
            "2,Biji Kopi Arabika,Minuman,Brasil,Profil rasa nutty dan cokelat",
            "3,Saffron,Rempah,Iran,Kualitas stigma terbaik di dunia",
            "4,Minyak Zaitun,Bahan Pangan,Italia,Extra Virgin, cold-pressed",
            "5,Daun Stevia,Pemanis,Tiongkok,Kemurnian tinggi, nol kalori",
            "6,Ginseng Merah,Kesehatan,Korea Selatan,Usia tanam 6 tahun (premium)",
            "7,Bunga Tulip,Florikultura,Belanda,Variasi warna dan ketahanan lama",
            "8,Daging Wagyu A5,Protein,Jepang,Marbling ratio tertinggi",
            "9,Quinoa Organik,Serealia,Peru,Superfood, bebas gluten",
            "10,Daun Eucalyptus,Minyak Atsiri,Australia,Kadar cineole tinggi",
            "11,Kurma Medjool,Buah,Mesir,Tekstur lembut dan ukuran besar",
            "12,Keju Parmesan,Diary,Italia,Sertifikasi DOP (asli Parma)",
            "13,Vanila Bean,Rempah,Madagaskar,Aroma floral dan creamy",
            "14,Kacang Hazelnut,Snack,Turki,Suplai 70% pasar global",
            "15,Wine Bordeaux,Minuman,Prancis,Tradisi fermentasi klasik",
            "16,Cokelat Couverture,Olahan,Belgia,Kandungan cocoa butter tinggi",
            "17,Beras Basmati,Pangan,India,Bulir panjang dan aroma khas",
            "18,Daun Rosemary,Herbal,Yunani,Organik, pengeringan alami",
            "19,Kulit Sapi (Leather),Fashion,Italia,Tekstur lembut, tahan lama",
            "20,Mesin Presisi,Teknologi,Jerman,Standar industri otomotif",
            "21,Biji Kakao,Bahan Baku,Ghana,Karakter rasa cokelat yang kuat",
            "22,Daun Teh Oolong,Dedaunan,Taiwan,Semi-fermentasi, rasa floral",
            "23,Minyak Argan,Kosmetik,Maroko,Emas cair untuk rambut & kulit",
            "24,Salmon Atlantik,Seafood,Norwegia,Kandungan Omega-3 sangat tinggi",
            "25,Daun Sage,Herbal,Spanyol,Aroma kuat untuk kuliner Mediterania",
            "26,Keramik Porselen,Dekorasi,Tiongkok,Detail lukisan tangan tradisional",
            "27,Chip Semikonduktor,Elektronik,Taiwan,Arsitektur nanometer terbaru",
            "28,Susu Bubuk,Diary,Selandia Baru,Sapi pemakan rumput (grass-fed)",
            "29,Daun Bay (Salam),Rempah,Turki,Pengeringan udara, aroma awet",
            "30,Parfum,Kecantikan,Prancis,Racikan perfumer ternama (Grasse)",
            "31,Gandum Hard Wheat,Pangan,Kanada,Kadar protein tinggi untuk roti",
            "32,Buah Pir (Singo),Buah,Korea Selatan,Sangat berair dan manis",
            "33,Daun Thyme,Herbal,Prancis,Standar kuliner bintang lima",
            "34,Biji Wijen,Bahan Baku,Ethiopia,Kadar minyak tinggi, aroma nutty",
            "35,Mesin Kopi,Elektronik,Italia,Tekanan bar stabil, desain ikonik",
            "36,Sutra Alam,Tekstil,Tiongkok,Kilau alami dan sangat lembut",
            "37,Garam Himalaya,Bumbu,Pakistan,Kandungan mineral tinggi (pink)",
            "38,Daun Mint Kering,Dedaunan,Maroko,Paling cocok untuk teh mint",
            "39,Kacang Almond,Snack,Amerika Serikat,Produksi California, ukuran besar",
            "40,Wine Prosecco,Minuman,Italia,Gelembung halus, rasa ringan",
            "41,Kristal Swarowski,Aksesori,Austria,Pemotongan presisi tinggi",
            "42,Daun Oregano,Herbal,Yunani,Aroma pedas dan bersahaja",
            "43,Biji Kedelai,Pangan,Amerika Serikat,Non-GMO tersedia, kualitas stabil",
            "44,Kayu Jati,Bahan Bangunan,Myanmar,Kepadatan tinggi, tahan cuaca",
            "45,Minyak Kanola,Bahan Pangan,Kanada,Titik asap tinggi, rendah lemak",
            "46,Jam Tangan,Aksesori,Swiss,Mekanik presisi, tahan puluhan tahun",
            "47,Daun Pandan Bubuk,Dedaunan,Thailand,Praktis untuk industri bakery",
            "48,Madu Manuka,Kesehatan,Selandia Baru,Kandungan antibakteri (UMF) tinggi",
            "49,Udang Vaname,Seafood,Ekuador,Bebas antibiotik, ukuran seragam",
            "50,Biji Chia,Superfood,Meksiko,Sumber serat dan protein nabati",
            "51,Daun Lemon Verbena,Herbal,Chili,Aroma citrus yang menenangkan",
            "52,Ban Mobil,Otomotif,Thailand,Karet alam kualitas ekspor",
            "53,Karpet Rajut,Dekorasi,Iran,Benang sutra, motif historis",
            "54,Kertas Kraft,Industri,Finlandia,Serat kayu panjang, sangat kuat",
            "55,Daun Dill,Herbal,Rusia,Aroma unik untuk pengawetan",
            "56,Biji Jagung Pipil,Pakan Ternak,Brasil,Harga kompetitif, pasokan stabil",
            "57,Mentega (Butter),Diary,Prancis,Lemak tinggi (82%), rasa gurih",
            "58,Tepung Tapioka,Bahan Baku,Vietnam,Putih bersih, daya rekat tinggi",
            "59,Daun Kaffir Lime,Dedaunan,Thailand,Aroma jeruk yang sangat tajam",
            "60,Serat Kapas,Tekstil,Uzbekistan,Serat panjang, kualitas benang halus",
            "61,Minyak Kelapa Sawit,Industri,Malaysia,Produksi efisien, standar RSPO",
            "62,Beras Melati,Pangan,Thailand,Harum alami, tekstur pulen",
            "63,Daun Lemongrass,Herbal,Vietnam,Standar ekspor untuk teh herbal",
            "64,Alat Kesehatan,Medis,Jerman,Akurasi tinggi, standar ISO",
            "65,Biji Pinus,Snack,Rusia,Rasa gurih dan tekstur renyah",
            "66,Buah Kiwi,Buah,Selandia Baru,Kaya Vitamin C, daging buah hijau",
            "67,Daun Parsley,Herbal,Italia,Warna hijau tua, aroma segar",
            "68,Ikan Makarel,Seafood,Jepang,Segar, pembekuan cepat di kapal",
            "69,Biji Mustard,Rempah,Kanada,Bahan dasar saus mustard dunia",
            "70,Susu Kedelai Bubuk,Minuman,Tiongkok,Kelarutan tinggi, rasa autentik",
            "71,Daun Basil,Herbal,Italia,Bahan utama saus Pesto asli",
            "72,Lensa Kamera,Fotografi,Jepang,Optik jernih, distorsi minimal",
            "73,Biji Bunga Matahari,Pangan,Ukraina,Ukuran biji besar, kaya minyak",
            "74,Madu Akasia,Kesehatan,Hungaria,Warna bening, rasa manis lembut",
            "75,Daun Shiso,Dedaunan,Jepang,Pendamping sashimi, rasa unik",
            "76,Kain Wol,Tekstil,Inggris,Klasik, hangat, kualitas penjahitan",
            "77,Buah Naga,Buah,Vietnam,Kulit cerah, daging buah manis",
            "78,Minyak Wijen,Bumbu,Korea Selatan,Aroma panggang yang kuat",
            "79,Daun Lavender,Herbal,Prancis,Kualitas parfum & teh relaksasi",
            "80,Pupuk Kalium,Pertanian,Belarusia,Kandungan unsur hara sangat tinggi",
            "81,Biji Kacang Tanah,Snack,India,Kadar minyak seimbang",
            "82,Cuka Balsamik,Bumbu,Italia,Fermentasi barel kayu bertahun-tahun",
            "83,Daun Marjoram,Herbal,Mesir,Rasa manis pahit yang seimbang",
            "84,Tablet/Gadget,Elektronik,Vietnam,Pusat perakitan merek global",
            "85,Biji Kopi Robusta,Minuman,Vietnam,Body tebal, kafein tinggi",
            "86,Buah Ceri,Buah,Chili,Ukuran besar, manis saat musim",
            "87,Daun Tarragon,Herbal,Prancis,Esensial untuk saus Béarnaise",
            "88,Produk Perawatan Pria,Kosmetik,Inggris,Tradisi grooming klasik",
            "89,Biji Sorghum,Pangan,Amerika Serikat,Alternatif gandum yang sehat",
            "90,Kulit Domba,Fashion,Selandia Baru,Sangat lembut dan fleksibel",
            "91,Daun Senna,Kesehatan,India,Pencahar alami industri farmasi",
            "92,Ikan Tuna Bluefin,Seafood,Jepang,Daging bagian o-toro terbaik",
            "93,Kacang Pistachio,Snack,Iran,Warna hijau cerah, rasa gurih",
            "94,Minyak Alpukat,Bahan Pangan,Meksiko,Nutrisi tinggi, titik asap tinggi",
            "95,Daun Fenugreek,Rempah,India,Aroma kari yang mendalam",
            "96,Keramik Industri,Konstruksi,Spanyol,Tahan gores, desain minimalis",
            "97,Biji Rami (Flaxseed),Superfood,Kanada,Kandungan Omega-3 nabati tinggi",
            "98,Cokelat Swiss,Olahan,Swiss,Teknik conching yang sangat halus",
            "99,Daun Chives,Herbal,Jerman,Aroma bawang yang lembut",
            "100,Robot Industri,Manufaktur,Jepang,Otomasi presisi tinggi"
        ];

        const products = murniData.map(line => {
            const p = line.split(',');
            return { id: p[0], nama: p[1], kat: p[2], asal: p[3], fitur: p[4] };
        });

        function render(data) {
            const grid = document.getElementById('grid');
            grid.innerHTML = "";
            data.forEach(item => {
                const img = imgMap[item.kat] || defaultImg;
                grid.innerHTML += `
                    <div class="col-6 col-md-3 mb-2 px-1">
                        <div class="product-card shadow-sm h-100" onclick="loadItem('${item.nama}')">
                            <img src="${img}" class="card-img-top" onerror="this.src='${defaultImg}'">
                            <div class="p-2">
                                <span class="badge bg-light text-dark border small" style="font-size:0.6rem;">${item.asal}</span>
                                <h6 class="fw-bold mb-0 mt-1" style="font-size:0.75rem;">${item.nama}</h6>
                            </div>
                        </div>
                    </div>
                `;
            });
            document.getElementById('count').innerText = data.length;
        }

        function filterProcess() {
            const key = document.getElementById('mainSearch').value.toLowerCase();
            const filtered = products.filter(p => 
                p.nama.toLowerCase().includes(key) || 
                p.asal.toLowerCase().includes(key) || 
                p.kat.toLowerCase().includes(key)
            );
            render(filtered);
        }

        function loadItem(name) {
            const p = products.find(i => i.nama === name);
            document.getElementById('vName').value = p.nama;
            document.getElementById('vCat').value = "Category: " + p.kat;
            document.getElementById('vOrigin').value = p.asal;
            document.getElementById('vFeat').innerText = p.fitur;
            alert("Sistem: Data " + name + " berhasil dimuat ke Form Verifikasi.");
        }

        function syncDB() {
            const name = document.getElementById('vName').value;
            const vol = document.getElementById('volume').value;
            if(!name || !vol) { alert("Data tidak lengkap!"); return; }

            const p = products.find(i => i.nama === name);
            const batch = "#TRX-" + Math.floor(Math.random()*9000+1000);
            const table = document.getElementById('logTable');
            const row = table.insertRow(0);
            row.innerHTML = `
                <td><small class="fw-bold">${batch}</small></td>
                <td>${name}</td>
                <td><span class="badge bg-info text-dark">${p.asal}</span></td>
                <td style="font-size:0.7rem;">${p.fitur.substring(0,30)}...</td>
                <td><span class="text-success small fw-bold">SYNCED</span></td>
            `;
            alert("Murni, transaksi " + batch + " telah tersimpan aman di database!");
            document.getElementById('tradeForm').reset();
            document.getElementById('vFeat').innerText = "Data belum dimuat...";
        }

        render(products);
    </script>
</body>
</html>