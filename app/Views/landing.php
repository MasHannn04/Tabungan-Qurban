<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'AT-TAQWA — Tabungan Qurban') ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico?v=3') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --landing-green: #0e603a;
            --landing-light: #f4fbf5;
        }
        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: #fff;
            color: #333;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }
        /* Navbar */
        .landing-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 15px rgba(0,0,0,0.04);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .landing-nav .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--landing-green);
        }
        .landing-nav .logo {
            width: 45px;
            height: auto;
            margin-right: 12px;
        }
        .landing-nav h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .landing-nav .login-btn {
            background: var(--landing-green);
            color: #fff;
            padding: 10px 24px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
        }
        .landing-nav .login-btn:hover {
            background: #0a472a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(14, 96, 58, 0.2);
        }

        /* Hero */
        .hero {
            padding: 60px 5% 60px;
            text-align: center;
            background: linear-gradient(135deg, var(--landing-light) 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: "☪";
            position: absolute;
            font-size: 400px;
            color: var(--landing-green);
            opacity: 0.02;
            top: -50px;
            right: -100px;
            z-index: 0;
            transform: rotate(-15deg);
        }
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }
        .hero-badge {
            background: rgba(14, 96, 58, 0.1);
            color: var(--landing-green);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 24px;
            letter-spacing: 0.5px;
        }
        .hero h2 {
            font-size: 56px;
            font-weight: 900;
            line-height: 1.15;
            color: #111;
            margin: 0 0 24px;
            letter-spacing: -1px;
        }
        .hero h2 span {
            color: var(--landing-green);
        }
        .hero p {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 40px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        .hero .cta-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        .hero .btn-primary {
            background: var(--landing-green);
            color: #fff;
            padding: 16px 36px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            transition: 0.3s;
            box-shadow: 0 8px 20px rgba(14,96,58,0.25);
        }
        .hero .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(14,96,58,0.35);
        }

        /* Stats Section */
        .stats-section {
            padding: 0 5% 100px;
            background: #fff;
            position: relative;
            z-index: 2;
            margin-top: -40px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            max-width: 1100px;
            margin: 0 auto;
        }
        .stat-card {
            background: #fff;
            border: 1px solid #eaeaea;
            border-radius: 24px;
            padding: 40px 30px;
            text-align: center;
            transition: 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 10px 40px rgba(0,0,0,0.03);
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: "";
            position: absolute;
            bottom: 0; left: 0; right: 0; height: 5px;
            background: var(--landing-green);
            opacity: 0;
            transition: 0.3s;
            transform: scaleX(0);
        }
        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(14,96,58,0.08);
            border-color: transparent;
        }
        .stat-card:hover::after {
            opacity: 1;
            transform: scaleX(1);
        }
        .stat-icon {
            width: 70px;
            height: 70px;
            background: var(--landing-light);
            color: var(--landing-green);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 24px;
        }
        .stat-value {
            font-size: 40px;
            font-weight: 800;
            color: #111;
            margin-bottom: 8px;
            letter-spacing: -1px;
        }
        .stat-label {
            font-size: 16px;
            color: #666;
            font-weight: 500;
        }
        
        /* Simulator CSS inside Hero */
        .sim-form {
            background: #fff;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(14,96,58,0.1);
            border: 1px solid #f0f0f0;
        }
        .sim-form label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 13px;
            color: #333;
        }
        .sim-form select, .sim-form input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 12px;
            margin-bottom: 15px;
            font-size: 15px;
            font-family: inherit;
            box-sizing: border-box;
            background: #fafafa;
            transition: 0.3s;
        }
        .sim-form select {
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 14px;
            padding-right: 40px;
        }
        .sim-form select:focus, .sim-form input:focus {
            border-color: var(--landing-green);
            outline: none;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(14,96,58,0.1);
        }
        .sim-result {
            background: var(--landing-green);
            color: #fff;
            padding: 15px;
            border-radius: 16px;
            text-align: center;
        }
        .sim-result span {
            display: block;
            font-size: 13px;
            opacity: 0.9;
            margin-bottom: 4px;
        }
        .sim-result b {
            font-size: 24px;
            font-weight: 800;
        }

        /* Footer */
        .footer {
            background: #fafafa;
            padding: 40px 5%;
            text-align: center;
            border-top: 1px solid #eaeaea;
            color: #777;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .hero h2 { font-size: 40px; }
            .hero p { font-size: 16px; }
            .hero { padding: 80px 5% 60px; }
            .stats-section { margin-top: 0; padding-top: 40px; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <nav class="landing-nav">
        <a href="<?= base_url() ?>" class="brand">
            <img src="<?= base_url('img/logo.png?v=' . time()) ?>" alt="Logo AT-TAQWA" class="logo">
            <h1>AT-TAQWA</h1>
        </a>
        <a href="<?= base_url('login') ?>" class="login-btn">Masuk Portal</a>
    </nav>

    <header class="hero">
        <div style="max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center; text-align: left; position: relative; z-index: 1;">
            <div class="hero-info">
                <div class="hero-badge">Program Tabungan Qurban Warga</div>
                <h2 style="font-size:42px;">Siapkah Anda Qurban Tahun <span><?= date('Y') + 1 ?></span>?</h2>
                <p>Sistem transparansi dan pengelolaan tabungan qurban untuk masyarakat umum. Mari bersama wujudkan niat berqurban dengan lebih terencana, aman, dan barokah.</p>
            </div>
            
            <div class="sim-form" style="margin:0; box-shadow: 0 20px 50px rgba(14,96,58,0.15);">
                <h3 style="margin-top:0; margin-bottom: 20px; text-align: center; font-size: 22px; color: #111;">Kalkulator Qurban</h3>
                
                <label>Pilih Target Qurban</label>
                <select id="simTarget" onchange="hitungSimulasi()">
                    <option value="3500000" selected>Sapi Patungan (1/7) - Rp3.500.000</option>
                    <option value="3000000">Kambing/Domba - Rp3.000.000</option>
                    <option value="25000000">Sapi Utuh (Kolektif) - Rp25.000.000</option>
                </select>

                <label>Rencana Dicapai Dalam (Bulan)</label>
                <div style="display:flex; gap: 10px; margin-bottom: 20px;">
                    <input type="number" id="simBulan" value="10" min="1" max="60" oninput="hitungSimulasi()" style="margin-bottom:0;">
                </div>

                <div class="sim-result">
                    <span>Maka Anda cukup menabung:</span>
                    <b id="simHasil">Rp 350.000 / Bulan</b>
                </div>
                
                <div style="margin-top: 20px; text-align: center; display: flex; flex-direction: column; gap: 10px;">
                    <a href="<?= base_url('login') ?>" class="btn-primary" style="display:block; text-align:center;">Mulai Menabung Sekarang</a>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20TAQWA,%20saya%20tertarik%20menggunakan%20aplikasi%20ini%20untuk%20komunitas%20saya" target="_blank" style="display:block; text-align:center; padding: 12px; color: var(--landing-green); font-weight: 600; text-decoration: none; border: 2px solid var(--landing-green); border-radius: 30px; transition: 0.3s;" onmouseover="this.style.background='var(--landing-green)'; this.style.color='#fff';" onmouseout="this.style.background='transparent'; this.style.color='var(--landing-green)';">Konsultasi via WhatsApp</a>
                </div>
            </div>
        </div>
    </header>

    <section class="stats-section" style="margin-top: -40px; padding-top: 80px; position:relative; z-index:2;">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-value"><?= number_format($jmlWarga, 0, ',', '.') ?></div>
                <div class="stat-label">Warga Terdaftar</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-value">Rp<?= number_format($totalDanaMasuk, 0, ',', '.') ?></div>
                <div class="stat-label">Total Tabungan Terkumpul</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">🗓️</div>
                <div class="stat-value" style="font-size:32px;"><?= esc($estimasiBulanStr) ?></div>
                <div class="stat-label">Estimasi Target Tercapai</div>
            </div>
        </div>
    </section>

    <footer class="footer">
        &copy; <?= date('Y') ?> AT-TAQWA (Tabungan Qurban Warga). Hak Cipta Dilindungi.
    </footer>

    <script>
        function hitungSimulasi() {
            let target = parseFloat(document.getElementById('simTarget').value);
            let bulan = parseFloat(document.getElementById('simBulan').value);
            let hasilEl = document.getElementById('simHasil');
            
            if (bulan > 0) {
                let nabung = Math.ceil(target / bulan);
                // Format rupiah
                let reverse = nabung.toString().split('').reverse().join(''),
                    ribuan  = reverse.match(/\d{1,3}/g);
                    ribuan  = ribuan.join('.').split('').reverse().join('');
                
                hasilEl.innerText = "Rp " + ribuan + " / Bulan";
            } else {
                hasilEl.innerText = "-";
            }
        }
        // Run once on load
        hitungSimulasi();
        
        // Atur layout responsive hero untuk mobile
        if(window.innerWidth <= 768) {
            document.querySelector('.hero > div').style.gridTemplateColumns = '1fr';
            document.querySelector('.hero > div').style.textAlign = 'center';
            document.querySelector('.hero-info').style.marginBottom = '30px';
        }
    </script>
</body>
</html>
