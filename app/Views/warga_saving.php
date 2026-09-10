<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_warga') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="screen user-saving-screen">
  <div class="page-title">
    <div>
      <small>TABUNGAN SAYA</small>
      <h1>Tambah setoran qurban</h1>
      <p>Catat setoran baru untuk mendekatkan diri pada target qurban Anda.</p>
    </div>
  </div>

  <?php if (!empty($successMsg)): ?>
    <div style="background: #eafbe7; color: #2e6b2d; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
      <b>✓ Berhasil!</b> <?= esc($successMsg) ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($errorMsg)): ?>
    <div style="background: #fbe7e7; color: #9b1c1c; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
      <b>✕ Gagal!</b> <?= esc($errorMsg) ?>
    </div>
  <?php endif; ?>

  <div class="form-grid">
    <form action="<?= base_url('warga/saving/process') ?>" method="POST" class="card form-card">
      <?= csrf_field() ?>
      
      <label>Nominal setoran</label>
      <div class="money">
        <span>Rp</span>
        <input type="text" name="nominal" id="inputNominal" value="500.000" aria-label="Nominal setoran" oninput="updatePreview()">
      </div>
      <div class="chips">
        <button type="button" onclick="setNominal(250000)">Rp250.000</button>
        <button type="button" onclick="setNominal(500000)">Rp500.000</button>
        <button type="button" onclick="setNominal(1000000)">Rp1.000.000</button>
      </div>

      <label>Metode pembayaran</label>
      <div class="payment">
        <select name="metode" style="width: 100%; border: none; background: transparent; outline: none; font-weight: bold; cursor: pointer;">
            <option value="BSI - 7171 8800 42">BSI - 7171 8800 42</option>
            <option value="Tunai">Tunai</option>
        </select>
      </div>

      <label>Catatan <small>Opsional</small></label>
      <textarea name="keterangan">Setoran rutin</textarea>
      
      <button type="submit" class="primary">Konfirmasi Setoran →</button>
    </form>

    <aside class="card summary">
      <span>Ringkasan target</span>
      <h3><?= esc($warga['jenis_qurban']) ?></h3>
      <p>
        <span>Tabungan saat ini</span>
        <b>Rp<?= number_format($warga['saldo_tabungan'], 0, ',', '.') ?></b>
      </p>
      <p>
        <span>Setoran baru</span>
        <b class="green" id="previewNominal">+Rp500.000</b>
      </p>
      <hr>
      <p class="total">
        <span>Saldo setelah setoran</span>
        <b id="previewTotal">Rp<?= number_format($warga['saldo_tabungan'] + 500000, 0, ',', '.') ?></b>
      </p>
      <div class="progress"><i id="previewProgress" style="width:<?= min(100, round((($warga['saldo_tabungan'] + 500000) / max(1, $warga['target_qurban'])) * 100)) ?>%"></i></div>
      <small>Pembayaran akan diverifikasi maksimal 1×24 jam.</small>
    </aside>
  </div>
</section>

<script>
const currentSaldo = <?= $warga['saldo_tabungan'] ?>;
const target = <?= max(1, $warga['target_qurban']) ?>;

function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}

function updatePreview() {
    let inputStr = document.getElementById('inputNominal').value.replace(/\./g, '');
    let nominal = parseInt(inputStr) || 0;
    
    // Auto-format input
    if (nominal > 0) {
        document.getElementById('inputNominal').value = formatRupiah(nominal);
    }
    
    document.getElementById('previewNominal').textContent = '+Rp' + formatRupiah(nominal);
    document.getElementById('previewTotal').textContent = 'Rp' + formatRupiah(currentSaldo + nominal);
    
    let pct = target > 0 ? Math.min(100, Math.round(((currentSaldo + nominal) / target) * 100)) : 0;
    document.getElementById('previewProgress').style.width = pct + '%';
}

function setNominal(amount) {
    document.getElementById('inputNominal').value = formatRupiah(amount);
    updatePreview();
}
</script>
<?= $this->endSection() ?>
