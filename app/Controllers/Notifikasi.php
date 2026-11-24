<?php

namespace App\Controllers;

class Notifikasi extends BaseController
{
    public function read($id = null)
    {
        $session = session();
        if (!$session->has('id_user')) {
            return redirect()->to('/login');
        }

        $id_user = $session->get('id_user');
        $db = \Config\Database::connect();

        if ($id) {
            $db->table('notifikasi')
               ->where('id_notifikasi', $id)
               ->where('id_user', $id_user)
               ->update(['is_read' => 1]);
        }

        $link = $this->request->getGet('link');
        if (!empty($link)) {
            return redirect()->to(base_url($link));
        }

        $role = $session->get('role');
        return redirect()->to(base_url($role === 'admin' ? 'admin' : 'warga'));
    }
}
