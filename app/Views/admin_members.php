<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_admin') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="screen admin-members-screen">
  <div class="page-title-wrap">
    <div>
      <span class="badge-role">DATA ANGGOTA</span>
      <h1>Kelola Peserta Qurban</h1>
      <p>Daftar warga penabung, jenis qurban yang dipilih, dan progres pencapaian saldo.</p>
    </div>
    <a href="<?= base_url('admin/members/add') ?>" class="btn-primary-action">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
      <span>Tambah Warga</span>
    </a>
  </div>

  <article class="card table-card">
    <div class="table-toolbar">
      <form class="search-form" method="GET" action="<?= base_url('admin/members') ?>">
        <input type="hidden" name="status" value="<?= esc($status) ?>">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input type="text" name="q" placeholder="Cari nama atau nomor HP..." value="<?= esc($q) ?>">
      </form>

      <div class="filter-chips">
        <a href="<?= base_url('admin/members') ?>" class="chip <?= ($status === 'semua' || empty($status)) ? 'active' : '' ?>">Semua</a>
        <a href="<?= base_url('admin/members?status=aktif') ?>" class="chip <?= ($status === 'aktif') ? 'active' : '' ?>">Aktif</a>
        <a href="<?= base_url('admin/members?status=lunas') ?>" class="chip <?= ($status === 'lunas') ? 'active' : '' ?>">Lunas</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th>Nama Warga</th>
            <th>Pilihan Hewan</th>
            <th>Saldo Terkumpul</th>
            <th>Progres Target</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($members)): ?>
            <tr>
              <td colspan="5" class="table-empty">Tidak ada data warga ditemukan.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($members as $warga): ?>
              <?php 
                $saldo = $warga['saldo_tabungan'] ?? 0;
                $target = max(1, $warga['target_qurban'] ?? 1); 
                $progress = min(100, round(($saldo / $target) * 100));
                
                $statusClass = 'status-aktif';
                if ($warga['status'] === 'Lunas') {
                    $statusClass = 'status-lunas';
                } elseif ($warga['status'] === 'Perlu diingatkan') {
                    $statusClass = 'status-warn';
                }
              ?>
              <tr>
                <td>
                  <div class="table-user-cell">
                    <b><?= esc($warga['nama_lengkap']) ?></b>
                    <small><?= esc($warga['no_hp']) ?> · <?= esc($warga['rt_rw'] ?? 'RT 04') ?></small>
                  </div>
                </td>
                <td>
                  <span class="badge-animal"><?= esc($warga['jenis_qurban'] ?? 'Sapi Kolektif') ?></span>
                </td>
                <td>
                  <div class="table-money-cell">
                    <b>Rp<?= number_format($saldo, 0, ',', '.') ?></b>
                    <small>dari Rp<?= number_format($target, 0, ',', '.') ?></small>
                  </div>
                </td>
                <td>
                  <div class="progress-cell">
                    <div class="progress-track">
                      <div class="progress-fill" style="width: <?= $progress ?>%;"></div>
                    </div>
                    <span class="progress-pct"><?= $progress ?>%</span>
                  </div>
                </td>
                <td>
                  <span class="status-pill <?= $statusClass ?>"><?= esc($warga['status']) ?></span>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <footer class="table-footer">
      <span>Menampilkan <b><?= count($members) ?></b> warga terdaftar</span>
    </footer>
  </article>
</section>
<?= $this->endSection() ?>
