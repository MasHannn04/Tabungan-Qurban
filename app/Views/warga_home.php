<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_warga') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $nama_depan = strtoupper(explode(' ', session()->get('user_name'))[0]); ?>
<section class="screen user-home-screen">
  <div class="user-hero-card">
    <div class="user-hero-content">
      <span class="user-hero-greeting">ASSALAMUALAIKUM, <?= esc($nama_depan) ?></span>
      <h1>Persiapan Qurban Anda Bersama Warga RT.</h1>
      <p>Cek perkembangan saldo dan catat setoran baru kapan saja dengan tenang.</p>
    </div>
    <?php
      $target_date = strtotime('2027-05-27'); // Estimasi Idul Adha 1448 H
      $now = time();
      $days_left = max(0, ceil(($target_date - $now) / 86400));
    ?>
    <div class="user-countdown-box">
      <div class="countdown-days"><?= $days_left ?></div>
      <div class="countdown-text">hari menuju<br>Hari Raya Iduladha 1448 H</div>
    </div>
  </div>

  <div class="dashboard-grid">
    <!-- Balance Card -->
    <article class="card balance-card">
      <div class="balance-card-header">
        <span class="card-subtitle">SALDO TABUNGAN ANDA</span>
        <span class="badge-safe">● Tercatat di Kas</span>
      </div>
      <div class="balance-amount">Rp<?= number_format($saldo, 0, ',', '.') ?></div>
      
      <div class="target-progress-box">
        <div class="target-ring-wrap">
          <div class="target-ring" style="background: conic-gradient(#10b981 <?= $persenTercapai ?>%, #e2e8f0 0);">
            <div class="ring-center">
              <b><?= $persenTercapai ?>%</b>
              <small>tercapai</small>
            </div>
          </div>
        </div>
        <div class="target-details">
          <span class="target-title">Target <?= esc($jenis_qurban) ?></span>
          <b class="target-total">Rp<?= number_format($target, 0, ',', '.') ?></b>
          <div class="target-shortfall">
            Kekurangan dana: <strong>Rp<?= number_format($kekurangan, 0, ',', '.') ?></strong>
          </div>
          <div class="progress-track" style="margin-top: 8px;">
            <div class="progress-fill" style="width: <?= min(100, $persenTercapai) ?>%;"></div>
          </div>
        </div>
      </div>

      <div class="balance-action">
        <a href="<?= base_url('warga/saving') ?>" class="btn-primary-action" style="width:100%; justify-content:center;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
          <span>Tambah Setoran Baru</span>
        </a>
      </div>
    </article>

    <!-- Recent Activity & Quote Card -->
    <article class="card">
      <div class="card-header">
        <div>
          <span class="card-subtitle">SETORAN TERAKHIR</span>
          <h3>Aktivitas Terbaru</h3>
        </div>
        <a href="<?= base_url('warga/history') ?>" class="link-more">Lihat semua riwayat →</a>
      </div>

      <?php if ($lastSetoran): ?>
        <div class="recent-setoran-item">
          <div class="setoran-icon-badge <?= ($lastSetoran['status'] === 'Pending') ? 'icon-pending' : 'icon-success' ?>">
            <?= ($lastSetoran['status'] === 'Pending') ? '⏳' : '✓' ?>
          </div>
          <div class="setoran-info">
            <b><?= esc($lastSetoran['keterangan']) ?></b>
            <small><?= date('d F Y', strtotime($lastSetoran['tanggal'])) ?> · <?= esc($lastSetoran['metode']) ?></small>
          </div>
          <div class="setoran-val">
            <b>+Rp<?= number_format($lastSetoran['nominal'], 0, ',', '.') ?></b>
            <span class="status-pill status-<?= strtolower($lastSetoran['status']) ?>"><?= esc($lastSetoran['status']) ?></span>
          </div>
        </div>
      <?php else: ?>
        <div class="empty-state">
          <p>Belum ada catatan setoran.</p>
        </div>
      <?php endif; ?>

      <blockquote class="hadits-box">
        <p>“Amal itu tergantung niatnya, dan seseorang hanya mendapatkan apa yang dia niatkan.”</p>
        <cite>(HR. Bukhari dan Muslim)</cite>
      </blockquote>
    </article>
  </div>

  <div class="mini-stats-grid">
    <div class="mini-stat-card">
      <span class="mini-stat-label">Rata-rata setoran</span>
      <b>Rp<?= number_format($avgBulan, 0, ',', '.') ?><small> / bulan</small></b>
    </div>
    <div class="mini-stat-card">
      <span class="mini-stat-label">Frekuensi menabung</span>
      <b><?= $setoranCount ?> <small>kali</small></b>
    </div>
    <div class="mini-stat-card">
      <span class="mini-stat-label">Perkiraan target tercapai</span>
      <b><?= esc($estimasiBulanStr) ?></b>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
