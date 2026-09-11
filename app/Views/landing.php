<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'AT-TAQWA | Tabungan Qurban Warga') ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico?v=3') ?>">
    
    <!-- Google Font: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/styles.css?v=<?= time() ?>">
</head>
<body class="landing-body">

    <!-- Sticky Navigation Bar -->
    <nav class="landing-navbar">
        <div class="landing-nav-container">
            <a href="<?= base_url() ?>" class="brand">
                <img src="<?= base_url('img/logo.png?v=' . time()) ?>" alt="Logo AT-TAQWA" class="logo">
                <div class="brand-text">
                    <b class="brand-title">AT-TAQWA</b>
                    <small class="brand-sub">Tabungan Qurban Warga</small>
                </div>
            </a>

            <div class="landing-nav-links">
                <a href="#alur">Cara Kerja</a>
                <a href="#pilihan-hewan">Pilihan Hewan</a>
                <a href="#amanah">Prinsip Kas</a>
                <a href="#faq">Tanya Jawab</a>
            </div>
            
            <div class="landing-nav-actions">
                <a href="<?= base_url('login') ?>" class="btn-portal">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
                    <span>Masuk Akun</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Thematic Photographic Backdrop -->
    <header class="hero-landing">
        <div class="hero-container">
            <div class="hero-info">
                <div class="hero-badge">
                    <span class="badge-dot"></span>
                    <span>Kas Tabungan Qurban Lingkungan</span>
                </div>
                <h1>Persiapan Qurban Warga Jadi <span>Tenang dan Terencana</span>.</h1>
                <p>Nabung santai per bulan, catatan kas transparan di lingkungan RT, dan hewan qurban siap disembelih bersama saat Hari Raya Iduladha tiba.</p>
                
                <div class="hero-quick-features">
                    <div class="feature-item">
                        <span class="feature-check">✓</span>
                        <span>Nominal setoran fleksibel sesuai kemampuan bulanan</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-check">✓</span>
                        <span>Pencatatan kas terbuka, bisa dicek tiap warga kapan saja</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-check">✓</span>
                        <span>Dikelola langsung oleh pengurus RT dan panitia masjid</span>
                    </div>
                </div>

                <div class="hero-cta-group">
                    <a href="#kalkulator" class="btn-hero-primary">
                        <span>Hitung Rencana Tabungan</span>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <a href="#alur" class="btn-hero-glass">
                        <span>Lihat Alur Program</span>
                    </a>
                </div>
            </div>
            
            <!-- Glassmorphic Interactive Calculator -->
            <div class="calc-card" id="kalkulator">
                <div class="calc-header">
                    <div class="calc-icon">🧮</div>
                    <div>
                        <h3>Hitung Perkiraan Setoran</h3>
                        <small>Simulasi rencana tabungan per bulan</small>
                    </div>
                </div>

                <div class="form-group">
                    <label>Pilihan Hewan Qurban</label>
                    <div class="animal-tabs">
                        <button type="button" class="animal-tab active" onclick="selectAnimal(3500000, this)">Patungan Sapi</button>
                        <button type="button" class="animal-tab" onclick="selectAnimal(3000000, this)">Kambing</button>
                        <button type="button" class="animal-tab" onclick="selectAnimal(25000000, this)">Sapi Utuh</button>
                    </div>
                    <input type="hidden" id="simTarget" value="3500000">
                </div>

                <div class="form-group">
                    <div class="label-row">
                        <label for="simBulan">Rencana Waktu Nabung</label>
                        <span class="range-value"><b id="labelBulan">10</b> Bulan</span>
                    </div>
                    <input type="range" id="simBulan" min="1" max="24" value="10" oninput="document.getElementById('labelBulan').innerText = this.value; hitungSimulasi();" class="range-slider">
                    <div class="range-steps">
                        <span>1 bulan</span>
                        <span>12 bulan</span>
                        <span>24 bulan</span>
                    </div>
                </div>

                <div class="calc-result-box">
                    <span class="result-label">Perkiraan setoran rutin:</span>
                    <strong class="result-value" id="simHasil">Rp350.000 / bulan</strong>
                    <small class="result-note">Bisa setor tunai ke pengurus RT atau transfer Bank BSI</small>
                </div>
                
                <div class="calc-actions">
                    <a href="<?= base_url('login') ?>" class="btn-primary-block">
                        <span>Mulai Menabung Sekarang</span>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <a href="https://wa.me/6281234567890?text=Halo%20Pengurus%20AT-TAQWA,%20saya%20ingin%20tanya%20seputar%20tabungan%20qurban" target="_blank" rel="noopener" class="btn-outline-block">
                        <span>Tanya Pengurus via WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Floating Live Transparency Stats Counter -->
    <div class="floating-stats-wrapper">
        <div class="floating-stats-card">
            <div class="floating-stat-item">
                <div class="f-icon">👥</div>
                <div class="f-content">
                    <b><?= number_format($jmlWarga, 0, ',', '.') ?> Warga</b>
                    <span>Peserta Terdaftar</span>
                </div>
            </div>

            <div class="floating-stat-item">
                <div class="f-icon">💰</div>
                <div class="f-content">
                    <b>Rp<?= number_format($totalDanaMasuk, 0, ',', '.') ?></b>
                    <span>Dana Kas Terverifikasi</span>
                </div>
            </div>

            <div class="floating-stat-item">
                <div class="f-icon">🎯</div>
                <div class="f-content">
                    <b>4 Target Lunas</b>
                    <span>Siap Disembelih</span>
                </div>
            </div>

            <div class="floating-stat-item">
                <div class="f-icon">🛡️</div>
                <div class="f-content">
                    <b>100% Terbuka</b>
                    <span>Catatan Kas Transparan</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: 3 Langkah Alur Kerja -->
    <section class="steps-section" id="alur">
        <div class="steps-container">
            <div class="section-header-center">
                <span class="section-tag">ALUR SEDERHANA</span>
                <h2>Cara Mudah Ikut Tabungan Qurban Warga</h2>
                <p>Prosedur jelas tanpa syarat berbelit. Semua tercatat transparan dari pendaftaran awal hingga hari penyembelihan.</p>
            </div>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-num">01</div>
                    <h3>Pilih Hewan dan Target Waktu</h3>
                    <p>Pilih jenis hewan qurban yang diinginkan, baik patungan sapi 1/7 bagian maupun kambing mandiri. Tentukan rencana bulan menabung sesuai kemampuan.</p>
                </div>

                <div class="step-card">
                    <div class="step-num">02</div>
                    <h3>Setor Rutin Tiap Bulan</h3>
                    <p>Lakukan setoran melalui transfer Bank BSI resmi panitia atau serahkan tunai langsung ke pengurus RT. Konfirmasi setoran akan muncul di akun Anda.</p>
                </div>

                <div class="step-card">
                    <div class="step-num">03</div>
                    <h3>Hewan Dibeli dan Disembelih Bersama</h3>
                    <p>Menjelang Iduladha, panitia membeli hewan sehat sesuai syariat dari peternak terpercaya. Penyembelihan dan pembagian daging dinikmati bersama warga.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Pilihan Hewan Qurban -->
    <section class="pricing-section" id="pilihan-hewan">
        <div class="pricing-container">
            <div class="section-header-center">
                <span class="section-tag">PILIHAN HEWAN</span>
                <h2>Estimasi Biaya Qurban Tahun 1448 H</h2>
                <p>Harga acuan peternak lokal yang wajar dan realistis, tanpa biaya potongan tersembunyi.</p>
            </div>

            <div class="pricing-grid">
                <!-- Sapi Patungan -->
                <div class="pricing-card pricing-popular">
                    <span class="popular-badge">Paling Diminati</span>
                    <div>
                        <div class="pricing-header">
                            <h3>Sapi Patungan (1/7)</h3>
                            <p class="pricing-desc">Kolektif 7 orang warga untuk 1 ekor sapi</p>
                        </div>
                        <div class="pricing-cost">
                            <b>Rp3.500.000</b>
                            <span>Mulai Rp350.000 / bulan (10 bln)</span>
                        </div>
                        <ul class="pricing-specs">
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Bobot sapi hidup ±300 kg</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Satu bagian atas nama 1 orang</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Operasional pemotongan ditanggung bersama</span>
                            </li>
                        </ul>
                    </div>
                    <a href="<?= base_url('login') ?>" class="btn-primary-block">Pilih Patungan Sapi</a>
                </div>

                <!-- Kambing Mandiri -->
                <div class="pricing-card">
                    <div>
                        <div class="pricing-header">
                            <h3>Kambing atau Domba</h3>
                            <p class="pricing-desc">Qurban perorangan dengan hewan mandiri</p>
                        </div>
                        <div class="pricing-cost">
                            <b>Rp3.000.000</b>
                            <span>Mulai Rp300.000 / bulan (10 bln)</span>
                        </div>
                        <ul class="pricing-specs">
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Bobot hidup berkisar 25 sampai 30 kg</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Hewan jantan sehat dan cukup umur</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Bisa request bagian daging tertentu</span>
                            </li>
                        </ul>
                    </div>
                    <a href="<?= base_url('login') ?>" class="btn-outline-block">Pilih Kambing</a>
                </div>

                <!-- Sapi Utuh Keluarga -->
                <div class="pricing-card">
                    <div>
                        <div class="pricing-header">
                            <h3>Sapi Utuh Keluarga</h3>
                            <p class="pricing-desc">Satu ekor sapi utuh atas nama keluarga besar</p>
                        </div>
                        <div class="pricing-cost">
                            <b>Rp25.000.000</b>
                            <span>Mulai Rp2.500.000 / bulan (10 bln)</span>
                        </div>
                        <ul class="pricing-specs">
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Bobot sapi hidup ±350 sampai 400 kg</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Mencakup hingga 7 nama keluarga</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Prioritas jadwal dan penanganan khusus</span>
                            </li>
                        </ul>
                    </div>
                    <a href="<?= base_url('login') ?>" class="btn-outline-block">Pilih Sapi Utuh</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Nilai Amanah Kas Lingkungan -->
    <section class="trust-section" id="amanah">
        <div class="trust-container">
            <div class="section-header-center">
                <span class="section-tag">AMANAH DAN TERBUKA</span>
                <h2>Prinsip Pengelolaan Tabungan Lingkungan</h2>
                <p>Ibadah qurban adalah amanah besar. Kami mengedepankan ketenangan warga lewat tata kelola kas yang rapi.</p>
            </div>

            <div class="trust-grid">
                <div class="trust-card">
                    <span class="t-icon">📊</span>
                    <h3>Pencatatan Kas Real-Time</h3>
                    <p>Setiap nominal yang Anda setorkan langsung diverifikasi dan dapat dipantau riwayatnya secara transparan melalui portal warga.</p>
                </div>

                <div class="trust-card">
                    <span class="t-icon">🚫</span>
                    <h3>Tanpa Potongan Siluman</h3>
                    <p>Dana tabungan 100% dialokasikan murni untuk pembelian hewan dan operasional qurban warga tanpa potongan biaya administrasi tersembunyi.</p>
                </div>

                <div class="trust-card">
                    <span class="t-icon">🤝</span>
                    <h3>Dikelola Tetangga Sendiri</h3>
                    <p>Pengurus kas adalah pengurus RT dan panitia kurban masjid lingkungan yang bertetangga dekat, mudah ditemui, dan dapat diajak berdiskusi setiap saat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: FAQ Tanya Jawab Warga -->
    <section class="faq-section" id="faq">
        <div class="faq-container">
            <div class="section-header-center">
                <span class="section-tag">PERTANYAAN LAZIM</span>
                <h2>Tanya Jawab Seputar Tabungan Qurban</h2>
                <p>Jawaban praktis untuk hal-hal yang sering ditanyakan warga sebelum mulai menabung.</p>
            </div>

            <div class="faq-list">
                <div class="faq-item">
                    <h3>Bagaimana jika ada kebutuhan mendesak sebelum Iduladha?</h3>
                    <p>Dana tabungan sepenuhnya adalah hak milik warga. Jika mengalami keadaan darurat keluarga, silakan koordinasikan langsung dengan pengurus kas RT untuk solusi terbaik.</p>
                </div>

                <div class="faq-item">
                    <h3>Kapan batas waktu pelunasan tabungan qurban?</h3>
                    <p>Pelunasan ditargetkan selesai paling lambat satu bulan sebelum Hari Raya Iduladha agar panitia leluasa memilih dan memesan hewan sehat terbaik langsung dari peternak.</p>
                </div>

                <div class="faq-item">
                    <h3>Bolehkah menyetor lebih besar dari cicilan bulanan?</h3>
                    <p>Sangat diperbolehkan. Nominal setoran bersifat fleksibel. Saat warga memiliki kelapangan rezeki, setoran lebih besar akan mempercepat tercapainya target qurban.</p>
                </div>

                <div class="faq-item">
                    <h3>Bagaimana cara menyetor dana tabungan?</h3>
                    <p>Warga dapat mentransfer ke rekening resmi Bank Syariah Indonesia (BSI) panitia atau menyerahkan uang tunai langsung ke bendahara RT pada saat pertemuan warga.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Final Call to Action Banner -->
    <section class="final-cta-section">
        <div class="cta-banner">
            <div class="cta-banner-content">
                <h2>Rencanakan Ibadah Qurban Tahun Ini Tanpa Terbebani Finansial Mendadak.</h2>
                <p>Mulai nabung sedikit demi sedikit bersama warga lingkungan RT. Niat baik insyaAllah dipermudah jalannya.</p>
            </div>
            <div class="cta-banner-buttons">
                <a href="<?= base_url('login') ?>" class="btn-hero-primary">
                    <span>Mulai Menabung Sekarang</span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
                <a href="https://wa.me/6281234567890?text=Halo%20Pengurus%20AT-TAQWA,%20saya%20tertarik%20ikut%20tabungan%20qurban" target="_blank" rel="noopener" class="btn-hero-glass">
                    <span>Hubungi Pengurus RT</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Clean Footer -->
    <footer class="landing-footer">
        <div class="footer-inner">
            <div>
                <b>AT-TAQWA</b>. Kas Tabungan Qurban Warga Lingkungan.
            </div>
            <div class="footer-nav">
                <a href="#alur">Alur Kerja</a>
                <a href="#pilihan-hewan">Pilihan Hewan</a>
                <a href="#faq">Tanya Jawab</a>
                <a href="<?= base_url('login') ?>">Masuk Portal</a>
            </div>
            <div>
                &copy; <?= date('Y') ?> AT-TAQWA. Dikelola bersama warga RT untuk kemaslahatan lingkungan.
            </div>
        </div>
    </footer>

    <!-- Interactive Calculator Script -->
    <script>
        function selectAnimal(nominal, button) {
            document.getElementById('simTarget').value = nominal;
            document.querySelectorAll('.animal-tab').forEach(t => t.classList.remove('active'));
            button.classList.add('active');
            hitungSimulasi();
        }

        function hitungSimulasi() {
            let target = parseFloat(document.getElementById('simTarget').value);
            let bulan = parseFloat(document.getElementById('simBulan').value);
            let hasilEl = document.getElementById('simHasil');
            
            if (bulan > 0) {
                let nabung = Math.ceil(target / bulan);
                let formatId = new Intl.NumberFormat('id-ID').format(nabung);
                hasilEl.innerText = "Rp" + formatId + " / bulan";
            } else {
                hasilEl.innerText = "-";
            }
        }
        hitungSimulasi();
    </script>
</body>
</html>
