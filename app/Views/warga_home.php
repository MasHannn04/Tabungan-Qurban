<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_warga') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $nama_depan = strtoupper(explode(' ', session()->get('user_name'))[0]); ?>
<section class="screen user-home-screen">
  <div class="hero">
    <div>
      <small>ASSALAMUALAIKUM, <?= esc($nama_depan) ?></small>
      <h1>Semakin dekat dengan<br>niat baik berqurban.</h1>
      <p>Pantau tabungan dan jaga konsistensi setoran Anda.</p>
    </div>
    <?php
      $target_date = strtotime('2027-05-16'); // Estimasi Idul Adha 1448 H
      $now = time();
      $days_left = max(0, ceil(($target_date - $now) / 86400));
    ?>
    <div class="countdown">
      <b><?= $days_left ?></b>
      <span>hari menuju<br>Idul Adha 1448 H</span>
    </div>
  </div>

  <div class="two-col">
    <article class="card balance">
      <header>
        <span>Total tabungan Anda</span>
        <em>● Dana tercatat aman</em>
      </header>
      <h2>Rp<?= number_format($saldo, 0, ',', '.') ?></h2>
      <div class="goal">
        <div class="ring" style="background: conic-gradient(var(--lime) <?= $persenTercapai ?>%, #e7ede8 0);">
          <span><b><?= $persenTercapai ?>%</b><small>tercapai</small></span>
        </div>
        <div>
          <span>Target qurban <?= esc(strtolower($jenis_qurban)) ?></span>
          <b>Rp<?= number_format($target, 0, ',', '.') ?></b>
          <small>Kekurangan <strong>Rp<?= number_format($kekurangan, 0, ',', '.') ?></strong></small>
          <div class="progress"><i style="width:<?= $persenTercapai ?>%"></i></div>
        </div>
      </div>
      <a class="primary" href="<?= base_url('warga/saving') ?>">＋ Tambah Setoran</a>
    </article>

    <article class="card">
      <header class="section-head">
        <div>
          <small>SETORAN TERAKHIR</small>
          <h3>Aktivitas terbaru</h3>
        </div>
        <a href="<?= base_url('warga/history') ?>">Lihat semua →</a>
      </header>
      <?php if ($lastSetoran): ?>
      <div class="activity">
        <i><?= ($lastSetoran['status'] === 'Pending') ? '⌛' : '↗' ?></i>
        <span>
          <b><?= esc($lastSetoran['keterangan']) ?></b>
          <small><?= date('d F Y', strtotime($lastSetoran['tanggal'])) ?> · <?= esc($lastSetoran['metode']) ?></small>
        </span>
        <strong>+Rp<?= number_format($lastSetoran['nominal'], 0, ',', '.') ?></strong>
      </div>
      <?php else: ?>
      <div class="activity">
        <span><small>Belum ada aktivitas setoran.</small></span>
      </div>
      <?php endif; ?>
      <blockquote>
        “Sesungguhnya amal itu bergantung pada niatnya.”
        <small>— HR. Bukhari & Muslim</small>
      </blockquote>
    </article>
  </div>

  <div class="mini-stats">
    <div>
      <span>Rata-rata setoran</span>
      <b>Rp<?= number_format($avgBulan, 0, ',', '.') ?><small>/bulan</small></b>
    </div>
    <div>
      <span>Total kali setoran</span>
      <b><?= $setoranCount ?> <small>kali</small></b>
    </div>
    <div>
      <span>Estimasi target tercapai</span>
      <b><?= esc($estimasiBulanStr) ?></b>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
