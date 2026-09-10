<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($pageTitle ?? 'AT-TAQWA — Tabungan Qurban Warga') ?></title>
  <meta name="description" content="Aplikasi Tabungan Qurban Warga AT-TAQWA">
  <!-- Memanggil CSS dari folder public -->
  <link rel="stylesheet" href="/styles.css?v=2">
  <link rel="stylesheet" href="/asset/styles.css?v=2">
  <link rel="icon" type="image/x-icon" href="/favicon.ico?v=3">
</head>
<body class="<?= esc($bodyClass ?? 'admin-body') ?>">
  
  <?= $this->include('layout/topbar') ?>
  
  <?= $this->renderSection('sidebar') ?>

  <main>
    <?= $this->renderSection('content') ?>
  </main>

</body>
</html>
