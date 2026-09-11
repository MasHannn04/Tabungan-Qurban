<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_admin') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="screen admin-add-warga-screen">
  <div class="page-title-wrap">
    <div>
      <span class="badge-role">PENDAFTARAN</span>
      <h1>Tambah Peserta Qurban</h1>
      <p>Masukkan data warga yang ingin ikut serta dalam program tabungan qurban.</p>
    </div>
    <a href="<?= base_url('admin/members') ?>" class="btn-secondary-action">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
      <span>Kembali ke Data Warga</span>
    </a>
  </div>

  <article class="card form-card-wrap">
    <?php if (!empty($errorMsg)): ?>
      <div class="alert-box alert-error">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
        <span><?= esc($errorMsg) ?></span>
      </div>
    <?php endif; ?>

    <form method="POST" action="<?= base_url('admin/members/add') ?>" class="modern-form">
      <?= csrf_field() ?>
      
      <div class="form-grid-2">
        <div class="form-group">
          <label for="nama_lengkap">Nama Lengkap Warga</label>
          <input type="text" id="nama_lengkap" name="nama_lengkap" required placeholder="Contoh: Ahmad Syafi'i" class="form-control">
          <small class="form-hint">Kata pertama akan dipakai sebagai username akun.</small>
        </div>
        
        <div class="form-group">
          <label for="no_hp">Nomor HP atau WhatsApp</label>
          <input type="text" id="no_hp" name="no_hp" required placeholder="Contoh: 081234567890" class="form-control">
          <small class="form-hint">Untuk kontak pengingat dan konfirmasi setoran.</small>
        </div>
      </div>

      <div class="form-grid-2">
        <div class="form-group">
          <label for="rt_rw">Wilayah RT / RW</label>
          <input type="text" id="rt_rw" name="rt_rw" required placeholder="Contoh: RT 04" value="RT 04" class="form-control">
        </div>

        <div class="form-group">
          <label for="jenis_qurban">Pilihan Hewan Qurban</label>
          <select name="jenis_qurban" id="jenis_qurban" required onchange="updateTarget()" class="form-control">
            <option value="">Pilih Jenis Hewan</option>
            <option value="Sapi Kolektif" data-target="12500000">Sapi Kolektif (Patungan 1/7) - Rp12.500.000</option>
            <option value="Kambing" data-target="3500000">Kambing atau Domba - Rp3.500.000</option>
            <option value="Sapi Utuh" data-target="25000000">Sapi Utuh - Rp25.000.000</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="target_qurban">Target Biaya Tabungan (Rp)</label>
        <input type="number" name="target_qurban" id="target_qurban" required placeholder="Pilih hewan qurban di atas" class="form-control" style="font-weight:700; font-size:16px;">
        <small class="form-hint">Target nominal dapat disesuaikan manual bila terdapat kesepakatan harga khusus.</small>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn-submit">
          <span>Simpan Data Peserta</span>
        </button>
      </div>
    </form>
  </article>
</section>

<script>
function updateTarget() {
  const select = document.getElementById('jenis_qurban');
  const targetInput = document.getElementById('target_qurban');
  const selectedOption = select.options[select.selectedIndex];
  
  if (selectedOption && selectedOption.dataset.target) {
    targetInput.value = selectedOption.dataset.target;
  } else {
    targetInput.value = '';
  }
}
</script>
<?= $this->endSection() ?>
