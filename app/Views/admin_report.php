<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_admin') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="screen admin-report-screen">
  <div class="page-title">
    <div>
      <small>LAPORAN KEUANGAN</small>
      <h1>Transparansi dana qurban</h1>
      <p>Rekap dana masuk dan status pencapaian periode 1447 H.</p>
    </div>
    <button type="button" class="outline" onclick="window.print()">↓ Cetak Laporan</button>
  </div>

  <div class="report-cards">
    <article class="card">
      <span>Dana masuk</span>
      <h2>Rp<?= number_format($totalDanaMasuk, 0, ',', '.') ?></h2>
      <small><?= esc($totalTransaksi) ?> transaksi terverifikasi</small>
    </article>
    <article class="card">
      <span>Estimasi kebutuhan</span>
      <h2>Rp<?= number_format($totalTarget, 0, ',', '.') ?></h2>
      <small><?= esc($totalWargaQurban) ?> target qurban warga</small>
    </article>
    <article class="card">
      <span>Pencapaian kolektif</span>
      <h2><?= esc($pencapaianPersen) ?>%</h2>
      <div class="progress"><i style="width:<?= esc($pencapaianPersen) ?>%"></i></div>
    </article>
  </div>

  <div class="two-col admin-grid">
    <article class="card">
      <header class="section-head">
        <div>
          <small>KOMPOSISI DANA</small>
          <h3>Berdasarkan status target</h3>
        </div>
      </header>
      <div class="donut-area">
        <div class="donut">
          <span><b><?= esc($totalWargaQurban) ?></b><small>Warga</small></span>
        </div>
        <div class="legend">
          <p><i></i><span>Dalam proses</span><b>Rp<?= rtrim(rtrim(number_format($danaProses / 1000000, 2, ',', '.'), '0'), ',') ?> jt</b></p>
          <p><i></i><span>Sudah lunas</span><b>Rp<?= rtrim(rtrim(number_format($danaLunas / 1000000, 2, ',', '.'), '0'), ',') ?> jt</b></p>
          <p><i></i><span>Sisa target</span><b>Rp<?= rtrim(rtrim(number_format($sisaTarget / 1000000, 2, ',', '.'), '0'), ',') ?> jt</b></p>
        </div>
      </div>
    </article>

    <article class="card">
      <header class="section-head">
        <div>
          <small>RINGKASAN BULANAN</small>
          <?php
          $bulanId = [
              '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
              '04' => 'April', '05' => 'Mei', '06' => 'Juni',
              '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
              '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
          ];
          $bulanIniLabel = $bulanId[date('m')] . ' ' . date('Y');
          ?>
          <h3><?= $bulanIniLabel ?></h3>
        </div>
      </header>
      <div class="report-lines">
        <p><span>Total setoran</span><b>Rp<?= number_format($totalBulanIni, 0, ',', '.') ?></b></p>
        <p><span>Jumlah transaksi</span><b><?= esc($transaksiBulanIni) ?></b></p>
        <p><span>Rata-rata setoran</span><b>Rp<?= number_format($rataRataBulanIni, 0, ',', '.') ?></b></p>
        <p><span>Warga aktif</span><b><?= esc($wargaAktif) ?> dari <?= esc($totalWargaQurban) ?></b></p>
      </div>
    </article>
  </div>
</section>
<?= $this->endSection() ?>
