<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_admin') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="screen admin-add-warga-screen">
  <div class="page-title">
    <div>
      <small>TAMBAH WARGA</small>
      <h1>Pendaftaran Peserta Baru</h1>
      <p>Masukkan data warga untuk mendaftarkan peserta qurban baru.</p>
    </div>
    <button type="button" onclick="window.location.href='<?= base_url('admin/members') ?>'" class="outline">Kembali</button>
  </div>

  <article class="card form-card">
    <?php if (!empty($errorMsg)): ?>
      <div style="background: #fee; color: #c00; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
        <?= esc($errorMsg) ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="<?= base_url('admin/members/add') ?>">
      <div class="form-grid" style="display: flex; flex-direction: column; gap: 15px; max-width: 600px;">
        
        <label style="display:flex; flex-direction:column; gap:5px; font-weight:600;">
          Nama Lengkap <small style="font-weight:normal; color:var(--muted);">(Kata pertama akan jadi username, password default adalah username+123)</small>
          <input type="text" name="nama_lengkap" required placeholder="Contoh: Ahmad Syafi'i" style="padding:10px; border:1px solid #ccc; border-radius:6px; background:#fff;">
        </label>
        
        <label style="display:flex; flex-direction:column; gap:5px; font-weight:600;">
          Nomor HP
          <input type="text" name="no_hp" required placeholder="Contoh: 081234567890" style="padding:10px; border:1px solid #ccc; border-radius:6px; background:#fff;">
        </label>
        
        <label style="display:flex; flex-direction:column; gap:5px; font-weight:600;">
          RT / RW
          <input type="text" name="rt_rw" required placeholder="Contoh: RT 04" style="padding:10px; border:1px solid #ccc; border-radius:6px; background:#fff;">
        </label>

        <label style="display:flex; flex-direction:column; gap:5px; font-weight:600;">
          Jenis Qurban
          <select name="jenis_qurban" id="jenis_qurban" required onchange="updateTarget()" style="padding:10px; border:1px solid #ccc; border-radius:6px; background:#fff;">
            <option value="">-- Pilih Jenis Qurban --</option>
            <option value="Sapi Kolektif" data-target="12500000">Sapi Kolektif</option>
            <option value="Kambing" data-target="3500000">Kambing</option>
            <option value="Sapi Utuh" data-target="25000000">Sapi Utuh</option>
          </select>
        </label>

        <label style="display:flex; flex-direction:column; gap:5px; font-weight:600;">
          Target Qurban (Rp)
          <input type="number" name="target_qurban" id="target_qurban" required placeholder="Pilih jenis qurban terlebih dahulu" style="padding:10px; border:1px solid #ccc; border-radius:6px; background:#fff;">
        </label>

      </div>

      <div style="margin-top: 25px;">
        <button type="submit" class="btn" style="background:#0e603a; color:#fff; padding:12px 24px; border:none; border-radius:8px; font-weight:bold; cursor:pointer;">Simpan Data Warga</button>
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
