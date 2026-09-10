<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_warga') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="screen user-history-screen">
  <div class="page-title-wrap">
    <div>
      <span class="badge-role">RIWAYAT TRANSAKSI</span>
      <h1>Catatan Setoran Anda</h1>
      <p>Daftar seluruh setoran tabungan qurban yang telah Anda setorkan beserta status verifikasinya.</p>
    </div>
    <button type="button" class="btn-secondary-action" onclick="window.print()">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
      <span>Cetak Riwayat</span>
    </button>
  </div>

  <article class="card table-card">
    <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Metode Pembayaran</th>
            <th>Status Verifikasi</th>
            <th style="text-align: right;">Jumlah Disetor</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($history)): ?>
            <tr>
              <td colspan="5" class="table-empty">Belum ada riwayat setoran tercatat.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($history as $row): ?>
            <tr>
              <td>
                <span class="text-date"><?= date('d M Y', strtotime($row['tanggal'])) ?></span>
              </td>
              <td>
                <b><?= esc($row['keterangan']) ?></b>
              </td>
              <td>
                <span class="badge-method"><?= esc($row['metode']) ?></span>
              </td>
              <td>
                <span class="status-pill status-<?= strtolower($row['status']) ?>">
                  <?= esc($row['status']) ?>
                </span>
              </td>
              <td style="text-align: right;">
                <b class="text-nominal-plus">+Rp<?= number_format($row['nominal'], 0, ',', '.') ?></b>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    
    <?php if (!empty($history)): ?>
    <footer class="table-footer">
      <span>Total <b><?= count($history) ?></b> transaksi setoran</span>
    </footer>
    <?php endif; ?>
  </article>
</section>
<?= $this->endSection() ?>
