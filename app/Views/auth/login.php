<?= $this->extend('layout/login_layout') ?>

<?= $this->section('content') ?>
<div class="login-container">
  <div class="login-card">
    <div class="login-brand">
      <img src="<?= base_url('img/logo.png?v=' . time()) ?>" alt="Logo AT-TAQWA" class="logo">
      <h1>AT-TAQWA</h1>
      <p>Sistem Tabungan Qurban Warga</p>
    </div>

    <?php if (!empty($errorMsg)): ?>
      <div class="error-message" style="display: block;">
        <?= esc($errorMsg) ?>
      </div>
    <?php endif; ?>

    <form action="/login/process" method="POST">
      <?= csrf_field() ?> <!-- Fitur keamanan CI4 (Cross Site Request Forgery) -->
      
      <div class="input-group">
        <label for="username">Username / ID Warga</label>
        <input type="text" id="username" name="username" placeholder="Masukkan username (cth: warga / admin)" required autocomplete="username">
      </div>

      <div class="input-group">
        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required autocomplete="current-password">
      </div>

      <button type="submit" class="login-btn">Masuk ke Sistem →</button>
    </form>


  </div>
</div>
<?= $this->endSection() ?>
