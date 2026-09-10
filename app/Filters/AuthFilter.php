<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Mengecek apakah user sudah login dengan mengecek session 'role'
        $session = session();
        if (!$session->has('role')) {
            // Jika belum login, tendang (redirect) kembali ke halaman landing
            return redirect()->to('/')->with('errorMsg', 'Sesi Anda telah berakhir.');
        }

        // Jika filter ini dipasang dengan argumen khusus (misalnya role admin)
        if ($arguments && !in_array($session->get('role'), $arguments)) {
            // Jika rolenya tidak sesuai (misal warga coba akses admin)
            return redirect()->to('/')->with('errorMsg', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Lakukan sesuatu setelah response dikirim ke browser (biasanya dibiarkan kosong)
    }
}
