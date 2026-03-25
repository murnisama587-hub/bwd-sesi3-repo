<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrace.io | Global Supply Chain Ultimate</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root { 
            --primary-teal: #16a085; 
            --dark-navy: #243444; 
            --premium-gold: #d4af37; 
            --eco-bg: #f4f8f7; 
        }
        body { font-family: 'Open Sans', sans-serif; background-color: var(--eco-bg); color: var(--dark-navy); }
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; }
        
        /* Google Translate Widget Overrides */
        #google_translate_element { margin-left: 15px; }
        .goog-te-gadget-simple { background: transparent !important; border: 1px solid rgba(255,255,255,0.2) !important; border-radius: 20px; padding: 2px 8px !important; }
        .goog-te-gadget-simple span { color: white !important; font-size: 0.75rem; }

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
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-leaf text-success me-2"></i>EcoTrace Global Enterprise</a>
            
            <div class="d-flex align-items-center">
                <div id="google_translate_element"></div>
                <div class="text-white d-none d-md-block small opacity-75 ms-3 border-start ps-3">
                    <i class="fa-solid fa-user-circle me-1"></i> Murni Agustina Andini
                </div>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="stats-card shadow-sm">
                    <small class="text-muted fw-bold text-uppercase">Total Transacted</small>
                    <h3 id="statTotal" class="mb-0">0</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card shadow-sm" style="border-left-color: var(--premium-gold);">
                    <small class="text-muted fw-bold text-uppercase">Verified Volume</small>
                    <h3 id="statVol" class="mb-0">0 <span class="h6 text-muted">Tons</span></h3>
                </div>
            </div>
            <div class="col-md-6 text-end d-flex align-items-center justify-content-end">
                <div class="input-group w-75">
                    <span class="input-group-text bg-white border-end-0 rounded-start-pill"><i class="fa-solid fa-search text-muted"></i></span>
                    <input type="text" id="mainSearch" onkeyup="globalFilter()" class="form-control rounded-end-pill border-start-0 shadow-none" placeholder="Search 100+ global commodities...">
                </div>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-8">
                
                <div id="spotlightArea">
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-star text-warning me-2"></i>Archipelago Premium Origin</h5>
                    <div class="row g-2 mb-4" id="featuredGrid"></div>
                </div>

                <h5 class="fw-bold mb-3"><i class="fa-solid fa-earth-americas text-primary me-2"></i>Global Marketplace Hub</h5>
                <div class="row g-2 mb-5" id="globalGrid" style="max-height: 500px; overflow-y: auto;"></div>

                <div class="table-record mb-5">
                    <div class="p-3 bg-dark text-white d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold">BLOCKCHAIN RECORD LOG</h6>
                        <span class="badge bg-success small"><i class="fa-solid fa-shield-halved me-1"></i> Secure Sync Active</span>
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
                    <h5 class="fw-bold mb-4">Trade Verification</h5>
                    <form id="tradeForm">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Transaction Category</label>
                            <select id="tradeType" class="form-select border-primary fw-bold">
                                <option value="EXPORT">EXPORT (Global Sale)</option>
                                <option value="IMPORT">IMPORT (Local Buy)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Selected Commodity</label>
                            <input type="text" id="vItem" class="form-control bg-light fw-bold" readonly placeholder="Select from catalog">
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
                                    <option value="United States">United States</option>
                                    <option value="Germany">Germany (EU)</option>
                                    <option value="Japan">Japan</option>
                                    <option value="China">China</option>
                                    <option value="Indonesia">Indonesia</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Net Volume (Tons)</label>
                            <input type="number" id="vVol" onkeyup="recalc()" class="form-control border-success" placeholder="Enter amount">
                        </div>
                        
                        <div class="p-3 rounded-3 bg-light border mb-4" style="font-size: 0.85rem;">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Market Subtotal:</span>
                                <span class="fw-bold" id="resSub">$0</span>
                            </div>
                            <div class="d-flex justify-content-between text-danger mb-1">
                                <span>Carbon Tax (1%):</span>
                                <span class="fw-bold" id="resTax">$0</span>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between h6 mb-0 text-success">
                                <span class="fw-bold">GRAND TOTAL:</span>
                                <span class="fw-bold" id="resTotal">$0</span>
                            </div>
                        </div>

                        <button type="button" onclick="syncToDB()" class="btn btn-dark w-100 py-3 fw-bold shadow">
                            VERIFY & SYNC TO DB <i class="fa-solid fa-cloud-arrow-up ms-2 text-success"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-4 text-center text-muted border-top mt-5 bg-white">
        <small>&copy; 2026 Murni Agustina Andini - 25120100018 | EcoTrace Enterprise Hub</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'id,en,zh-CN,ja,fr,de',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script>
        // MASTER DATA (Automated Translation of Key items)
        const raw = ["1,Matcha Powder,Leaves,Japan,100","2,Arabica Coffee Beans,Beverage,Brazil,150","3,Saffron,Spice,Iran,2000","4,Olive Oil,Food,Italy,80","5,Stevia Leaf,Sweetener,China,40","6,Red Ginseng,Health,South Korea,300","7,Tulip Bulbs,Floriculture,Netherlands,50","8,Wagyu A5 Beef,Protein,Japan,500","9,Organic Quinoa,Cereal,Peru,45","10,Eucalyptus Leaf,Essential Oil,Australia,60","11,Medjool Dates,Fruit,Egypt,35","12,Parmesan Cheese,Diary,Italy,120","13,Vanilla Bean,Spice,Madagascar,400","14,Hazelnuts,Snack,Turkey,30","15,Bordeaux Wine,Beverage,France,250","16,Couverture Chocolate,Processed,Belgium,95","17,Basmati Rice,Food,India,25","18,Rosemary Leaf,Herbal,Greece,55","19,Cattle Leather,Fashion,Italy,180","20,Precision Machinery,Technology,Germany,5000","21,Cocoa Beans,Raw Material,Ghana,40","22,Oolong Tea,Leaves,Taiwan,120","23,Argan Oil,Cosmetic,Morocco,350","24,Atlantic Salmon,Seafood,Norway,90","25,Sage Leaf,Herbal,Spain,45","26,Porcelain Ceramics,Decoration,China,220","27,Semiconductor Chips,Electronics,Taiwan,8000","28,Milk Powder,Diary,New Zealand,50","29,Bay Leaves,Spice,Turkey,30","30,Luxury Perfume,Beauty,France,1500","31,Hard Wheat,Food,Canada,20","32,Singo Pear,Fruit,South Korea,45","33,Thyme Leaf,Herbal,France,50","34,Sesame Seeds,Raw Material,Ethiopia,35","35,Coffee Machinery,Electronics,Italy,1200","36,Natural Silk,Textile,China,400","37,Himalayan Salt,Seasoning,Pakistan,15","38,Dried Mint,Leaves,Morocco,40","39,Almonds,Snack,USA,75","40,Prosecco Wine,Beverage,Italy,180","41,Swarovski Crystal,Accessory,Austria,900","42,Oregano,Herbal,Greece,35","43,Soybeans,Food,USA,18","44,Teak Wood,Construction,Myanmar,1500","45,Canola Oil,Food,Canada,30","46,Swiss Watch,Accessory,Switzerland,3500","47,Pandan Powder,Leaves,Thailand,65","48,Manuka Honey,Health,New Zealand,850","49,Vannamei Shrimp,Seafood,Ecuador,60","50,Chia Seeds,Superfood,Mexico,55","51,Lemon Verbena,Herbal,Chile,45","52,Car Tires,Automotive,Thailand,120","53,Hand-knotted Carpet,Decoration,Iran,4500","54,Kraft Paper,Industrial,Finland,15","55,Dill Leaf,Herbal,Russia,35","56,Corn Kernels,Animal Feed,Brazil,12","57,Butter,Diary,France,85","58,Tapioca Flour,Raw Material,Vietnam,18","59,Kaffir Lime Leaf,Leaves,Thailand,70","60,Cotton Fiber,Textile,Uzbekistan,45","61,Palm Oil,Industrial,Malaysia,22","62,Jasmine Rice,Food,Thailand,28","63,Lemongrass,Herbal,Vietnam,40","64,Medical Equipment,Medical,Germany,8500","65,Pine Nuts,Snack,Russia,95","66,Kiwi Fruit,Fruit,New Zealand,65","67,Parsley,Herbal,Italy,35","68,Mackerel,Seafood,Japan,45","69,Mustard Seeds,Spice,Canada,30","70,Soy Milk Powder,Beverage,China,40","71,Basil Leaf,Herbal,Italy,45","72,Camera Lens,Photography,Japan,2500","73,Sunflower Seeds,Food,Ukraine,22","74,Acacia Honey,Health,Hungary,150","75,Shiso Leaf,Leaves,Japan,120","76,Wool Fabric,Textile,UK,350","77,Dragon Fruit,Fruit,Vietnam,35","78,Sesame Oil,Seasoning,South Korea,85","79,Lavender,Herbal,France,120","80,Potash Fertilizer,Agriculture,Belarus,180","81,Peanuts,Snack,India,25","82,Balsamic Vinegar,Seasoning,Italy,650","83,Marjoram,Herbal,Egypt,35","84,Tablet Device,Electronics,Vietnam,600","85,Robusta Coffee,Beverage,Vietnam,45","86,Cherries,Fruit,Chile,120","87,Tarragon,Herbal,France,65","88,Men's Grooming,Cosmetic,UK,150","89,Sorghum,Food,USA,20","90,Sheepskin,Fashion,New Zealand,220","91,Senna Leaf,Health,India,55","92,Bluefin Tuna,Seafood,Japan,9500","93,Pistachios,Snack,Iran,180","94,Avocado Oil,Food,Mexico,120","95,Fenugreek,Spice,India,40","96,Industrial Tiles,Construction,Spain,85","97,Flaxseed,Superfood,Canada,55","98,Swiss Chocolate,Processed,Switzerland,450","99,Chives,Herbal,Germany,35","100,Industrial Robot,Manufacturing,Japan,15000"];

        const items = raw.map(l => {
            const p = l.split(',');
            return { id: p[0], nama: p[1], kat: p[2], asal: p[3], harga: parseInt(p[4]) };
        });

        let totalT = 0, totalV = 0;

        function render(filter = "") {
            const fGrid = document.getElementById('featuredGrid');
            const gGrid = document.getElementById('globalGrid');
            fGrid.innerHTML = ""; gGrid.innerHTML = "";

            if(filter === "") {
                // Showing Indonesian origin as featured
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

            if(!n || v <= 0) { alert("Please complete transaction data!"); return; }

            const batch = "#TRX-" + Math.floor(Math.random()*9000+1000);
            const row = document.getElementById('dbLog').insertRow(0);
            row.innerHTML = `
                <td><small class="fw-bold">${batch}</small></td>
                <td><span class="badge ${t === 'EXPORT' ? 'bg-warning text-dark' : 'bg-info'}">${t}</span></td>
                <td>${n}</td>
                <td class="small">${o} &rarr; ${d}</td>
                <td class="fw-bold text-success">${g}</td>
                <td><span class="text-success small fw-bold"><i class="fa-solid fa-check-double"></i> VERIFIED</span></td>
            `;

            totalT++; totalV += parseInt(v);
            document.getElementById('statTotal').innerText = totalT;
            document.getElementById('statVol').innerHTML = totalV + " <span class='h6 text-muted'>Tons</span>";
            
            alert("Transaction " + batch + " successfully synced to blockchain database!");
            document.getElementById('tradeForm').reset(); recalc();
        }

        render();
    </script>
</body>
</html>