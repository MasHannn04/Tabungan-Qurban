<?= $this->extend('layout/default') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('layout/sidebar_warga') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="screen user-saving-screen">
  <div class="page-title-wrap">
    <div>
      <span class="badge-role">TABUNGAN SAYA</span>
      <h1>Catat Setoran Baru</h1>
      <p>Kirimkan catatan setoran tabungan untuk diverifikasi oleh pengurus kas qurban.</p>
    </div>
  </div>

  <?php if (!empty($successMsg)): ?>
    <div class="alert-box alert-success">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
      <span><?= esc($successMsg) ?></span>
    </div>
  <?php endif; ?>
  <?php if (!empty($errorMsg)): ?>
    <div class="alert-box alert-error">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
      <span><?= esc($errorMsg) ?></span>
    </div>
  <?php endif; ?>

  <div class="saving-layout-grid">
    <form action="<?= base_url('warga/saving/process') ?>" method="POST" class="card form-card">
      <?= csrf_field() ?>
      
      <div class="form-group">
        <label for="inputNominal">Nominal yang Disetorkan (Rp)</label>
        <div class="money-input-wrap">
          <span class="currency-prefix">Rp</span>
          <input type="text" name="nominal" id="inputNominal" value="500.000" required aria-label="Nominal setoran" oninput="updatePreview()" class="form-control input-money">
        </div>
        
        <div class="quick-nominal-chips">
          <button type="button" class="quick-chip" onclick="setNominal(250000)">+250 rb</button>
          <button type="button" class="quick-chip active" onclick="setNominal(500000)">+500 rb</button>
          <button type="button" class="quick-chip" onclick="setNominal(1000000)">+1 jt</button>
          <button type="button" class="quick-chip" onclick="setNominal(2000000)">+2 jt</button>
        </div>
      </div>

      <div class="form-group">
        <label for="metode">Metode Penyetoran</label>
        <select name="metode" id="metode" class="form-control" style="font-weight: 600;">
          <option value="Transfer BSI - 7171 8800 42">Transfer Bank Syariah Indonesia (BSI) 7171 8800 42</option>
          <option value="Tunai ke Pengurus RT">Tunai ke Pengurus RT</option>
        </select>
        <small class="form-hint">Jika transfer, cantumkan nama Anda pada berita transfer.</small>
      </div>

      <div class="form-group">
        <label for="keterangan">Catatan Tambahan <small>(Boleh dikosongkan)</small></label>
        <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Contoh: Setoran rutin tabungan bulan ini">Setoran rutin</textarea>
      </div>
      
      <div class="form-actions">
        <button type="submit" class="btn-submit">
          <span>Kirim Data Setoran</span>
        </button>
      </div>
    </form>

    <!-- Real-time Summary Card -->
    <aside class="card summary-aside">
      <div class="card-header">
        <div>
          <span class="card-subtitle">PERKIRAAN PROGRES</span>
          <h3><?= esc($warga['jenis_qurban']) ?></h3>
        </div>
      </div>

      <div class="summary-lines">
        <div class="summary-line">
          <span>Saldo saat ini</span>
          <b>Rp<?= number_format($warga['saldo_tabungan'], 0, ',', '.') ?></b>
        </div>
        <div class="summary-line">
          <span>Setoran baru yang dicatat</span>
          <b class="text-emerald" id="previewNominal">+Rp500.000</b>
        </div>
        <hr class="summary-divider">
        <div class="summary-line line-total">
          <span>Perkiraan total saldo</span>
          <b id="previewTotal">Rp<?= number_format($warga['saldo_tabungan'] + 500000, 0, ',', '.') ?></b>
        </div>
        <div class="summary-target-info">
          <small>Target: Rp<?= number_format($warga['target_qurban'], 0, ',', '.') ?></small>
          <span class="pct-badge" id="previewPct"><?= min(100, round((($warga['saldo_tabungan'] + 500000) / max(1, $warga['target_qurban'])) * 100)) ?>%</span>
        </div>
        <div class="progress-track">
          <div class="progress-fill" id="previewProgress" style="width: <?= min(100, round((($warga['saldo_tabungan'] + 500000) / max(1, $warga['target_qurban'])) * 100)) ?>%;"></div>
        </div>
      </div>

      <div class="summary-footer-note">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
        <span>Setoran akan diverifikasi pengurus maksimal 1x24 jam setelah dana masuk.</span>
      </div>
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
    let raw = document.getElementById('inputNominal').value.replace(/\D/g, '');
    let nominal = parseInt(raw) || 0;
    
    if (nominal > 0) {
        document.getElementById('inputNominal').value = formatRupiah(nominal);
    }
    
    document.getElementById('previewNominal').textContent = '+Rp' + formatRupiah(nominal);
    let totalBaru = currentSaldo + nominal;
    document.getElementById('previewTotal').textContent = 'Rp' + formatRupiah(totalBaru);
    
    let pct = target > 0 ? Math.min(100, Math.round((totalBaru / target) * 100)) : 0;
    document.getElementById('previewPct').textContent = pct + '%';
    document.getElementById('previewProgress').style.width = pct + '%';
}

function setNominal(amount) {
    document.getElementById('inputNominal').value = formatRupiah(amount);
    
    document.querySelectorAll('.quick-chip').forEach(btn => btn.classList.remove('active'));
    if (event && event.target) {
        event.target.classList.add('active');
    }
    updatePreview();
}
</script>
<?= $this->endSection() ?>
