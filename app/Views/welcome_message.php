<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrace.io | Transaction Dashboard - Sesi 3</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root { --primary-teal: #16a085; --dark-navy: #243444; --mint-bg: #f0fcf8; }
        body { font-family: 'Open Sans', sans-serif; color: var(--dark-navy); background-color: #f8fbfd; }
        h1, h2, h3 { font-family: 'Montserrat', sans-serif; }
        .navbar { background-color: var(--dark-navy); border-bottom: 3px solid var(--primary-teal); }
        .btn-teal { background-color: var(--primary-teal); color: white; border-radius: 10px; }
        .btn-teal:hover { background-color: #12876f; color: white; }
        .card-custom { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-leaf text-success me-2"></i>EcoTrace.io <span class="badge bg-secondary ms-2" style="font-size: 0.6rem;">TRANSACTION MODE</span></a>
        </div>
    </nav>

    <main class="container my-5">
        <div class="row g-4">
            
            <div class="col-lg-5">
                <div class="card card-custom p-4 bg-white">
                    <h3 class="h5 mb-4"><i class="fa-solid fa-file-invoice me-2 text-primary"></i>Input Transaksi Ekspor</h3>
                    <form id="formTransaksi">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Produk</label>
                            <input type="text" id="namaProduk" class="form-control" placeholder="Cth: Biji Kopi Gayo" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Berat (Kg)</label>
                            <input type="number" id="beratProduk" class="form-control" placeholder="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Negara Tujuan</label>
                            <select id="tujuan" class="form-select" required>
                                <option value="" disabled selected>Pilih Tujuan</option>
                                <option value="Jerman">Jerman (EU)</option>
                                <option value="Amerika Serikat">Amerika Serikat (US)</option>
                                <option value="Jepang">Jepang (Asia)</option>
                            </select>
                        </div>
                        <button type="button" onclick="prosesTransaksi()" class="btn btn-teal w-100 py-2 fw-bold">Proses Verifikasi <i class="fa-solid fa-arrow-right ms-2"></i></button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card card-custom p-4 bg-white h-100">
                    <h3 class="h5 mb-4"><i class="fa-solid fa-database me-2 text-success"></i>Verified Export Database</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th>Berat</th>
                                    <th>Tujuan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tabelData">
                                <tr>
                                    <td>Karet Alam</td>
                                    <td>500 Kg</td>
                                    <td>Jepang</td>
                                    <td><span class="badge bg-success">Verified</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-4 text-white text-center mt-5" style="background-color: var(--dark-navy);">
        <p class="mb-0 opacity-50">&copy; 2026 Murni Agustina Andini - 25120100018. BWD Sesi 3.</p>
    </footer>

    <script>
        function prosesTransaksi() {
            // Ambil data dari form
            const produk = document.getElementById('namaProduk').value;
            const berat = document.getElementById('beratProduk').value;
            const tujuan = document.getElementById('tujuan').value;

            // Validasi sederhana
            if (produk === "" || berat === "" || tujuan === "") {
                alert("Murni, isi semua datanya dulu ya!");
                return;
            }

            // Ambil elemen tabel
            const tabel = document.getElementById('tabelData');

            // Tambahkan baris baru (Interaksi Transaksi)
            const row = tabel.insertRow(0); // Tambah di paling atas
            row.innerHTML = `
                <td>${produk}</td>
                <td>${berat} Kg</td>
                <td>${tujuan}</td>
                <td><span class="badge bg-info text-dark">Processing...</span></td>
            `;

            // Simulasi "Verifikasi" setelah 2 detik
            setTimeout(() => {
                row.cells[3].innerHTML = '<span class="badge bg-success">Verified</span>';
            }, 2000);

            // Reset form
            document.getElementById('formTransaksi').reset();
            alert("Transaksi Berhasil Diproses!");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>