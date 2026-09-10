<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_admin') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="screen admin-home-screen">
  <div class="page-title-wrap">
    <div>
      <span class="badge-role">PANEL PENGURUS</span>
      <h1>Assalamualaikum, <?= esc(explode(' ', session()->get('user_name'))[0]) ?></h1>
      <p>Ringkasan kas, target tabungan warga, dan setoran yang butuh konfirmasi hari ini.</p>
    </div>
  </div>

  <div class="metrics-grid">
    <article class="metric-card metric-primary">
      <div class="metric-head">
        <span>Total Dana Masuk</span>
        <span class="metric-icon-badge">💰</span>
      </div>
      <b>Rp<?= number_format($totalDana, 0, ',', '.') ?></b>
      <small>Data terverifikasi</small>
    </article>

    <article class="metric-card">
      <div class="metric-head">
        <span>Warga Terdaftar</span>
        <span class="metric-icon-badge">👥</span>
      </div>
      <b><?= esc($totalWarga) ?></b>
      <small><?= esc($wargaAktif) ?> warga aktif menabung</small>
    </article>

    <article class="metric-card">
      <div class="metric-head">
        <span>Target Lunas</span>
        <span class="metric-icon-badge">🎯</span>
      </div>
      <b><?= esc($lunas) ?></b>
      <small><?= esc($persenLunas) ?>% dari total warga</small>
    </article>

    <article class="metric-card">
      <div class="metric-head">
        <span>Butuh Konfirmasi</span>
        <span class="metric-icon-badge">⏳</span>
      </div>
      <b class="<?= ($pending > 0) ? 'color-pending' : '' ?>"><?= esc($pending) ?></b>
      <small>Setoran baru masuk</small>
    </article>
  </div>

  <div class="dashboard-grid">
    <!-- Chart Column -->
    <article class="card">
      <div class="card-header">
        <div>
          <span class="card-subtitle">GRAFIK AKUMULASI DANA</span>
          <h3>Perkembangan 6 Bulan Terakhir</h3>
        </div>
      </div>
      <div class="chart-container">
        <div class="chart-bars">
          <?php foreach ($chartData as $data): ?>
            <div class="chart-col">
              <div class="bar-wrap">
                <div class="bar-fill" style="height: <?= max(8, $data['percent']) ?>%;">
                  <span class="bar-tooltip"><?= esc($data['formatted']) ?></span>
                </div>
              </div>
              <span class="bar-label"><?= esc($data['label']) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </article>

    <!-- Verification Column -->
    <article class="card">
      <div class="card-header">
        <div>
          <span class="card-subtitle">PERLU TINDAKAN</span>
          <h3>Konfirmasi Setoran Masuk</h3>
        </div>
        <span class="badge-count"><?= count($verifications) ?> menunggu</span>
      </div>
      
      <div class="verify-list">
        <?php if (empty($verifications)): ?>
          <div class="empty-state">
            <span class="empty-icon">✓</span>
            <p>Semua setoran warga sudah dikonfirmasi.</p>
          </div>
        <?php else: ?>
          <?php foreach ($verifications as $v): ?>
            <?php 
            $initials = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $v['nama_lengkap']), 0, 2)); 
            if (empty($initials)) $initials = 'WG';
            ?>
            <div class="verify-item">
              <div class="verify-avatar"><?= esc($initials) ?></div>
              <div class="verify-meta">
                <b><?= esc($v['nama_lengkap']) ?></b>
                <span class="verify-detail"><?= date('d M Y, H:i', strtotime($v['created_at'])) ?> · <?= esc($v['metode']) ?></span>
              </div>
              <div class="verify-amount">
                <b>Rp<?= number_format($v['nominal'], 0, ',', '.') ?></b>
              </div>
              <form method="POST" action="<?= base_url('admin/verifikasi') ?>" class="verify-actions">
                <?= csrf_field() ?>
                <input type="hidden" name="id_setoran" value="<?= esc($v['id_setoran']) ?>">
                <button type="submit" name="action" value="verify" class="btn-verify" title="Setujui Setoran">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </button>
                <button type="submit" name="action" value="reject" class="btn-reject" title="Tolak Setoran">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
              </form>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </article>
  </div>
</section>
<?= $this->endSection() ?>
