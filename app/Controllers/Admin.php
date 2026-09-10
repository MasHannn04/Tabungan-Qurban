<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        // 1. Total dana terkumpul (saldo_tabungan di tabel warga)
        $totalDana = $db->table('warga')->selectSum('saldo_tabungan')->get()->getRow()->saldo_tabungan ?? 0;
        
        // 2. Warga terdaftar & aktif
        $wargaStat = $db->query("SELECT COUNT(*) as total, SUM(IF(status='Aktif', 1, 0)) as aktif FROM warga")->getRow();
        $totalWarga = $wargaStat->total ?? 0;
        
        // 3. Menunggu verifikasi
        $pending = $db->table('setoran')->where('status', 'Pending')->countAllResults();

        // 4. Data untuk tabel riwayat verifikasi (5 terbaru)
        $verifications = $db->table('setoran s')
                            ->select('s.id_setoran, s.nominal, s.tanggal, s.created_at, s.metode, u.nama_lengkap')
                            ->join('warga w', 's.id_warga = w.id_warga')
                            ->join('users u', 'w.id_user = u.id_user')
                            ->where('s.status', 'Pending')
                            ->orderBy('s.created_at', 'DESC')
                            ->limit(5)
                            ->get()->getResultArray();

        // 5. Chart Data (Perkembangan Dana 6 bulan terakhir)
        $chartData = [];
        $currentMonth = (int)date('n');
        $currentYear = (int)date('Y');
        $monthsIndo = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 
                       7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'];

        $last6Months = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = $currentMonth - $i;
            $y = $currentYear;
            if ($m <= 0) {
                $m += 12;
                $y -= 1;
            }
            $last6Months[] = ['month' => $m, 'year' => $y, 'label' => $monthsIndo[$m], 'cumulative' => 0];
        }

        $startDate = sprintf('%04d-%02d-01', $last6Months[0]['year'], $last6Months[0]['month']);

        $baseCumulative = $db->table('setoran')
                             ->selectSum('nominal')
                             ->where('status', 'Berhasil')
                             ->where('tanggal <', $startDate)
                             ->get()->getRow()->nominal ?? 0;

        $resMonthly = $db->query("SELECT YEAR(tanggal) as y, MONTH(tanggal) as m, SUM(nominal) as total FROM setoran WHERE status = 'Berhasil' AND tanggal >= '$startDate' GROUP BY YEAR(tanggal), MONTH(tanggal)")->getResultArray();
        
        $monthlySums = [];
        foreach ($resMonthly as $row) {
            $monthlySums[$row['y'] . '-' . $row['m']] = $row['total'];
        }

        $runningTotal = $baseCumulative;
        $maxTotal = 0;

        foreach ($last6Months as &$m) {
            $key = $m['year'] . '-' . $m['month'];
            if (isset($monthlySums[$key])) {
                $runningTotal += $monthlySums[$key];
            }
            $m['cumulative'] = $runningTotal;
            if ($runningTotal > $maxTotal) {
                $maxTotal = $runningTotal;
            }
        }
        if ($maxTotal == 0) $maxTotal = 1;

        foreach ($last6Months as &$m) {
            $percent = round(($m['cumulative'] / $maxTotal) * 100);
            $m['percent'] = max(10, $percent); 
            
            if ($m['cumulative'] >= 1000000) {
                $formatted = str_replace('.0', '', number_format($m['cumulative'] / 1000000, 1, ',', '.')) . 'jt';
            } elseif ($m['cumulative'] >= 1000) {
                $formatted = round($m['cumulative'] / 1000) . 'rb';
            } else {
                $formatted = $m['cumulative'];
            }
            $m['formatted'] = $formatted;
        }

        $data = [
            'pageTitle' => "AT-TAQWA | Panel Pengurus",
            'totalDana' => $totalDana,
            'totalWarga' => $totalWarga,
            'wargaAktif'=> $wargaStat->aktif ?? 0, // Ditambahkan
            'lunas'     => $db->table('warga')->where('status', 'Lunas')->countAllResults(), // Ditambahkan
            'persenLunas' => ($totalWarga > 0) ? round(($db->table('warga')->where('status', 'Lunas')->countAllResults() / $totalWarga) * 100) : 0,
            'pending' => $pending,
            'chartData' => $last6Months,
            'verifications' => $verifications
        ];

        return view('admin_home', $data);
    }

    public function members()
    {
        $db = \Config\Database::connect();
        
        $q = $this->request->getGet('q') ?? '';
        $status = $this->request->getGet('status') ?? 'semua';

        $builder = $db->table('warga w')
                      ->select('w.*, u.nama_lengkap')
                      ->join('users u', 'w.id_user = u.id_user');

        if ($status === 'aktif') {
            $builder->where('w.status', 'Aktif');
        } elseif ($status === 'lunas') {
            $builder->where('w.status', 'Lunas');
        } elseif ($status === 'perlu_diingatkan') {
            $builder->where('w.status', 'Perlu diingatkan');
        }

        if (!empty($q)) {
            $builder->groupStart()
                    ->like('u.nama_lengkap', $q)
                    ->orLike('w.no_hp', $q)
                    ->groupEnd();
        }

        $builder->orderBy('u.nama_lengkap', 'ASC');
        
        $members = $builder->get()->getResultArray();

        $data = [
            'pageTitle' => "AT-TAQWA | Data Warga",
            'members' => $members,
            'q' => $q,
            'status' => $status
        ];

        return view('admin_members', $data);
    }

    public function addMember()
    {
        $data = ['pageTitle' => "AT-TAQWA | Tambah Warga"];

        if ($this->request->getMethod() === 'POST' || $this->request->getMethod() === 'post') {
            $nama_lengkap = trim($this->request->getPost('nama_lengkap') ?? '');
            $no_hp = trim($this->request->getPost('no_hp') ?? '');
            $rt_rw = trim($this->request->getPost('rt_rw') ?? '');
            $jenis_qurban = trim($this->request->getPost('jenis_qurban') ?? '');
            $target_qurban = str_replace(['.', ','], '', $this->request->getPost('target_qurban') ?? '0');

            if (empty($nama_lengkap) || empty($no_hp) || empty($rt_rw) || empty($jenis_qurban) || empty($target_qurban)) {
                $data['errorMsg'] = "Semua kolom harus diisi!";
            } else {
                $db = \Config\Database::connect();
                
                // Generate Username from first name
                $nameParts = explode(' ', strtolower($nama_lengkap));
                $baseUsername = preg_replace('/[^a-z0-9]/', '', $nameParts[0]);
                if (empty($baseUsername)) $baseUsername = 'warga';
                
                $username = $baseUsername;
                $counter = 1;
                
                // Ensure username uniqueness
                while (true) {
                    $chk = $db->table('users')->where('username', $username)->countAllResults();
                    if ($chk == 0) break;
                    $username = $baseUsername . $counter;
                    $counter++;
                }
                
                // Password is username + 123
                $password = password_hash($username . '123', PASSWORD_DEFAULT);
                
                $db->transStart();
                
                // 1. Insert User
                $db->table('users')->insert([
                    'username' => $username,
                    'password' => $password,
                    'nama_lengkap' => $nama_lengkap,
                    'role' => 'warga'
                ]);
                $id_user = $db->insertID();
                
                // 2. Insert Warga
                $db->table('warga')->insert([
                    'id_user' => $id_user,
                    'no_hp' => $no_hp,
                    'rt_rw' => $rt_rw,
                    'saldo_tabungan' => 0,
                    'target_qurban' => $target_qurban,
                    'jenis_qurban' => $jenis_qurban,
                    'status' => 'Aktif'
                ]);
                
                $db->transComplete();
                
                if ($db->transStatus() === FALSE) {
                    $data['errorMsg'] = "Terjadi kesalahan saat menyimpan ke database.";
                } else {
                    return redirect()->to('/admin/members');
                }
            }
        }

        return view('admin_add_warga', $data);
    }

    public function verifikasi()
    {
        $db = \Config\Database::connect();
        $action = $this->request->getPost('action');
        $id_setoran = (int)$this->request->getPost('id_setoran');

        if (!$id_setoran || !$action) {
            return redirect()->to('/admin')->with('errorMsg', 'Data tidak valid.');
        }

        // Get setoran details
        $setoran = $db->table('setoran s')
                      ->select('s.id_warga, s.nominal, s.status, w.id_user, w.saldo_tabungan, w.target_qurban, w.status as w_status')
                      ->join('warga w', 's.id_warga = w.id_warga')
                      ->where('s.id_setoran', $id_setoran)
                      ->get()->getRowArray();

        if ($setoran && $setoran['status'] === 'Pending') {
            $id_warga = $setoran['id_warga'];
            $nominal = $setoran['nominal'];
            $id_user = $setoran['id_user'];

            if ($action === 'verify') {
                // 1. Update setoran
                $db->table('setoran')->where('id_setoran', $id_setoran)->update(['status' => 'Berhasil']);
                
                // 2. Tambah saldo
                $db->query("UPDATE warga SET saldo_tabungan = saldo_tabungan + ? WHERE id_warga = ?", [$nominal, $id_warga]);
                
                // Notifikasi sukses
                $pesanSukses = "Alhamdulillah, setoran Rp" . number_format($nominal, 0, ',', '.') . " Anda telah diverifikasi oleh Admin.";
                $db->table('notifikasi')->insert(['id_user' => $id_user, 'pesan' => $pesanSukses, 'link_to' => 'warga/history']);
                
                // 3. Cek Lunas
                $newSaldo = $setoran['saldo_tabungan'] + $nominal;
                if ($newSaldo >= $setoran['target_qurban'] && $setoran['w_status'] === 'Aktif') {
                    $db->table('warga')->where('id_warga', $id_warga)->update(['status' => 'Lunas']);
                    
                    $pesanLunas = "Masyaallah! Tabungan Qurban Anda telah mencapai 100% (Lunas). Semoga berkah.";
                    $db->table('notifikasi')->insert(['id_user' => $id_user, 'pesan' => $pesanLunas, 'link_to' => 'warga']);
                    
                    $adminId = 1; // ID admin
                    $pesanAdmin = "Alhamdulillah, seorang warga telah melunasi target tabungannya.";
                    $db->table('notifikasi')->insert(['id_user' => $adminId, 'pesan' => $pesanAdmin, 'link_to' => 'admin/members']);
                }
            } elseif ($action === 'reject') {
                $db->table('setoran')->where('id_setoran', $id_setoran)->update(['status' => 'Ditolak']);
                
                $pesanTolak = "Mohon maaf, setoran Rp" . number_format($nominal, 0, ',', '.') . " Anda ditolak karena belum terdeteksi di mutasi rekening. Silakan cek kembali.";
                $db->table('notifikasi')->insert(['id_user' => $id_user, 'pesan' => $pesanTolak, 'link_to' => 'warga/history']);
            }
        }

        return redirect()->to('/admin');
    }
    public function report()
    {
        $db = \Config\Database::connect();
        
        // 1. Dana masuk (total setoran berhasil)
        $resMasuk = $db->table('setoran')
                       ->selectSum('nominal', 'total')
                       ->selectCount('id_setoran', 'jml')
                       ->where('status', 'Berhasil')
                       ->get()->getRowArray();
        $totalDanaMasuk = $resMasuk['total'] ?? 0;
        $totalTransaksi = $resMasuk['jml'] ?? 0;

        // 2. Estimasi Kebutuhan (total target qurban dari warga aktif & lunas)
        $resTarget = $db->table('warga')
                        ->selectSum('target_qurban', 'total_target')
                        ->selectCount('id_warga', 'jml_warga')
                        ->whereIn('status', ['Aktif', 'Lunas'])
                        ->get()->getRowArray();
        $totalTarget = $resTarget['total_target'] ?? 0;
        $totalWargaQurban = $resTarget['jml_warga'] ?? 0;

        $pencapaianPersen = ($totalTarget > 0) ? round(($totalDanaMasuk / $totalTarget) * 100, 1) : 0;

        // 3. Komposisi Dana
        $resKomposisi = $db->query("
            SELECT 
                SUM(IF(status='Aktif' OR status='Perlu diingatkan', saldo_tabungan, 0)) as dana_proses,
                SUM(IF(status='Lunas', saldo_tabungan, 0)) as dana_lunas
            FROM warga
        ")->getRowArray();
        
        $danaProses = $resKomposisi['dana_proses'] ?? 0;
        $danaLunas = $resKomposisi['dana_lunas'] ?? 0;
        $sisaTarget = max(0, $totalTarget - $totalDanaMasuk);

        // 4. Ringkasan Bulanan (Bulan ini)
        $bulanIni = date('Y-m');
        $resBulan = $db->query("SELECT SUM(nominal) as total, COUNT(id_setoran) as jml FROM setoran WHERE status = 'Berhasil' AND DATE_FORMAT(tanggal, '%Y-%m') = ?", [$bulanIni])->getRowArray();
        
        $totalBulanIni = $resBulan['total'] ?? 0;
        $transaksiBulanIni = $resBulan['jml'] ?? 0;
        $rataRataBulanIni = ($transaksiBulanIni > 0) ? round($totalBulanIni / $transaksiBulanIni) : 0;

        $wargaAktif = $db->table('warga')->where('status', 'Aktif')->countAllResults();

        $data = [
            'pageTitle' => "AT-TAQWA | Laporan Keuangan",
            'totalDanaMasuk' => $totalDanaMasuk,
            'totalTransaksi' => $totalTransaksi,
            'totalTarget' => $totalTarget,
            'totalWargaQurban' => $totalWargaQurban,
            'pencapaianPersen' => $pencapaianPersen,
            'danaProses' => $danaProses,
            'danaLunas' => $danaLunas,
            'sisaTarget' => $sisaTarget,
            'totalBulanIni' => $totalBulanIni,
            'transaksiBulanIni' => $transaksiBulanIni,
            'rataRataBulanIni' => $rataRataBulanIni,
            'wargaAktif' => $wargaAktif
        ];

        return view('admin_report', $data);
    }
}
