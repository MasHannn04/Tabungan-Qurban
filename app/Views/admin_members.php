<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_admin') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="screen admin-members-screen">
  <div class="page-title">
    <div>
      <small>DATA WARGA</small>
      <h1>Kelola peserta tabungan</h1>
      <p>Pantau progres dan status tabungan seluruh warga.</p>
    </div>
    <button type="button" onclick="window.location.href='<?= base_url('admin/members/add') ?>'" class="outline">＋ Tambah Warga</button>
  </div>

  <article class="card table-card">
    <div class="table-tools">
      <form class="search" method="GET" action="<?= base_url('admin/members') ?>">
        <input type="hidden" name="status" value="<?= esc($status) ?>">
        ⌕ <input type="text" name="q" placeholder="Cari nama atau nomor HP..." value="<?= esc($q) ?>">
      </form>
      <div class="chips">
        <button type="button" onclick="window.location.href='<?= base_url('admin/members') ?>'" class="<?= ($status === 'semua' || empty($status)) ? 'active' : '' ?>">Semua</button>
        <button type="button" onclick="window.location.href='<?= base_url('admin/members?status=aktif') ?>'" class="<?= ($status === 'aktif') ? 'active' : '' ?>">Aktif</button>
        <button type="button" onclick="window.location.href='<?= base_url('admin/members?status=lunas') ?>'" class="<?= ($status === 'lunas') ? 'active' : '' ?>">Lunas</button>
      </div>
    </div>

    <div class="table-scroll">
      <table>
        <thead>
          <tr>
            <th>Nama warga</th>
            <th>Saldo tabungan</th>
            <th>Progres target</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($members)): ?>
            <tr>
              <td colspan="4" style="text-align:center; padding: 30px; color: var(--muted);">Tidak ada data warga ditemukan.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($members as $warga): ?>
              <?php 
                $saldo = $warga['saldo_tabungan'] ?? 0;
                $target = max(1, $warga['target_qurban'] ?? 1); 
                $progress = min(100, round(($saldo / $target) * 100));
                
                $statusClass = 'active'; // Default
                if ($warga['status'] === 'Lunas') {
                    $statusClass = 'paid';
                } elseif ($warga['status'] === 'Perlu diingatkan') {
                    $statusClass = 'warn';
                }
              ?>
              <tr>
                <td><b><?= esc($warga['nama_lengkap']) ?></b><small><?= esc($warga['no_hp']) ?></small></td>
                <td><b>Rp<?= number_format($saldo, 0, ',', '.') ?></b></td>
                <td><div class="row-progress"><span><i style="width:<?= $progress ?>%"></i></span><?= $progress ?>%</div></td>
                <td><span class="status <?= $statusClass ?>"><?= esc($warga['status']) ?></span></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <footer class="table-footer">
      Menampilkan <?= count($members) ?> warga
      <span>
        <button type="button">←</button>
        <button type="button">1</button>
        <button type="button">→</button>
      </span>
    </footer>
  </article>
</section>
<?= $this->endSection() ?>
