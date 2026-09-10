<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        // 1. Total Dana Masuk (Total Tabungan)
        $resMasuk = $db->table('setoran')
                       ->selectSum('nominal', 'total')
                       ->where('status', 'Berhasil')
                       ->get()->getRowArray();
        $totalDanaMasuk = $resMasuk['total'] ?? 0;

        // 2. Jumlah Warga (Aktif & Lunas) & Total Target
        $resWarga = $db->table('warga')
                       ->selectCount('id_warga', 'jml_warga')
                       ->selectSum('target_qurban', 'total_target')
                       ->whereIn('status', ['Aktif', 'Lunas'])
                       ->get()->getRowArray();
        $jmlWarga = $resWarga['jml_warga'] ?? 0;
        $totalTarget = $resWarga['total_target'] ?? 0;

        // 3. Estimasi Target Tercapai (Bulan)
        $resBulan = $db->query("SELECT SUM(nominal) as total_bln FROM setoran WHERE status = 'Berhasil' GROUP BY DATE_FORMAT(tanggal, '%Y-%m')")->getResultArray();
        $avgGlobalPerBulan = 0;
        if(count($resBulan) > 0) {
            $sum = 0;
            foreach($resBulan as $b) { $sum += $b['total_bln']; }
            $avgGlobalPerBulan = $sum / count($resBulan);
        }

        $kekurangan = max(0, $totalTarget - $totalDanaMasuk);
        $estimasiBulanStr = "-";
        
        if ($kekurangan > 0 && $avgGlobalPerBulan > 0) {
            $monthsNeeded = ceil($kekurangan / $avgGlobalPerBulan);
            $estimasiBulanStr = date('M Y', strtotime("+$monthsNeeded months"));
            $indoMonths = ['Jan' => 'Jan', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Apr', 'May' => 'Mei', 'Jun' => 'Jun', 'Jul' => 'Jul', 'Aug' => 'Ags', 'Sep' => 'Sep', 'Oct' => 'Okt', 'Nov' => 'Nov', 'Dec' => 'Des'];
            foreach ($indoMonths as $eng => $ind) {
                if (strpos($estimasiBulanStr, $eng) !== false) {
                    $estimasiBulanStr = str_replace($eng, $ind, $estimasiBulanStr);
                    break;
                }
            }
        } elseif ($kekurangan <= 0 && $totalTarget > 0) {
            $estimasiBulanStr = "Tercapai";
        }

        $data = [
            'pageTitle' => "AT-TAQWA — Tabungan Qurban Warga",
            'totalDanaMasuk' => $totalDanaMasuk,
            'jmlWarga' => $jmlWarga,
            'estimasiBulanStr' => $estimasiBulanStr
        ];

        return view('landing', $data);
    }
}
