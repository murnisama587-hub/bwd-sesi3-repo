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
        :root { --primary-teal: #16a085; --dark-navy: #243444; --premium-gold: #d4af37; }
        body { font-family: 'Open Sans', sans-serif; background-color: #f8fafb; color: var(--dark-navy); }
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; }
        
        /* NAVBAR */
        .navbar { background-color: var(--dark-navy); border-bottom: 4px solid var(--primary-teal); }
        
        /* SEARCH AREA */
        .search-hero { background: white; padding: 40px 0; border-bottom: 1px solid #eee; }
        .search-bar { border-radius: 40px; border: 2px solid #ddd; padding: 15px 30px; transition: 0.3s; }
        .search-bar:focus { border-color: var(--primary-teal); box-shadow: 0 0 15px rgba(22, 160, 133, 0.1); outline: none; }

        /* FEATURED SECTION */
        .featured-header { border-left: 5px solid var(--premium-gold); padding-left: 15px; margin-bottom: 25px; }
        .featured-card { border: 2px solid var(--premium-gold) !important; position: relative; overflow: hidden; }
        .featured-badge { position: absolute; top: 10px; right: -30px; background: var(--premium-gold); color: white; padding: 5px 40px; transform: rotate(45deg); font-size: 0.6rem; font-weight: bold; }

        /* PRODUCT CARDS */
        .product-card { border: none; border-radius: 15px; transition: 0.3s; cursor: pointer; background: white; border: 1px solid transparent; }
        .product-card:hover { transform: translateY(-8px); border-color: var(--primary-teal); box-shadow: 0 15px 30px rgba(0,0,0,0.08); }
        .card-img-top { height: 120px; object-fit: cover; border-radius: 15px 15px 0 0; }
        
        /* SIDEBAR FORM */
        .verification-panel { background: white; border-radius: 20px; padding: 30px; position: sticky; top: 100px; box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
        .id-badge { background: #fff5f5; color: #e74c3c; border: 1px solid #ffcfcf; font-size: 0.65rem; padding: 2px 8px; border-radius: 10px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fa-solid fa-earth-asia text-success me-2"></i>EcoTrace Global Hub
            </a>
            <div class="text-white d-none d-md-block small opacity-75">
                <i class="fa-solid fa-id-badge me-2 text-info"></i>Murni Agustina Andini (25120100018)
            </div>
        </div>
    </nav>

    <section class="search-hero shadow-sm">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8">
                    <h2 class="fw-800 mb-4">Global Commodity Marketplace</h2>
                    <div class="position-relative">
                        <input type="text" id="searchInput" onkeyup="globalSearch()" class="form-control search-bar" placeholder="Cari 100+ komoditas, negara asal, atau kategori...">
                        <i class="fa-solid fa-magnifying-glass position-absolute" style="right: 30px; top: 22px; color: #aaa;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="container my-5">
        <div class="row g-5">
            
            <div class="col-lg-8">
                
                <div id="featuredSection">
                    <div class="featured-header">
                        <h4 class="fw-bold m-0 text-uppercase" style="letter-spacing: 1px;">Premium Archipelago Origin</h4>
                        <small class="text-muted">Produk unggulan dengan standar verifikasi tertinggi</small>
                    </div>
                    <div class="row g-3 mb-5" id="featuredGrid">
                        </div>
                </div>

                <h4 class="fw-bold mb-4"><i class="fa-solid fa-globe me-2 text-primary"></i>Global Marketplace Hub</h4>
                <div class="row g-3" id="mainGrid" style="max-height: 600px; overflow-y: auto; padding-right: 10px;">
                    </div>
            </div>

            <div class="col-lg-4">
                <div class="verification-panel">
                    <h5 class="fw-bold mb-4 border-bottom pb-3"><i class="fa-solid fa-file-shield me-2 text-success"></i>Verification Center</h5>
                    <form id="vForm">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Selected Commodity</label>
                            <input type="text" id="vName" class="form-control bg-light fw-bold" readonly placeholder="Pilih produk...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Global Origin</label>
                            <input type="text" id="vOrigin" class="form-control bg-light" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Volume (Metric Tons)</label>
                            <input type="number" id="vVol" class="form-control border-primary" placeholder="Masukkan berat">
                        </div>
                        <div class="p-3 bg-light rounded-3 mb-4 border border-dashed">
                            <small class="text-muted d-block mb-1">Standard Highlights:</small>
                            <p id="vDetail" class="small mb-0 fw-600">Klik salah satu produk untuk melihat detail spesifikasi perdagangan.</p>
                        </div>
                        <button type="button" onclick="finalizeTransaction()" class="btn btn-dark w-100 py-3 fw-bold shadow-sm">
                            SYNC TO BLOCKCHAIN <i class="fa-solid fa-link ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-5 text-center bg-white border-top">
        <p class="text-muted small">&copy; 2026 Murni Agustina Andini - Cakrawala University | EcoTrace.io Enterprise MVP</p>
    </footer>

    <script>
        // MASTER DATABASE (100+ DATA MURNI)
        const masterData = [
            "1,Biji Kopi Gayo,Minuman,Indonesia,Grade seremonial, antioksidan tinggi",
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

        // KONVERSI DATA KE ARRAY OF OBJECTS
        const items = masterData.map(line => {
            const p = line.split(',');
            return { id: p[0], nama: p[1], kat: p[2], asal: p[3], detail: p[4] };
        });

        const imgLib = {
            "Minuman": "https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=300",
            "Rempah": "https://images.unsplash.com/photo-1509358271058-acd22cc93898?q=80&w=300",
            "Pangan": "https://images.unsplash.com/photo-1532336414038-cf19250c5757?q=80&w=300",
            "default": "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=300"
        };

        // RENDER FUNGSI
        function renderView(filter = "") {
            const grid = document.getElementById('mainGrid');
            const featuredGrid = document.getElementById('featuredGrid');
            grid.innerHTML = "";
            featuredGrid.innerHTML = "";

            // 1. Render Featured (Indonesian Special) - Hanya muncul kalau tidak sedang mencari
            if(filter === "") {
                const indos = items.filter(i => i.asal === "Indonesia").slice(0, 4);
                indos.forEach(i => {
                    featuredGrid.innerHTML += `
                        <div class="col-6 col-md-3">
                            <div class="card product-card featured-card h-100" onclick="selectItem('${i.nama}')">
                                <div class="featured-badge">TOP</div>
                                <img src="${imgLib[i.kat] || imgLib.default}" class="card-img-top">
                                <div class="card-body p-2">
                                    <span class="id-badge fw-bold">Archipelago Premium</span>
                                    <h6 class="fw-bold mb-0 mt-1" style="font-size:0.8rem;">${i.nama}</h6>
                                </div>
                            </div>
                        </div>
                    `;
                });
                document.getElementById('featuredSection').style.display = "block";
            } else {
                document.getElementById('featuredSection').style.display = "none";
            }

            // 2. Render Main Global Hub
            const filtered = items.filter(i => 
                i.nama.toLowerCase().includes(filter.toLowerCase()) || 
                i.asal.toLowerCase().includes(filter.toLowerCase())
            );

            filtered.forEach(i => {
                const isIndo = i.asal === "Indonesia" ? '<span class="id-badge ms-1">Premium Origin</span>' : '';
                grid.innerHTML += `
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="card product-card shadow-sm h-100" onclick="selectItem('${i.nama}')">
                            <div class="p-3">
                                <small class="text-primary fw-bold">${i.asal}</small> ${isIndo}
                                <h6 class="fw-bold mb-1 mt-1" style="font-size:0.85rem;">${i.nama}</h6>
                                <p class="text-muted small mb-0" style="font-size:0.7rem;">${i.kat}</p>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        function globalSearch() {
            renderView(document.getElementById('searchInput').value);
        }

        function selectItem(name) {
            const item = items.find(i => i.nama === name);
            document.getElementById('vName').value = item.nama;
            document.getElementById('vOrigin').value = item.asal;
            document.getElementById('vDetail').innerText = item.detail;
            alert("Sistem: Data " + name + " berhasil dimuat ke Verification Center.");
        }

        function finalizeTransaction() {
            const n = document.getElementById('vName').value;
            const v = document.getElementById('vVol').value;
            if(!n || !v) { alert("Lengkapi data verifikasi!"); return; }
            alert("SUCCESS: Transaksi " + n + " sebanyak " + v + " Ton telah ter-verifikasi aman!");
            document.getElementById('vForm').reset();
            document.getElementById('vDetail').innerText = "Klik salah satu produk untuk melihat detail spesifikasi perdagangan.";
        }

        renderView();
    </script>
</body>
</html>