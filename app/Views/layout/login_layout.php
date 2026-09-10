<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($pageTitle ?? 'AT-TAQWA — Tabungan Qurban Warga') ?></title>
  <meta name="description" content="Aplikasi Tabungan Qurban Warga AT-TAQWA">
  <link rel="stylesheet" href="/styles.css">
  <link rel="stylesheet" href="/asset/styles.css">
  <link rel="icon" type="image/x-icon" href="/favicon.ico?v=3">
</head>
<body class="<?= esc($bodyClass ?? 'login-body') ?>">
  
  <?= $this->renderSection('content') ?>

</body>
</html>
