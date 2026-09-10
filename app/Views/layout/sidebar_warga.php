<?php
// Di CI4 kita bisa cek route saat ini menggunakan service request
$request = service('request');
$currentRoute = $request->getUri()->getSegment(1) ?? 'warga';
?>
<aside class="sidebar user-nav">
  <nav>
    <a href="<?= base_url('warga') ?>" class="<?= ($currentRoute === 'warga' && empty($request->getUri()->getSegment(2))) ? 'active' : '' ?>">
      <i>⌂</i> Beranda
    </a>
    <a href="<?= base_url('warga/saving') ?>" class="<?= ($request->getUri()->getSegment(2) === 'saving') ? 'active' : '' ?>">
      <i>▣</i> Tabungan Saya
    </a>
    <a href="<?= base_url('warga/history') ?>" class="<?= ($request->getUri()->getSegment(2) === 'history') ? 'active' : '' ?>">
      <i>↻</i> Riwayat Transaksi
    </a>
  </nav>
  <div class="eid">
    <small>1447 H</small>
    <b>Idul Adha</b>
    <span>Perkiraan 27 Mei 2027</span>
  </div>
</aside>
