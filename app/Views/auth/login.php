<?= $this->extend('layout/login_layout') ?>

<?= $this->section('content') ?>
<div class="login-wrapper">
  <div class="login-card">
    <div class="login-header">
      <a href="<?= base_url() ?>" class="login-logo-link">
        <img src="<?= base_url('img/logo.png?v=' . time()) ?>" alt="Logo AT-TAQWA" class="login-logo">
      </a>
      <span class="login-badge">Kas Tabungan Qurban</span>
      <h1>Masuk ke Akun</h1>
      <p>Silakan masukkan nama akun dan kata sandi Anda</p>
    </div>

    <?php if (!empty($errorMsg)): ?>
      <div class="alert-box alert-error">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
        <span><?= esc($errorMsg) ?></span>
      </div>
    <?php endif; ?>

    <form action="/login/process" method="POST" class="login-form">
      <?= csrf_field() ?>
      
      <div class="form-group">
        <label for="username">Nama Akun (Username)</label>
        <div class="input-icon-wrap">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
          <input type="text" id="username" name="username" placeholder="Contoh: warga atau admin" required autocomplete="username">
        </div>
      </div>

      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <div class="input-icon-wrap">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
          <input type="password" id="password" name="password" placeholder="Masukkan kata sandi akun" required autocomplete="current-password">
        </div>
      </div>

      <button type="submit" class="btn-primary-block">Masuk ke Akun</button>
    </form>

    <div class="login-divider">
      <span>Akses Cepat Uji Coba</span>
    </div>

    <div class="demo-login-grid">
      <a href="<?= base_url('login?demo=admin') ?>" class="demo-btn">
        <span class="demo-role">Akses Pengurus</span>
        <span class="demo-name">Pak Fauzan (Admin)</span>
      </a>
      <a href="<?= base_url('login?demo=warga') ?>" class="demo-btn">
        <span class="demo-role">Akses Warga</span>
        <span class="demo-name">Ahmad Syafi'i</span>
      </a>
    </div>

    <div class="login-footer-back">
      <a href="<?= base_url() ?>">← Kembali ke Halaman Utama</a>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
