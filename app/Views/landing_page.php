<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrace.io | Global Export Transparency - Sesi 3</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary-teal: #16a085;
            --dark-navy: #243444;
            --mint-bg: #f0fcf8;
        }
        body { font-family: 'Open Sans', sans-serif; color: var(--dark-navy); background-color: #f8fbfd; }
        h1, h2, h3 { font-family: 'Montserrat', sans-serif; }

        /* NAVBAR SESI 3 */
        .navbar { background-color: var(--dark-navy); border-bottom: 3px solid var(--primary-teal); }

        /* HERO SESI 3 (Dibuat sedikit berbeda tapi senada) */
        .hero-mini {
            background: linear-gradient(rgba(36, 52, 68, 0.8), rgba(36, 52, 68, 0.8)), 
                        url('https://images.unsplash.com/photo-1454165833767-027ffea9e77b?auto=format&fit=crop&q=80&w=2000');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 60px 0;
            margin-bottom: 50px;
        }

        .verified-card {
            border: none;
            border-radius: 15px;
            background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: 0.3s;
        }
        .verified-card:hover { transform: scale(1.02); }
        
        .badge-eco { background-color: var(--primary-teal); color: white; border-radius: 20px; padding: 5px 15px; font-size: 0.8rem; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-leaf text-success me-2"></i>EcoTrace.io <span class="badge bg-secondary ms-2" style="font-size: 0.6rem;">SESI 3</span></a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="#">Dashboard</a>
                <a class="nav-link" href="#">Data Center</a>
            </div>
        </div>
    </nav>

    <header class="hero-mini text-center">
        <div class="container">
            <h1 class="display-5 fw-bold">Transparency Dashboard</h1>
            <p class="lead opacity-75">Monitoring supply chain and global export compliance in real-time.</p>
        </div>
    </header>

    <main class="container mb-5">
        <div class="row g-4">
            <div class="col-md-8">
                <div class="p-4 bg-white rounded-4 shadow-sm">
                    <h2 class="h4 mb-4 border-bottom pb-2">Recent Export Verification</h2>
                    <table class="table table-hover mt-3">
                        <thead class="table-light">
                            <tr>
                                <th>Batch ID</th>
                                <th>Product Name</th>
                                <th>Destination</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#TRC-001</td>
                                <td>Organic Coffee Beans</td>
                                <td>Hamburg, DE</td>
                                <td><span class="badge-eco">Verified</span></td>
                            </tr>
                            <tr>
                                <td>#TRC-002</td>
                                <td>Natural Rubber</td>
                                <td>New York, US</td>
                                <td><span class="badge-eco">Verified</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4">
                <div class="verified-card p-4 text-center">
                    <i class="fa-solid fa-shield-check fa-3x text-success mb-3"></i>
                    <h4>Global Integrity</h4>
                    <p class="text-muted small">Semua data di atas telah melalui proses verifikasi Geo-Tagging dan Carbon Footprint Audit.</p>
                    <button class="btn btn-outline-success w-100 rounded-pill">Download Report</button>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-4 text-white text-center" style="background-color: var(--dark-navy);">
        <div class="container">
            <p class="mb-0 opacity-50">&copy; 2026 Murni Agustina Andini - 25120100018. <strong>BWD04 - Sesi 3 (EcoTrace)</strong></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>