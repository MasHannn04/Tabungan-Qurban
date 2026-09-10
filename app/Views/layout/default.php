<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($pageTitle ?? 'AT-TAQWA | Tabungan Qurban Warga') ?></title>
  <meta name="description" content="Sistem Informasi Pencatatan dan Transparansi Tabungan Qurban Warga AT-TAQWA">
  
  <!-- Modern Google Font: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="/styles.css?v=<?= time() ?>">
  <link rel="icon" type="image/x-icon" href="/favicon.ico?v=3">
</head>
<body class="<?= esc($bodyClass ?? 'admin-body') ?>">
  
  <?= $this->include('layout/topbar') ?>
  
  <div class="app-shell">
    <?= $this->renderSection('sidebar') ?>
    <main class="main-content">
      <?= $this->renderSection('content') ?>
    </main>
  </div>

</body>
</html>
