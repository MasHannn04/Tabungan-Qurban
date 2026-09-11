<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Jika sudah login, redirect
        $session = session();
        if ($session->get('role') === 'admin') {
            return redirect()->to('/admin');
        } elseif ($session->get('role') === 'warga') {
            return redirect()->to('/warga');
        }

        // Tangani "Demo Instant Login" dari parameter GET ?demo=...
        $demo = $this->request->getGet('demo');
        if ($demo === 'warga') {
            $session->set([
                'role' => 'warga',
                'user_name' => "Ahmad Syafi'i",
                'user_sub' => "Warga RT 04",
                'id_user' => 2, // ID user untuk warga (menyesuaikan database)
                'id_warga' => 1 // ID warga
            ]);
            return redirect()->to('/warga');
        } elseif ($demo === 'admin') {
            $session->set([
                'role' => 'admin',
                'user_name' => "Pak Fauzan",
                'user_sub' => "Administrator",
                'id_user' => 1
            ]);
            return redirect()->to('/admin');
        }

        $data = [
            'pageTitle' => "AT-TAQWA | Masuk Akun",
            'bodyClass' => "login-body",
            'errorMsg'  => $session->getFlashdata('errorMsg')
        ];
        return view('auth/login', $data);
    }

    public function loginProcess()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new \App\Models\UserModel();
        
        if (empty($username)) {
            return redirect()->to('/login')->with('errorMsg', 'Sistem gagal membaca input Anda (Tolong ulangi tekan tombol login sekali lagi).');
        }

        $user = $userModel->where('username', $username)->first();

        if ($user) {
            // Verifikasi password (asumsi password di DB di-hash dengan password_hash())
            if (password_verify((string)$password, $user['password'])) {
                $sessionData = [
                    'id_user'   => $user['id_user'],
                    'user_name' => $user['nama_lengkap'],
                    'role'      => $user['role'],
                    'isLoggedIn'=> true
                ];

                // Jika perannya warga, ambil juga id_warga dari tabel warga
                if ($user['role'] === 'warga') {
                    $wargaModel = new \App\Models\WargaModel();
                    $warga = $wargaModel->where('id_user', $user['id_user'])->first();
                    
                    if ($warga) {
                        $sessionData['id_warga'] = $warga['id_warga'];
                        $sessionData['user_sub'] = "Warga (Tabungan Qurban)";
                    } else {
                        return redirect()->to('/login')->with('errorMsg', 'Data profil warga tidak ditemukan.');
                    }
                } elseif ($user['role'] === 'admin') {
                    $sessionData['user_sub'] = "Administrator";
                }

                // Set session dan arahkan ke dashboard masing-masing
                $session->set($sessionData);

                if ($user['role'] === 'admin') {
                    return redirect()->to('/admin');
                } else {
                    return redirect()->to('/warga');
                }
            } else {
                return redirect()->to('/login')->with('errorMsg', 'Kata sandi yang Anda masukkan salah.');
            }
        } else {
            return redirect()->to('/login')->with('errorMsg', 'Username tidak terdaftar di sistem.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
