<?php
// Di CI4 kita bisa memanggil session seperti ini
$session = session();
$userRole = $session->get('role') ?? 'warga';
$userName = $session->get('user_name') ?? 'Pengguna';
$userSub  = $session->get('user_sub') ?? 'Warga';
$userAvatar = strtoupper(substr($userName, 0, 2));
$portalLabel = ($userRole === 'admin') ? 'Portal Administrator' : 'Portal Warga';

// Untuk notifikasi kita bisa siapkan variabel (nanti akan dikirim dari controller atau base controller)
$unreadCount = $unreadCount ?? 0;
$notifs = $notifs ?? [];
?>
<header class="topbar">
  <a href="<?= base_url($userRole === 'admin' ? 'admin' : 'warga') ?>" class="brand" style="text-decoration: none; color: inherit;">
    <img src="<?= base_url('img/logo.png?v=' . time()) ?>" alt="Logo AT-TAQWA" class="logo" style="width: 32px; height: auto;">
    <span><b>AT-TAQWA</b><small>Tabungan Qurban Warga</small></span>
  </a>
  
  <div class="portal-tag">
    <i>●</i> <?= esc($portalLabel) ?>
  </div>

  <div class="account">
    <div class="bell" onclick="this.classList.toggle('active')">
      ♢<?php if ($unreadCount > 0): ?><i><?= $unreadCount ?></i><?php endif; ?>
      <div class="dropdown notif-dropdown">
        <header>Notifikasi</header>
        <?php if (empty($notifs)): ?>
          <div class="notif-item"><small style="text-align:center; padding:10px 0;">Belum ada notifikasi.</small></div>
        <?php else: ?>
          <?php foreach ($notifs as $n): ?>
            <a href="<?= base_url('notifikasi/read/' . $n['id_notifikasi']) ?>?link=<?= urlencode($n['link_to']) ?>" class="notif-item <?= $n['is_read'] ? 'read' : 'unread' ?>">
              <p><?= esc($n['pesan']) ?></p>
              <small><?= date('d M Y, H:i', strtotime($n['created_at'])) ?></small>
            </a>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
    <div class="user-profile" onclick="this.classList.toggle('active')">
      <span class="avatar"><?= esc($userAvatar) ?></span>
      <span><b><?= esc($userName) ?></b><small><?= esc($userSub) ?></small></span>
      <div class="dropdown">
        <a href="<?= base_url('logout') ?>" class="logout-btn" title="Keluar dari sistem"><i>↪</i> Keluar</a>
      </div>
    </div>
  </div>
</header>
