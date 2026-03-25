<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrace.io | Global & Local Enterprise Hub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root { --primary-teal: #16a085; --dark-navy: #243444; --premium-gold: #d4af37; --eco-bg: #f4f8f7; }
        body { font-family: 'Open Sans', sans-serif; background-color: var(--eco-bg); color: var(--dark-navy); }
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; }
        
        .navbar { background-color: var(--dark-navy); border-bottom: 4px solid var(--primary-teal); }
        .stats-card { border: none; border-radius: 15px; background: white; border-left: 5px solid var(--primary-teal); padding: 15px; }
        .product-card { border: none; border-radius: 12px; transition: 0.3s; cursor: pointer; background: white; height: 100%; border: 1px solid #eee; }
        .product-card:hover { transform: translateY(-5px); border-color: var(--primary-teal); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .featured-label { position: absolute; top: 10px; right: -30px; background: var(--primary-teal); color: white; padding: 5px 35px; transform: rotate(45deg); font-size: 0.55rem; font-weight: bold; }
        .verification-panel { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); position: sticky; top: 20px; }
        .table-record { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark py-3 sticky-top shadow">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-earth-asia text-success me-2"></i>EcoTrace Global-Local Hub</a>
            <div id="google_translate_element"></div>
        </div>
    </nav>

    <main class="container my-4">
        <div class="row g-3 mb-4 text-center text-md-start">
            <div class="col-md-3">
                <div class="stats-card shadow-sm">
                    <small class="text-muted fw-bold">TOTAL TRANSACTIONS</small>
                    <h3 id="statTotal" class="mb-0">0</h3>
                </div>
            </div>
            <div class="col-md-9 d-flex align-items-center justify-content-end">
                <input type="text" id="mainSearch" onkeyup="globalFilter()" class="form-control w-50 rounded-pill shadow-sm" placeholder="Search Global & Local Commodities...">
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-boxes-stacked me-2"></i>Unified Commodity Showcase</h5>
                <div class="row g-3 mb-5" id="globalGrid" style="max-height: 550px; overflow-y: auto; padding: 10px;"></div>

                <div class="table-record mb-5">
                    <div class="p-3 bg-dark text-white d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold small">REAL-TIME TRADE LOG</h6>
                        <span class="badge bg-success small">Secure Blockchain Sync</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.75rem;">
                            <thead class="table-light">
                                <tr>
                                    <th>Batch ID</th><th>Commodity</th><th>Route</th><th>Payment</th><th>Final Value</th><th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dbLog"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="verification-panel border">
                    <h5 class="fw-bold mb-4 border-bottom pb-2">Verification Engine</h5>
                    <form id="tradeForm">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Currency Selection</label>
                            <select id="vCurrency" class="form-select border-primary fw-bold" onchange="recalc()">
                                <option value="USD">USD ($) - United States</option>
                                <option value="IDR" selected>IDR (Rp) - Indonesia</option>
                                <option value="CNY">CNY (¥) - China</option>
                                <option value="JPY">JPY (¥) - Japan</option>
                                <option value="EUR">EUR (€) - European Union</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Selected Item</label>
                            <input type="text" id="vItem" class="form-control bg-light fw-bold" readonly placeholder="Pick a product">
                            <input type="hidden" id="vPriceBase">
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold">Origin</label>
                                <input type="text" id="vOrigin" class="form-control bg-light small" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold">Quantity (Ton)</label>
                                <input type="number" id="vVol" onkeyup="recalc()" class="form-control border-success" placeholder="0">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Payment Method</label>
                            <select id="vPay" class="form-select small">
                                <option value="L/C">Letter of Credit (L/C)</option>
                                <option value="Bank Transfer">International Bank Transfer</option>
                                <option value="Blockchain">Blockchain Escrow</option>
                            </select>
                        </div>

                        <div class="p-3 rounded-3 bg-light border mb-4 shadow-sm" style="font-size: 0.8rem;">
                            <div class="d-flex justify-content-between"><span>Subtotal:</span><span id="resSub">0</span></div>
                            <div class="d-flex justify-content-between text-danger"><span>Carbon Tax (1%):</span><span id="resTax">0</span></div>
                            <div class="d-flex justify-content-between text-warning"><span>Export Duty (5%):</span><span id="resDuty">0</span></div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between h6 mb-0 text-success fw-bold">
                                <span>GRAND TOTAL:</span><span id="resTotal">0</span>
                            </div>
                        </div>

                        <button type="button" onclick="syncToDB()" class="btn btn-dark w-100 py-3 fw-bold rounded-pill">
                            COMMIT TRANSACTION <i class="fa-solid fa-shield-halved ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() { new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element'); }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script>
        // Currency Conversion (Simulated Rates)
        const rates = { USD: 1, IDR: 16000, CNY: 7.2, JPY: 150, EUR: 0.92 };
        const symbols = { USD: "$", IDR: "Rp", CNY: "¥", JPY: "¥", EUR: "€" };

        // Unified Database: Global (Session 2) + Local (Session 3)
        const globalProducts = [
            { name: "Matcha Powder", origin: "Japan", price: 100, adv: "Organic Ceremonial Grade" },
            { name: "Saffron", origin: "Iran", price: 2000, adv: "Purest Crocus Sativus" },
            { name: "Wagyu A5", origin: "Japan", price: 500, adv: "Highest Marbling Score" },
            { name: "Olive Oil", origin: "Italy", price: 80, adv: "Extra Virgin Cold Pressed" }
        ];

        const localProducts = [
            { name: "Gayo Arabica Coffee", origin: "Aceh", price: 8, adv: "Strong Body & Earthy Aroma" },
            { name: "Patchouli Oil", origin: "Aceh", price: 10, adv: "Premium Fragrance Fixative" },
            { name: "Bird's Nest", origin: "Kalimantan", price: 1250, adv: "Highest Purity Grade" },
            { name: "South Sea Pearl", origin: "Lombok", price: 300, adv: "Rare Gold & Silver Hue" },
            { name: "Hand-drawn Batik", origin: "Solo", advantage: "UNESCO Heritage Hand-painted", price: 95 }
            // ... (Other products can be added here)
        ];

        const inventory = [...globalProducts, ...localProducts];
        let transCount = 0;

        function render(filter = "") {
            const grid = document.getElementById('globalGrid');
            grid.innerHTML = "";
            inventory.filter(i => i.name.toLowerCase().includes(filter.toLowerCase())).forEach(i => {
                grid.innerHTML += `
                    <div class="col-6 col-md-4">
                        <div class="product-card p-3 position-relative" onclick="selectItem('${i.name}')">
                            <div class="featured-label">CERTIFIED</div>
                            <small class="text-primary fw-bold">${i.origin}</small>
                            <h6 class="fw-bold mb-1">${i.name}</h6>
                            <p class="text-muted small mb-0" style="font-size:0.6rem;">${i.adv || "Premium Export Grade"}</p>
                        </div>
                    </div>`;
            });
        }

        function selectItem(name) {
            const i = inventory.find(x => x.name === name);
            document.getElementById('vItem').value = i.name;
            document.getElementById('vPriceBase').value = i.price;
            document.getElementById('vOrigin').value = i.origin;
            recalc();
        }

        function recalc() {
            const basePrice = parseFloat(document.getElementById('vPriceBase').value) || 0;
            const vol = parseFloat(document.getElementById('vVol').value) || 0;
            const cur = document.getElementById('vCurrency').value;
            const rate = rates[cur];
            const sym = symbols[cur];

            const subUSD = basePrice * vol;
            const taxUSD = subUSD * 0.01;
            const dutyUSD = subUSD * 0.05;
            const grandUSD = subUSD + taxUSD + dutyUSD;

            document.getElementById('resSub').innerText = sym + (subUSD * rate).toLocaleString();
            document.getElementById('resTax').innerText = sym + (taxUSD * rate).toLocaleString();
            document.getElementById('resDuty').innerText = sym + (dutyUSD * rate).toLocaleString();
            document.getElementById('resTotal').innerText = sym + (grandUSD * rate).toLocaleString();
        }

        function syncToDB() {
            const name = document.getElementById('vItem').value;
            const vol = document.getElementById('vVol').value;
            if(!name || vol <= 0) return alert("Complete the transaction!");

            const row = document.getElementById('dbLog').insertRow(0);
            const batch = "#TRX-" + Math.floor(Math.random()*9000+1000);
            row.innerHTML = `
                <td><b>${batch}</b></td><td>${name}</td>
                <td><small>${document.getElementById('vOrigin').value} &rarr; Global</small></td>
                <td><span class="badge bg-secondary">${document.getElementById('vPay').value}</span></td>
                <td class="text-success fw-bold">${document.getElementById('resTotal').innerText}</td>
                <td><span class="text-success small fw-bold"><i class="fa-solid fa-check-double"></i> SYNCED</span></td>`;
            
            transCount++; document.getElementById('statTotal').innerText = transCount;
            alert("Transaction " + batch + " Encrypted & Synced to Blockchain.");
            document.getElementById('tradeForm').reset(); recalc();
        }

        function globalFilter() { render(document.getElementById('mainSearch').value); }
        render();
    </script>
</body>
</html>