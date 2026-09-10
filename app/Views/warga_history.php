<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_warga') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="screen user-history-screen">
  <div class="page-title">
    <div>
      <small>RIWAYAT TRANSAKSI</small>
      <h1>Jejak kebaikan Anda.</h1>
      <p>Daftar seluruh setoran tabungan qurban yang pernah Anda lakukan.</p>
    </div>
    <button type="button" class="outline" onclick="window.print()">↓ Cetak Riwayat</button>
  </div>

  <article class="card table-card">
    <div class="table-scroll">
      <table>
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Metode</th>
            <th>Status</th>
            <th>Nominal</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($history)): ?>
            <tr>
              <td colspan="5" style="text-align:center; padding: 30px; color: var(--muted);">Belum ada riwayat transaksi.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($history as $row): ?>
            <tr>
              <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
              <td><b><?= esc($row['keterangan']) ?></b></td>
              <td><?= esc($row['metode']) ?></td>
              <td>
                <span class="status <?= ($row['status'] === 'Berhasil') ? 'active' : (($row['status'] === 'Pending') ? 'warn' : '') ?>">
                  <?= esc($row['status']) ?>
                </span>
              </td>
              <td class="green"><b>+Rp<?= number_format($row['nominal'], 0, ',', '.') ?></b></td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    
    <?php if (!empty($history)): ?>
    <footer class="table-footer">
      Menampilkan <?= count($history) ?> transaksi
    </footer>
    <?php endif; ?>
  </article>
</section>
<?= $this->endSection() ?>
