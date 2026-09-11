<?php
$request = service('request');
$currentRoute = $request->getUri()->getSegment(1) ?? 'warga';
$subRoute = $request->getUri()->getSegment(2) ?? '';
?>
<aside class="sidebar user-nav">
  <nav class="nav-list">
    <a href="<?= base_url('warga') ?>" class="nav-item <?= ($currentRoute === 'warga' && empty($subRoute)) ? 'active' : '' ?>">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
      <span>Beranda Tabungan</span>
    </a>
    
    <a href="<?= base_url('warga/saving') ?>" class="nav-item <?= ($subRoute === 'saving') ? 'active' : '' ?>">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
      <span>Catat Setoran Baru</span>
    </a>
    
    <a href="<?= base_url('warga/history') ?>" class="nav-item <?= ($subRoute === 'history') ? 'active' : '' ?>">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
      <span>Riwayat Setoran</span>
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
    <small>InsyaAllah niat qurban terlaksana</small>
  </div>
</aside>
