
// ==========================================
// 1. DEKLARASI DATABASE UTAMA
// ==========================================
// Kita buat wadah 'inventory' dulu supaya baris bawah tidak error
let inventory = [
    { id: 101, nama: "Produk Contoh", kategori: "Lainnya", asal: "Jakarta", harga: 50000, stok: 10 }
];

// ==========================================
// 2. DATA 100 PRODUK INDONESIA
// ==========================================
const produkTambahan = [
    { id: 1, nama: "Daun Kelor (Moringa)", kategori: "Herbal", asal: "NTT", keunggulan: "Superfood nutrisi tertinggi", harga: 25000, stok: 50 },
    { id: 2, nama: "Daun Nilam", kategori: "Atsiri", asal: "Aceh & Sulawesi", keunggulan: "Pengikat parfum dunia", harga: 150000, stok: 20 },
    { id: 3, nama: "Daun Sirsak Kering", kategori: "Herbal", asal: "Jawa Tengah", keunggulan: "Alternatif kanker alami", harga: 35000, stok: 100 },
    { id: 4, nama: "Daun Teh Hitam", kategori: "Dedaunan", asal: "Kayu Aro (Jambi)", keunggulan: "Kualitas ekspor ke Inggris", harga: 45000, stok: 80 },
    { id: 5, nama: "Daun Pandan Kering", kategori: "Dedaunan", asal: "Jawa Barat", keunggulan: "Pewarna & aroma alami", harga: 15000, stok: 200 },
    { id: 6, nama: "Daun Salam Koja", kategori: "Rempah", asal: "Sumatra Utara", keunggulan: "Bumbu autentik Asia", harga: 10000, stok: 150 },
    { id: 7, nama: "Daun Stevia", kategori: "Pemanis", asal: "Tawangmangu", keunggulan: "Rendah kalori", harga: 55000, stok: 40 },
    { id: 8, nama: "Kopi Arabika Gayo", kategori: "Minuman", asal: "Aceh", keunggulan: "Aroma earthy kuat", harga: 120000, stok: 30 },
    { id: 9, nama: "Kopi Luwak", kategori: "Minuman", asal: "Lampung/Jawa", keunggulan: "Fermentasi unik", harga: 500000, stok: 10 },
    { id: 10, nama: "Biji Kakao (Cokelat)", kategori: "Bahan Baku", asal: "Sulawesi Tengah", keunggulan: "Premium dunia", harga: 85000, stok: 60 },
    { id: 11, nama: "Minyak Kelapa Sawit (CPO)", kategori: "Industri", asal: "Riau", keunggulan: "Terbesar di dunia", harga: 20000, stok: 1000 },
    { id: 12, nama: "Karet Alam", kategori: "Industri", asal: "Sumatra Selatan", keunggulan: "Standar ban internasional", harga: 30000, stok: 500 },
    { id: 13, nama: "Sarang Burung Walet", kategori: "Kesehatan", asal: "Kalimantan", keunggulan: "Ekspor termahal", harga: 20000000, stok: 5 },
    { id: 14, nama: "Kayu Manis", kategori: "Rempah", asal: "Kerinci (Jambi)", keunggulan: "Aroma manis rapi", harga: 70000, stok: 45 },
    { id: 15, nama: "Cengkeh", kategori: "Rempah", asal: "Maluku", keunggulan: "King of Spices", harga: 110000, stok: 55 },
    { id: 16, nama: "Lada Putih Muntok", kategori: "Rempah", asal: "Bangka Belitung", keunggulan: "Pedas khas", harga: 95000, stok: 40 },
    { id: 17, nama: "Pala (Nutmeg)", kategori: "Rempah", asal: "Banda (Maluku)", keunggulan: "Kualitas terbaik", harga: 130000, stok: 35 },
    { id: 18, nama: "Vanila Organik", kategori: "Rempah", asal: "Papua/NTT", keunggulan: "Aroma creamy tinggi", harga: 2500000, stok: 8 },
    { id: 19, nama: "Minyak Kelapa Dara (VCO)", kategori: "Kesehatan", asal: "Sulawesi Utara", keunggulan: "Cold-pressed murni", harga: 65000, stok: 70 },
    { id: 20, nama: "Arang Batok Kelapa", kategori: "Industri", asal: "Sulawesi/Jawa", keunggulan: "Bahan briket terbaik", harga: 12000, stok: 300 },
    { id: 21, nama: "Minyak Atsiri Sereh Wangi", kategori: "Atsiri", asal: "Jawa Barat", keunggulan: "Bahan sabun alami", harga: 80000, stok: 25 },
    { id: 22, nama: "Gula Aren", kategori: "Pemanis", asal: "Lebak/Cianjur", keunggulan: "Indeks glikemik rendah", harga: 35000, stok: 90 },
    { id: 23, nama: "Batik Tulis", kategori: "Fashion", asal: "Solo/Pekalongan", keunggulan: "Warisan UNESCO", harga: 1500000, stok: 15 },
    { id: 24, nama: "Tenun Ikat", kategori: "Fashion", asal: "NTT/Sumba", keunggulan: "Pewarna alami filosofis", harga: 2500000, stok: 10 },
    { id: 25, nama: "Mebel Kayu Jati", kategori: "Furniture", asal: "Jepara", keunggulan: "Ukiran tangan presisi", harga: 5000000, stok: 7 },
    { id: 26, nama: "Rotan", kategori: "Furniture", asal: "Cirebon/Katingan", keunggulan: "Pemasok 80% dunia", harga: 200000, stok: 40 },
    { id: 27, nama: "Buah Manggis", kategori: "Buah", asal: "Jawa Barat", keunggulan: "Queen of Fruits", harga: 30000, stok: 100 },
    { id: 28, nama: "Salak Pondoh", kategori: "Buah", asal: "Sleman", keunggulan: "Renyah & manis awet", harga: 20000, stok: 120 },
    { id: 29, nama: "Nanas Madu", kategori: "Buah", asal: "Pemalang", keunggulan: "Sangat manis", harga: 15000, stok: 150 },
    { id: 30, nama: "Buah Naga Merah", kategori: "Buah", asal: "Banyuwangi", keunggulan: "Warna cerah alami", harga: 25000, stok: 80 },
    { id: 31, nama: "Minyak Kayu Putih", kategori: "Kesehatan", asal: "Ambon", keunggulan: "Kadar sineol murni", harga: 45000, stok: 60 },
    { id: 32, nama: "Teh Putih (White Tea)", kategori: "Minuman", asal: "Ciwidey", keunggulan: "Pucuk daun termuda", harga: 150000, stok: 25 },
    { id: 33, nama: "Udang Vaname", kategori: "Seafood", asal: "Lampung/Jatim", keunggulan: "Budidaya intensif", harga: 85000, stok: 200 },
    { id: 34, nama: "Ikan Tuna (Yellowfin)", kategori: "Seafood", asal: "Maluku/Bitung", keunggulan: "Kualitas sashimi", harga: 120000, stok: 40 },
    { id: 35, nama: "Kepiting Bakau", kategori: "Seafood", asal: "Papua", keunggulan: "Daging padat jumbo", harga: 180000, stok: 30 },
    { id: 36, nama: "Rumput Laut", kategori: "Pangan", asal: "Sulawesi Selatan", keunggulan: "Bahan agar-agar", harga: 15000, stok: 500 },
    { id: 37, nama: "Batu Bara", kategori: "Pertambangan", asal: "Kalsel/Sumsel", keunggulan: "Energi global", harga: 1000000, stok: 1000 },
    { id: 38, nama: "Nikel", kategori: "Pertambangan", asal: "Sulawesi Tenggara", keunggulan: "Bahan baterai EV", harga: 500000, stok: 800 },
    { id: 39, nama: "Tembaga", kategori: "Pertambangan", asal: "Papua", keunggulan: "Konduktivitas tinggi", harga: 90000, stok: 600 },
    { id: 40, nama: "Timah", kategori: "Pertambangan", asal: "Bangka", keunggulan: "Komponen elektronik", harga: 250000, stok: 400 },
    { id: 41, nama: "Pasir Silika", kategori: "Industri", asal: "Belitung", keunggulan: "Bahan kaca & surya", harga: 5000, stok: 2000 },
    { id: 42, nama: "Kerajinan Perak", kategori: "Aksesori", asal: "Kotagede", keunggulan: "Handmade rumit", harga: 350000, stok: 20 },
    { id: 43, nama: "Sepatu Kulit", kategori: "Fashion", asal: "Cibaduyut", keunggulan: "Standar Eropa", harga: 450000, stok: 50 },
    { id: 44, nama: "Mie Instan", kategori: "Olahan", asal: "Nasional", keunggulan: "Populer di dunia", harga: 3500, stok: 5000 },
    { id: 45, nama: "Santan Kemasan", kategori: "Olahan", asal: "Riau", keunggulan: "Proses UHT segar", harga: 12000, stok: 300 },
    { id: 46, nama: "Krupuk Udang", kategori: "Olahan", asal: "Sidoarjo", keunggulan: "Gurih alami", harga: 25000, stok: 100 },
    { id: 47, nama: "Tempe Organik", kategori: "Pangan", asal: "Jawa", keunggulan: "Protein plant-based", harga: 15000, stok: 150 },
    { id: 48, nama: "Kacang Mete", kategori: "Snack", asal: "Wonogiri/Flores", keunggulan: "Biji besar utuh", harga: 130000, stok: 40 },
    { id: 49, nama: "Minyak Cengkeh", kategori: "Industri", asal: "Jawa Tengah", keunggulan: "Antiseptik alami", harga: 95000, stok: 35 },
    { id: 50, nama: "Getah Pinus", kategori: "Industri", asal: "Jawa", keunggulan: "Bahan cat & tinta", harga: 25000, stok: 400 },
    { id: 51, nama: "Daun Pisang Klutuk", kategori: "Dedaunan", asal: "Jawa", keunggulan: "Lentur & kuat", harga: 5000, stok: 1000 },
    { id: 52, nama: "Daun Jati Kering", kategori: "Dedaunan", asal: "Blora", keunggulan: "Kemas ramah lingkungan", harga: 2000, stok: 2000 },
    { id: 53, nama: "Daun Ketapang", kategori: "Akuarium", asal: "Kalimantan", keunggulan: "Stabilizer pH air", harga: 10000, stok: 500 },
    { id: 54, nama: "Bunga Krisan", kategori: "Florikultura", asal: "Tomohon", keunggulan: "Tahan layu", harga: 35000, stok: 100 },
    { id: 55, nama: "Bunga Anggrek", kategori: "Florikultura", asal: "Jawa Timur", keunggulan: "Spesies eksotis", harga: 75000, stok: 80 },
    { id: 56, nama: "Tanaman Monstera", kategori: "Florikultura", asal: "Jawa", keunggulan: "Varietas variegata", harga: 500000, stok: 10 },
    { id: 57, nama: "Pupuk Urea", kategori: "Pertanian", asal: "Palembang", keunggulan: "Standar global", harga: 10000, stok: 2000 },
    { id: 58, nama: "Semen Indonesia", kategori: "Konstruksi", asal: "Gresik", keunggulan: "Kekuatan internasional", harga: 60000, stok: 1000 },
    { id: 59, nama: "Kertas Fotokopi", kategori: "Industri", asal: "Jambi", keunggulan: "Putih & ramah lingkungan", harga: 50000, stok: 500 },
    { id: 60, nama: "Tisu Bambu", kategori: "Industri", asal: "Jawa", keunggulan: "Alternatif eco-friendly", harga: 15000, stok: 300 },
    { id: 61, nama: "Baju Muslim", kategori: "Fashion", asal: "Bandung/Jakarta", keunggulan: "Kiblat modest dunia", harga: 250000, stok: 100 },
    { id: 62, nama: "Tas Anyaman Pandan", kategori: "Aksesori", asal: "Tasikmalaya", keunggulan: "Etnik modern", harga: 120000, stok: 60 },
    { id: 63, nama: "Sepatu Olahraga", kategori: "Fashion", asal: "Tangerang", keunggulan: "Produksi merek global", harga: 350000, stok: 150 },
    { id: 64, nama: "Komponen Otomotif", kategori: "Industri", asal: "Bekasi", keunggulan: "Ekspor suku cadang", harga: 150000, stok: 500 },
    { id: 65, nama: "Kapal Pinisi", kategori: "Manufaktur", asal: "Bulukumba", keunggulan: "Kapal tradisional legendaris", harga: 500000000, stok: 2 },
    { id: 66, nama: "Garam Industri", kategori: "Pangan", asal: "Madura", keunggulan: "Kadar NaCl tinggi", harga: 8000, stok: 1000 },
    { id: 67, nama: "Minyak Jahe Gajah", kategori: "Atsiri", asal: "Jawa Tengah", keunggulan: "Ekstrak pedas farmasi", harga: 110000, stok: 40 },
    { id: 68, nama: "Kunyit Bubuk", kategori: "Rempah", asal: "Jawa Tengah", keunggulan: "Kurkumin tinggi", harga: 40000, stok: 100 },
    { id: 69, nama: "Temulawak", kategori: "Kesehatan", asal: "Jawa Tengah", keunggulan: "Tanaman obat asli", harga: 30000, stok: 120 },
    { id: 70, nama: "Kapulaga Jawa", kategori: "Rempah", asal: "Jawa Barat", keunggulan: "Aroma lembut", harga: 180000, stok: 30 },
    { id: 71, nama: "Bunga Kemuning", kategori: "Herbal", asal: "Jawa", keunggulan: "Bahan lulur tradisi", harga: 20000, stok: 50 },
    { id: 72, nama: "Minyak Kayu Manis", kategori: "Atsiri", asal: "Sumatra", keunggulan: "Aroma aromaterapi", harga: 130000, stok: 25 },
    { id: 73, nama: "Minyak Akar Wangi", kategori: "Atsiri", asal: "Garut", keunggulan: "Terbaik ke-2 dunia", harga: 200000, stok: 20 },
    { id: 74, nama: "Ikan Arwana Super Red", kategori: "Hewan", asal: "Kalimantan", keunggulan: "Ikan keberuntungan", harga: 15000000, stok: 5 },
    { id: 75, nama: "Ikan Cupang", kategori: "Hewan", asal: "Jakarta", keunggulan: "Variasi warna cantik", harga: 50000, stok: 200 },
    { id: 76, nama: "Mutiara Laut Selatan", kategori: "Perhiasan", asal: "Lombok", keunggulan: "Warna gold langka", harga: 5000000, stok: 15 },
    { id: 77, nama: "Batu Mulia (Akik)", kategori: "Perhiasan", asal: "Pacitan", keunggulan: "Motif unik", harga: 250000, stok: 50 },
    { id: 78, nama: "Cangkang Sawit", kategori: "Energi", asal: "Sumatra", keunggulan: "Biomassa eco-friendly", harga: 2000, stok: 5000 },
    { id: 79, nama: "Bungkil Kedelai", kategori: "Pakan", asal: "Jawa", keunggulan: "Protein tinggi ternak", harga: 7000, stok: 1000 },
    { id: 80, nama: "Daun Jeruk Purut", kategori: "Dedaunan", asal: "Jawa Timur", keunggulan: "Bumbu masakan Thai", harga: 15000, stok: 200 },
    { id: 81, nama: "Kulit Kayu Mahoni", kategori: "Industri", asal: "Jawa", keunggulan: "Pewarna alami tekstil", harga: 10000, stok: 300 },
    { id: 82, nama: "Madu Hutan", kategori: "Pangan", asal: "Sumbawa", keunggulan: "Madu liar murni", harga: 120000, stok: 40 },
    { id: 83, nama: "Jamu Kemasan", kategori: "Kesehatan", asal: "Sukoharjo", keunggulan: "Herbal modern", harga: 5000, stok: 1000 },
    { id: 84, nama: "Sirup Pala", kategori: "Minuman", asal: "Bogor", keunggulan: "Rasa segar khas", harga: 35000, stok: 60 },
    { id: 85, nama: "Kecap Manis", kategori: "Bumbu", asal: "Nasional", keunggulan: "Bumbu mendunia", harga: 15000, stok: 400 },
    { id: 86, nama: "Sambal Botol", kategori: "Bumbu", asal: "Nasional", keunggulan: "Pedas bervariasi", harga: 20000, stok: 300 },
    { id: 87, nama: "Alat Musik Gamelan", kategori: "Seni", asal: "Jawa Tengah", keunggulan: "Nada presisi perunggu", harga: 25000000, stok: 3 },
    { id: 88, nama: "Angklung", kategori: "Seni", asal: "Jawa Barat", keunggulan: "Musik bambu UNESCO", harga: 150000, stok: 20 },
    { id: 89, nama: "Wayang Kulit", kategori: "Seni", asal: "Yogyakarta", keunggulan: "Kulit tatah sungging", harga: 750000, stok: 15 },
    { id: 90, nama: "Sabun Mandi Herbal", kategori: "Kosmetik", asal: "Bali", keunggulan: "Bahan alami tropis", harga: 25000, stok: 150 },
    { id: 91, nama: "Lulur Bali", kategori: "Kosmetik", asal: "Bali", keunggulan: "Ekspor spa dunia", harga: 35000, stok: 120 },
    { id: 92, nama: "Minyak Goreng Kelapa", kategori: "Pangan", asal: "Sulawesi", keunggulan: "Alternatif sehat", harga: 35000, stok: 200 },
    { id: 93, nama: "Tepung Sagu", kategori: "Pangan", asal: "Papua", keunggulan: "Bebas gluten", harga: 15000, stok: 400 },
    { id: 94, nama: "Gula Singkong", kategori: "Pemanis", asal: "Lampung", keunggulan: "Aman bagi diabetes", harga: 45000, stok: 100 },
    { id: 95, nama: "Keripik Tempe", kategori: "Snack", asal: "Malang", keunggulan: "Renyah berprotein", harga: 15000, stok: 250 },
    { id: 96, nama: "Emping Melinjo", kategori: "Snack", asal: "Banten", keunggulan: "Pahit-gurih khas", harga: 40000, stok: 80 },
    { id: 97, nama: "Biji Kemiri", kategori: "Rempah", asal: "NTT", keunggulan: "Kadar minyak tinggi", harga: 45000, stok: 100 },
    { id: 98, nama: "Kopi Robusta Dampit", kategori: "Minuman", asal: "Malang", keunggulan: "Rasa cokelat kuat", harga: 80000, stok: 60 },
    { id: 99, nama: "Bungkil Kopra", kategori: "Pakan", asal: "Sulawesi", keunggulan: "Pakan ternak bergizi", harga: 5000, stok: 1000 },
    { id: 100, nama: "Briket Kayu", kategori: "Energi", asal: "Jawa Tengah", keunggulan: "Ramah lingkungan", harga: 15000, stok: 500 }
];

// ==========================================
// 3. LOGIKA PENGGABUNGAN (PERINTAH)
// ==========================================
// Memasukkan data tambahan ke dalam wadah inventory utama
inventory.push(...produkTambahan);

console.log("Database Siap! Sekarang ada " + inventory.length + " produk.");

// LANJUTKAN DENGAN LOGIKA TRANSAKSI / PROMO ASLI KAMU DI BAWAH INI