<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_admin') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="screen admin-home-screen">
  <div class="page-title">
    <div>
      <small>DASHBOARD ADMIN</small>
      <h1>Assalamualaikum, <?= esc(explode(' ', session()->get('user_name'))[0]) ?></h1>
      <p>Berikut beranda pengelolaan tabungan qurban warga hari ini.</p>
    </div>
  </div>

  <div class="metrics">
    <article class="featured">
      <span>Total dana terkumpul</span>
      <b>Rp<?= number_format($totalDana, 0, ',', '.') ?></b>
      <small>Data real-time</small>
    </article>
    <article>
      <span>Warga terdaftar</span>
      <b><?= esc($totalWarga) ?></b>
      <small><?= esc($wargaAktif) ?> aktif menabung</small>
    </article>
    <article>
      <span>Target sudah lunas</span>
      <b><?= esc($lunas) ?></b>
      <small><?= esc($persenLunas) ?>% dari total warga</small>
    </article>
    <article>
      <span>Menunggu verifikasi</span>
      <b><?= esc($pending) ?></b>
      <small>Perlu ditinjau</small>
    </article>
  </div>

  <div class="two-col admin-grid">
    <article class="card">
      <header class="section-head">
        <div>
          <small>PERKEMBANGAN DANA</small>
          <h3>6 bulan terakhir</h3>
        </div>
      </header>
      <div class="chart">
        <?php foreach ($chartData as $data): ?>
          <div style="height:<?= $data['percent'] ?>%">
            <i><?= esc($data['formatted']) ?></i>
            <span><?= esc($data['label']) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </article>

    <article class="card">
      <header class="section-head">
        <div>
          <small>PERLU TINDAKAN</small>
          <h3>Verifikasi setoran</h3>
        </div>
      </header>
      <?php if (empty($verifications)): ?>
        <p style="padding:15px; color:var(--muted); font-size:13px;">Semua setoran sudah diverifikasi.</p>
      <?php else: ?>
        <?php foreach ($verifications as $v): ?>
          <?php 
          $initials = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $v['nama_lengkap']), 0, 2)); 
          ?>
          <div class="verify">
            <span class="avatar" style="width:46px; height:46px; font-size:14px;"><?= esc($initials) ?></span>
            <span style="flex:1; display:flex; flex-direction:column; justify-content:center; gap:0;">
              <b style="font-size:15px; line-height:1.2;"><?= esc($v['nama_lengkap']) ?></b>
              <small style="color:var(--muted); line-height:1.2;"><?= date('d M Y, H:i', strtotime($v['created_at'])) ?></small>
              <small style="color:var(--green); font-weight:600; line-height:1.2;"><?= esc($v['metode']) ?></small>
            </span>
            <b>Rp<?= number_format($v['nominal'], 0, ',', '.') ?></b>
          <form method="POST" action="<?= base_url('admin/verifikasi') ?>" style="margin:0; display:flex; gap:5px;">
            <?= csrf_field() ?>
            <input type="hidden" name="id_setoran" value="<?= esc($v['id_setoran']) ?>">
            <button type="submit" name="action" value="verify" title="Verifikasi">✓</button>
            <button type="submit" name="action" value="reject" class="reject" title="Tolak">✗</button>
          </form>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </article>
  </div>
</section>
<?= $this->endSection() ?>
