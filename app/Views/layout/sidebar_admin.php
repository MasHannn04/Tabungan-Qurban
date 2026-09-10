<?php
$request = service('request');
$currentRoute = $request->getUri()->getSegment(1) ?? 'admin';
$subRoute = $request->getUri()->getSegment(2) ?? '';
?>
<aside class="sidebar admin-nav">
  <nav class="nav-list">
    <a href="<?= base_url('admin') ?>" class="nav-item <?= ($currentRoute === 'admin' && empty($subRoute)) ? 'active' : '' ?>">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
      <span>Beranda Ringkasan</span>
    </a>
    
    <a href="<?= base_url('admin/members') ?>" class="nav-item <?= ($subRoute === 'members') ? 'active' : '' ?>">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
      <span>Data Anggota Warga</span>
    </a>
    
    <a href="<?= base_url('admin/report') ?>" class="nav-item <?= ($subRoute === 'report') ? 'active' : '' ?>">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
      <span>Laporan Kas Qurban</span>
    </a>

    <div class="nav-divider"></div>

    <a href="<?= base_url() ?>" class="nav-item nav-item-landing">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
      <span>Halaman Utama (Publik)</span>
    </a>
  </nav>

  <div class="sidebar-footer-card">
    <div class="eid-header">
      <span class="eid-tag">Tahun 1448 H</span>
      <span class="eid-icon">🌙</span>
    </div>
    <b>Hari Raya Iduladha</b>
    <p>Perkiraan 27 Mei 2027</p>
    <small>Target persiapan kas lingkungan</small>
  </div>
</aside>
