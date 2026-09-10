<?php
// Di CI4 kita bisa cek route saat ini menggunakan service request
$request = service('request');
$currentRoute = $request->getUri()->getSegment(1) ?? 'admin';
?>
<aside class="sidebar admin-nav admin-nav-sidebar">
  <nav>
    <a href="<?= base_url('admin') ?>" class="<?= ($currentRoute === 'admin' && empty($request->getUri()->getSegment(2))) ? 'active' : '' ?>">
      <i>⌂</i> Beranda
    </a>
    <a href="<?= base_url('admin/members') ?>" class="<?= ($request->getUri()->getSegment(2) === 'members') ? 'active' : '' ?>">
      <i>👤</i> Data Warga
    </a>
    <a href="<?= base_url('admin/report') ?>" class="<?= ($request->getUri()->getSegment(2) === 'report') ? 'active' : '' ?>">
      <i>▤</i> Laporan Keuangan
    </a>
  </nav>
  <div class="eid">
    <small>1447 H</small>
    <b>Idul Adha</b>
    <span>Perkiraan 27 Mei 2027</span>
  </div>
</aside>
