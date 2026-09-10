<?php

namespace App\Controllers;

class Warga extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $session = session();
        $id_warga = $session->get('id_warga') ?? 0;
        $id_user = $session->get('id_user') ?? 0;

        // 1. Ambil detail tabungan warga
        $saldo = 0;
        $target = 12500000;
        $jenis_qurban = "Sapi Kolektif";
        
        $warga = $db->table('warga')->where('id_warga', $id_warga)->get()->getRowArray();
        
        if ($warga) {
            $saldo = $warga['saldo_tabungan'];
            $target = $warga['target_qurban'];
            $jenis_qurban = $warga['jenis_qurban'];
            
            // Check monthly reminder
            $currMonth = date('Y-m');
            if ($warga['status'] === 'Aktif') {
                $notifCheck = $db->table('notifikasi')
                                 ->where('id_user', $id_user)
                                 ->like('pesan', 'Bulan baru telah tiba%', 'after')
                                 ->like('created_at', $currMonth, 'after')
                                 ->countAllResults();
                                 
                if ($notifCheck == 0) {
                    $pesanReminder = "Bulan baru telah tiba, mari rutinkan kembali tabungan qurban Anda!";
                    $db->table('notifikasi')->insert([
                        'id_user' => $id_user, 
                        'pesan' => $pesanReminder, 
                        'link_to' => 'warga/saving'
                    ]);
                }
            }
        }

        $persenTercapai = ($target > 0) ? min(100, round(($saldo / $target) * 100)) : 0;
        $kekurangan = max(0, $target - $saldo);

        // 2. Ambil setoran terakhir
        $lastSetoran = $db->table('setoran')
                          ->select('nominal, keterangan, tanggal, metode, status')
                          ->where('id_warga', $id_warga)
                          ->orderBy('tanggal', 'DESC')
                          ->orderBy('created_at', 'DESC')
                          ->get()->getRowArray();

        // 3. Mini stats (Averages and counts)
        $stats = $db->table('setoran')
                    ->selectAvg('nominal', 'avg_nom')
                    ->selectCount('id_setoran', 'total_setoran')
                    ->where('id_warga', $id_warga)
                    ->where('status', 'Berhasil')
                    ->get()->getRowArray();
                    
        $avgBulan = $stats['avg_nom'] ?? 0;
        $setoranCount = $stats['total_setoran'] ?? 0;

        // 4. Estimasi target tercapai
        $estimasiBulanStr = "-";
        if ($kekurangan > 0 && $avgBulan > 0) {
            $monthsNeeded = ceil($kekurangan / $avgBulan);
            $estimasiBulanStr = date('F Y', strtotime("+$monthsNeeded months"));
            $indoMonths = ['January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 'April' => 'April', 'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'];
            foreach ($indoMonths as $eng => $ind) {
                if (strpos($estimasiBulanStr, $eng) !== false) {
                    $estimasiBulanStr = str_replace($eng, $ind, $estimasiBulanStr);
                    break;
                }
            }
        } elseif ($kekurangan <= 0) {
            $estimasiBulanStr = "Tercapai";
        }

        // Ambil Notifikasi unread untuk Topbar
        $unreadCount = $db->table('notifikasi')->where('id_user', $id_user)->where('is_read', 0)->countAllResults();
        $notifs = $db->table('notifikasi')->where('id_user', $id_user)->orderBy('created_at', 'DESC')->limit(5)->get()->getResultArray();

        $data = [
            'pageTitle' => "AT-TAQWA | Tabungan Saya",
            'saldo' => $saldo,
            'target' => $target,
            'jenis_qurban' => $jenis_qurban,
            'persenTercapai' => $persenTercapai,
            'kekurangan' => $kekurangan,
            'lastSetoran' => $lastSetoran,
            'avgBulan' => $avgBulan,
            'setoranCount' => $setoranCount,
            'estimasiBulanStr' => $estimasiBulanStr,
            'unreadCount' => $unreadCount,
            'notifs' => $notifs
        ];

        return view('warga_home', $data);
    }

    public function saving()
    {
        $session = session();
        $id_warga = $session->get('id_warga');
        $id_user = $session->get('id_user');

        $wargaModel = new \App\Models\WargaModel();
        $warga = $wargaModel->find($id_warga);

        $notifModel = new \App\Models\NotifikasiModel();
        $unreadCount = $notifModel->where('id_user', $id_user)->where('is_read', 0)->countAllResults();
        $notifs = $notifModel->where('id_user', $id_user)->orderBy('created_at', 'DESC')->limit(5)->find();

        $data = [
            'pageTitle' => "AT-TAQWA | Tambah Setoran",
            'warga' => $warga,
            'unreadCount' => $unreadCount,
            'notifs' => $notifs,
            'errorMsg' => $session->getFlashdata('errorMsg'),
            'successMsg' => $session->getFlashdata('successMsg')
        ];

        return view('warga_saving', $data);
    }

    public function saveProcess()
    {
        $session = session();
        $id_warga = $session->get('id_warga');

        $nominal = $this->request->getPost('nominal');
        $metode = $this->request->getPost('metode');
        $keterangan = $this->request->getPost('keterangan');
        
        // Hapus semua karakter selain angka (menghindari error jika ada 'Rp' atau spasi)
        $nominal = preg_replace('/[^0-9]/', '', (string)$nominal);

        if (!is_numeric($nominal) || $nominal < 10000) {
            return redirect()->to('/warga/saving')->with('errorMsg', 'Nominal tidak valid. Minimal Rp10.000');
        }

        $setoranModel = new \App\Models\SetoranModel();
        $setoranModel->save([
            'id_warga' => $id_warga,
            'kode_trx' => 'TRX-' . date('ymdHis') . rand(10, 99),
            'nominal' => $nominal,
            'tanggal' => date('Y-m-d'),
            'metode' => $metode,
            'keterangan' => empty($keterangan) ? 'Setoran Tabungan Qurban' : $keterangan,
            'status' => 'Pending'
        ]);

        return redirect()->to('/warga/saving')->with('successMsg', 'Setoran berhasil dicatat dan sedang menunggu verifikasi Admin.');
    }

    public function history()
    {
        $session = session();
        $id_warga = $session->get('id_warga');
        $id_user = $session->get('id_user');

        $setoranModel = new \App\Models\SetoranModel();
        $history = $setoranModel->where('id_warga', $id_warga)
                                ->orderBy('tanggal', 'DESC')
                                ->orderBy('created_at', 'DESC')
                                ->findAll();

        $notifModel = new \App\Models\NotifikasiModel();
        $unreadCount = $notifModel->where('id_user', $id_user)->where('is_read', 0)->countAllResults();
        $notifs = $notifModel->where('id_user', $id_user)->orderBy('created_at', 'DESC')->limit(5)->find();

        $data = [
            'pageTitle' => "AT-TAQWA | Riwayat Setoran",
            'history' => $history,
            'unreadCount' => $unreadCount,
            'notifs' => $notifs
        ];

        return view('warga_history', $data);
    }
}
