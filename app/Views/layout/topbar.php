<?php
$session = session();
$userRole = $session->get('role') ?? 'warga';
$userName = $session->get('user_name') ?? 'Pengguna';
$userSub  = $session->get('user_sub') ?? 'Warga';
$userAvatar = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $userName), 0, 2));
if (empty($userAvatar)) $userAvatar = 'WQ';
$portalLabel = ($userRole === 'admin') ? 'Pengurus Kas' : 'Warga Penabung';

$unreadCount = $unreadCount ?? 0;
$notifs = $notifs ?? [];
?>
<header class="topbar">
  <div class="topbar-left">
    <button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Buka Menu" onclick="document.querySelector('.sidebar')?.classList.toggle('open')">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    </button>

    <a href="<?= base_url($userRole === 'admin' ? 'admin' : 'warga') ?>" class="brand">
      <img src="<?= base_url('img/logo.png?v=' . time()) ?>" alt="Logo AT-TAQWA" class="logo">
      <div class="brand-text">
        <b class="brand-title">AT-TAQWA</b>
        <small class="brand-sub">Tabungan Qurban Warga</small>
      </div>
    </a>
  </div>
  
  <div class="topbar-center">
    <div class="portal-badge">
      <span class="portal-dot"></span>
      <span><?= esc($portalLabel) ?></span>
    </div>

    <a href="<?= base_url() ?>" class="topbar-link-landing" title="Kunjungi Halaman Depan / Landing Page">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
      <span>Halaman Utama</span>
    </a>
  </div>

  <div class="account-actions">
    <!-- Notification Bell -->
    <div class="bell" tabindex="0" onclick="this.classList.toggle('active')">
      <div class="bell-icon-wrap">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
        <?php if ($unreadCount > 0): ?>
          <span class="bell-badge"><?= $unreadCount ?></span>
        <?php endif; ?>
      </div>
      <div class="dropdown notif-dropdown" onclick="event.stopPropagation()">
        <div class="dropdown-header">
          <strong>Pemberitahuan</strong>
          <small><?= count($notifs) ?> pesan</small>
        </div>
        <div class="dropdown-body">
          <?php if (empty($notifs)): ?>
            <div class="notif-empty">Belum ada pemberitahuan baru.</div>
          <?php else: ?>
            <?php foreach ($notifs as $n): ?>
              <a href="<?= base_url('notifikasi/read/' . $n['id_notifikasi']) ?>?link=<?= urlencode($n['link_to']) ?>" class="notif-item <?= $n['is_read'] ? 'read' : 'unread' ?>">
                <p><?= esc($n['pesan']) ?></p>
                <time><?= date('d M Y, H:i', strtotime($n['created_at'])) ?></time>
              </a>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- User Profile Dropdown -->
    <div class="user-profile" tabindex="0" onclick="this.classList.toggle('active')">
      <div class="avatar"><?= esc($userAvatar) ?></div>
      <div class="user-info">
        <b><?= esc($userName) ?></b>
        <small><?= esc($userSub) ?></small>
      </div>
      <svg class="chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>

      <div class="dropdown user-dropdown" onclick="event.stopPropagation()">
        <div class="user-dropdown-meta">
          <strong><?= esc($userName) ?></strong>
          <small><?= esc($userRole === 'admin' ? 'Akses Pengurus' : 'Akses Warga') ?></small>
        </div>
        <hr>
        <a href="<?= base_url() ?>" class="dropdown-link">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
          <span>Halaman Utama (Publik)</span>
        </a>
        <a href="<?= base_url('logout') ?>" class="dropdown-logout">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
          <span>Keluar Akun</span>
        </a>
      </div>
    </div>
  </div>
</header>
