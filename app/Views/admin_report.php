<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_admin') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="screen admin-report-screen">
  <div class="page-title-wrap">
    <div>
      <span class="badge-role">LAPORAN KEUANGAN</span>
      <h1>Rekap Kas Tabungan Qurban</h1>
      <p>Data akumulasi dana masuk, target kebutuhan pembelian hewan, dan ringkasan bulan ini.</p>
    </div>
    <button type="button" class="btn-secondary-action" onclick="window.print()">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
      <span>Cetak Laporan</span>
    </button>
  </div>

  <div class="report-summary-cards">
    <article class="metric-card metric-primary">
      <span>Total Dana Masuk</span>
      <h2>Rp<?= number_format($totalDanaMasuk, 0, ',', '.') ?></h2>
      <small><?= esc($totalTransaksi) ?> transaksi setoran terverifikasi</small>
    </article>
    
    <article class="metric-card">
      <span>Total Target Kebutuhan</span>
      <h2>Rp<?= number_format($totalTarget, 0, ',', '.') ?></h2>
      <small><?= esc($totalWargaQurban) ?> target qurban warga terdaftar</small>
    </article>
    
    <article class="metric-card">
      <span>Persentase Tercapai</span>
      <h2><?= esc($pencapaianPersen) ?>%</h2>
      <div class="progress-track" style="margin-top: 10px;">
        <div class="progress-fill" style="width: <?= min(100, (float)$pencapaianPersen) ?>%;"></div>
      </div>
    </article>
  </div>

  <div class="dashboard-grid">
    <!-- Donut Composition -->
    <article class="card">
      <div class="card-header">
        <div>
          <span class="card-subtitle">KOMPOSISI STATUS KAS</span>
          <h3>Sebaran Target Tabungan</h3>
        </div>
      </div>
      <div class="donut-wrap">
        <div class="donut-chart-container">
          <div class="donut-circle" style="background: conic-gradient(#10b981 0% <?= $pencapaianPersen ?>%, #e2e8f0 <?= $pencapaianPersen ?>% 100%);">
            <div class="donut-hole">
              <b><?= esc($totalWargaQurban) ?></b>
              <small>Peserta</small>
            </div>
          </div>
        </div>

        <div class="donut-legend">
          <div class="legend-row">
            <span class="legend-dot dot-proses"></span>
            <span class="legend-label">Sedang Berjalan</span>
            <b>Rp<?= rtrim(rtrim(number_format($danaProses / 1000000, 2, ',', '.'), '0'), ',') ?> jt</b>
          </div>
          <div class="legend-row">
            <span class="legend-dot dot-lunas"></span>
            <span class="legend-label">Target Lunas</span>
            <b>Rp<?= rtrim(rtrim(number_format($danaLunas / 1000000, 2, ',', '.'), '0'), ',') ?> jt</b>
          </div>
          <div class="legend-row">
            <span class="legend-dot dot-sisa"></span>
            <span class="legend-label">Sisa Kebutuhan</span>
            <b>Rp<?= rtrim(rtrim(number_format($sisaTarget / 1000000, 2, ',', '.'), '0'), ',') ?> jt</b>
          </div>
        </div>
      </div>
    </article>

    <!-- Monthly Summary -->
    <article class="card">
      <div class="card-header">
        <div>
          <span class="card-subtitle">CATATAN BULAN INI</span>
          <?php
          $bulanId = [
              '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
              '04' => 'April', '05' => 'Mei', '06' => 'Juni',
              '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
              '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
          ];
          $bulanIniLabel = $bulanId[date('m')] . ' ' . date('Y');
          ?>
          <h3>Aktivitas <?= $bulanIniLabel ?></h3>
        </div>
      </div>

      <div class="report-data-list">
        <div class="report-data-item">
          <span class="report-data-label">Total setoran masuk</span>
          <b class="report-data-value text-emerald">Rp<?= number_format($totalBulanIni, 0, ',', '.') ?></b>
        </div>
        <div class="report-data-item">
          <span class="report-data-label">Jumlah transaksi</span>
          <b class="report-data-value"><?= esc($transaksiBulanIni) ?> kali</b>
        </div>
        <div class="report-data-item">
          <span class="report-data-label">Rata-rata per setoran</span>
          <b class="report-data-value">Rp<?= number_format($rataRataBulanIni, 0, ',', '.') ?></b>
        </div>
        <div class="report-data-item">
          <span class="report-data-label">Warga aktif menyetor</span>
          <b class="report-data-value"><?= esc($wargaAktif) ?> dari <?= esc($totalWargaQurban) ?> peserta</b>
        </div>
      </div>
    </article>
  </div>
</section>
<?= $this->endSection() ?>
