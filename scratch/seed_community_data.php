<?php
// Seed script for populating realistic community data
$mysqli = new mysqli("127.0.0.1", "root", "", "at_taqwa_ci4", 3306);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error . "\n");
}

echo "Connected to database...\n";

// Keep admin (id_user = 1)
$defaultPass = password_hash("warga123", PASSWORD_BCRYPT);
$adminPass = password_hash("admin123", PASSWORD_BCRYPT);

// Clear current non-admin data to build a clean, cohesive community dataset
$mysqli->query("SET FOREIGN_KEY_CHECKS = 0;");
$mysqli->query("TRUNCATE TABLE setoran;");
$mysqli->query("TRUNCATE TABLE notifikasi;");
$mysqli->query("TRUNCATE TABLE warga;");
$mysqli->query("DELETE FROM users WHERE id_user > 1;");
$mysqli->query("ALTER TABLE users AUTO_INCREMENT = 2;");
$mysqli->query("UPDATE users SET password = '$adminPass', nama_lengkap = 'Pak Fauzan' WHERE id_user = 1;");
$mysqli->query("SET FOREIGN_KEY_CHECKS = 1;");

echo "Cleaned existing mock data, preparing 26 warga profiles...\n";

$residents = [
    [
        'username' => 'warga',
        'nama' => "Ahmad Syafi'i",
        'phone' => '081234567890',
        'rt' => 'RT 04',
        'jenis' => 'Sapi Kolektif',
        'target' => 3500000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-04-12', 'nom' => 350000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran awal April'],
            ['tgl' => '2026-05-10', 'nom' => 350000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran rutin Mei'],
            ['tgl' => '2026-06-11', 'nom' => 350000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran rutin Juni'],
            ['tgl' => '2026-07-09', 'nom' => 350000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran rutin Juli'],
            ['tgl' => '2026-08-10', 'nom' => 350000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran rutin Agustus'],
            ['tgl' => '2026-09-08', 'nom' => 350000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran rutin September'],
        ]
    ],
    [
        'username' => 'rahmat',
        'nama' => 'H. Rahmat Hidayat',
        'phone' => '081298765432',
        'rt' => 'RT 01',
        'jenis' => 'Sapi Utuh',
        'target' => 25000000,
        'status' => 'Lunas',
        'setorans' => [
            ['tgl' => '2026-04-05', 'nom' => 5000000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran pembuka April'],
            ['tgl' => '2026-05-02', 'nom' => 5000000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Mei'],
            ['tgl' => '2026-06-03', 'nom' => 5000000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juni'],
            ['tgl' => '2026-07-04', 'nom' => 5000000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juli'],
            ['tgl' => '2026-08-01', 'nom' => 5000000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Pelunasan Agustus']
        ]
    ],
    [
        'username' => 'nurul',
        'nama' => 'Hj. Nurul Hidayati',
        'phone' => '081345678901',
        'rt' => 'RT 02',
        'jenis' => 'Kambing',
        'target' => 3500000,
        'status' => 'Lunas',
        'setorans' => [
            ['tgl' => '2026-04-15', 'nom' => 1000000, 'metode' => 'Tunai ke Pengurus', 'status' => 'Berhasil', 'ket' => 'Setoran April'],
            ['tgl' => '2026-05-18', 'nom' => 1000000, 'metode' => 'Tunai ke Pengurus', 'status' => 'Berhasil', 'ket' => 'Setoran Mei'],
            ['tgl' => '2026-06-15', 'nom' => 1000000, 'metode' => 'Tunai ke Pengurus', 'status' => 'Berhasil', 'ket' => 'Setoran Juni'],
            ['tgl' => '2026-07-20', 'nom' => 500000, 'metode' => 'Tunai ke Pengurus', 'status' => 'Berhasil', 'ket' => 'Pelunasan Juli']
        ]
    ],
    [
        'username' => 'bambang',
        'nama' => 'Bambang Pratama',
        'phone' => '081223344556',
        'rt' => 'RT 03',
        'jenis' => 'Sapi Kolektif',
        'target' => 3500000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-04-20', 'nom' => 700000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran awal'],
            ['tgl' => '2026-05-20', 'nom' => 700000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Mei'],
            ['tgl' => '2026-06-20', 'nom' => 700000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juni'],
            ['tgl' => '2026-07-20', 'nom' => 700000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juli'],
        ]
    ],
    [
        'username' => 'hendra',
        'nama' => 'Hendra Kurniawan',
        'phone' => '081334455667',
        'rt' => 'RT 04',
        'jenis' => 'Sapi Kolektif',
        'target' => 3500000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-04-14', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran April'],
            ['tgl' => '2026-05-14', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Mei'],
            ['tgl' => '2026-06-14', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juni'],
            ['tgl' => '2026-07-14', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juli'],
        ]
    ],
    [
        'username' => 'dewi',
        'nama' => 'Dewi Lestari',
        'phone' => '081445566778',
        'rt' => 'RT 01',
        'jenis' => 'Kambing',
        'target' => 3000000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-05-05', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Tabungan Mei'],
            ['tgl' => '2026-06-05', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Tabungan Juni'],
            ['tgl' => '2026-07-05', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Tabungan Juli'],
            ['tgl' => '2026-08-05', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Tabungan Agustus'],
            ['tgl' => '2026-09-05', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Tabungan September'],
        ]
    ],
    [
        'username' => 'ridwan',
        'nama' => 'Muhammad Ridwan',
        'phone' => '081556677889',
        'rt' => 'RT 02',
        'jenis' => 'Kambing',
        'target' => 3500000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-04-25', 'nom' => 600000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 1'],
            ['tgl' => '2026-05-25', 'nom' => 600000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 2'],
            ['tgl' => '2026-06-25', 'nom' => 600000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 3'],
            ['tgl' => '2026-07-25', 'nom' => 600000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 4'],
            ['tgl' => '2026-08-25', 'nom' => 600000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 5'],
        ]
    ],
    [
        'username' => 'eko',
        'nama' => 'Eko Wahyudi',
        'phone' => '081667788990',
        'rt' => 'RT 03',
        'jenis' => 'Sapi Kolektif',
        'target' => 3500000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-05-12', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Mei'],
            ['tgl' => '2026-06-12', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juni'],
            ['tgl' => '2026-07-12', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juli'],
            ['tgl' => '2026-09-09', 'nom' => 350000, 'metode' => 'Transfer BSI', 'status' => 'Pending', 'ket' => 'Setoran rutin September'],
        ]
    ],
    [
        'username' => 'sri',
        'nama' => 'Sri Wahyuni',
        'phone' => '081778899001',
        'rt' => 'RT 05',
        'jenis' => 'Kambing',
        'target' => 3000000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-06-10', 'nom' => 500000, 'metode' => 'Tunai ke Pengurus', 'status' => 'Berhasil', 'ket' => 'Setoran Juni'],
            ['tgl' => '2026-07-10', 'nom' => 500000, 'metode' => 'Tunai ke Pengurus', 'status' => 'Berhasil', 'ket' => 'Setoran Juli'],
            ['tgl' => '2026-08-10', 'nom' => 500000, 'metode' => 'Tunai ke Pengurus', 'status' => 'Berhasil', 'ket' => 'Setoran Agustus'],
        ]
    ],
    [
        'username' => 'agus',
        'nama' => 'Agus Supriyadi',
        'phone' => '081889900112',
        'rt' => 'RT 04',
        'jenis' => 'Sapi Kolektif',
        'target' => 3500000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-05-15', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 1'],
            ['tgl' => '2026-06-15', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 2'],
            ['tgl' => '2026-07-15', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 3'],
        ]
    ],
    [
        'username' => 'handoko',
        'nama' => 'Tri Handoko',
        'phone' => '081990011223',
        'rt' => 'RT 02',
        'jenis' => 'Sapi Kolektif',
        'target' => 3500000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-06-08', 'nom' => 350000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juni'],
            ['tgl' => '2026-07-08', 'nom' => 350000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juli'],
            ['tgl' => '2026-08-08', 'nom' => 350000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Agustus'],
        ]
    ],
    [
        'username' => 'rina',
        'nama' => 'Rina Kusuma',
        'phone' => '081112233445',
        'rt' => 'RT 06',
        'jenis' => 'Kambing',
        'target' => 3000000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-07-12', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juli'],
            ['tgl' => '2026-08-12', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Agustus'],
        ]
    ],
    [
        'username' => 'dedi',
        'nama' => 'Dedi Supriadi',
        'phone' => '081223344550',
        'rt' => 'RT 03',
        'jenis' => 'Kambing',
        'target' => 3500000,
        'status' => 'Perlu diingatkan',
        'setorans' => [
            ['tgl' => '2026-04-18', 'nom' => 500000, 'metode' => 'Tunai ke Pengurus', 'status' => 'Berhasil', 'ket' => 'Setoran awal April']
        ]
    ],
    [
        'username' => 'maya',
        'nama' => 'Maya Anggraini',
        'phone' => '081334455661',
        'rt' => 'RT 05',
        'jenis' => 'Kambing',
        'target' => 3000000,
        'status' => 'Perlu diingatkan',
        'setorans' => [
            ['tgl' => '2026-05-02', 'nom' => 400000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran awal Mei']
        ]
    ],
    [
        'username' => 'fajar',
        'nama' => 'Fajar Nugroho',
        'phone' => '081445566772',
        'rt' => 'RT 02',
        'jenis' => 'Sapi Kolektif',
        'target' => 3500000,
        'status' => 'Perlu diingatkan',
        'setorans' => [
            ['tgl' => '2026-05-19', 'nom' => 350000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran awal Mei']
        ]
    ],
    [
        'username' => 'yuni',
        'nama' => 'Yuni Astuti',
        'phone' => '081556677883',
        'rt' => 'RT 06',
        'jenis' => 'Kambing',
        'target' => 3000000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-05-22', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Mei'],
            ['tgl' => '2026-06-22', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juni'],
            ['tgl' => '2026-07-22', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juli'],
            ['tgl' => '2026-08-22', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Agustus'],
        ]
    ],
    [
        'username' => 'arif',
        'nama' => 'Arif Wibowo',
        'phone' => '081667788994',
        'rt' => 'RT 04',
        'jenis' => 'Sapi Kolektif',
        'target' => 3500000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-04-28', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran April'],
            ['tgl' => '2026-05-28', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Mei'],
            ['tgl' => '2026-06-28', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juni'],
            ['tgl' => '2026-07-28', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juli'],
            ['tgl' => '2026-09-10', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Pending', 'ket' => 'Setoran September'],
        ]
    ],
    [
        'username' => 'fitri',
        'nama' => 'Fitri Rahmawati',
        'phone' => '081778899005',
        'rt' => 'RT 01',
        'jenis' => 'Kambing',
        'target' => 3500000,
        'status' => 'Lunas',
        'setorans' => [
            ['tgl' => '2026-04-10', 'nom' => 1000000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 1'],
            ['tgl' => '2026-05-10', 'nom' => 1000000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 2'],
            ['tgl' => '2026-06-10', 'nom' => 1000000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 3'],
            ['tgl' => '2026-07-10', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Pelunasan'],
        ]
    ],
    [
        'username' => 'danang',
        'nama' => 'Danang Prasetyo',
        'phone' => '081889900116',
        'rt' => 'RT 03',
        'jenis' => 'Sapi Kolektif',
        'target' => 3500000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-04-17', 'nom' => 700000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 1'],
            ['tgl' => '2026-05-17', 'nom' => 700000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 2'],
            ['tgl' => '2026-06-17', 'nom' => 700000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 3'],
            ['tgl' => '2026-07-17', 'nom' => 700000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 4'],
            ['tgl' => '2026-09-10', 'nom' => 350000, 'metode' => 'Transfer BSI', 'status' => 'Pending', 'ket' => 'Setoran rutin September'],
        ]
    ],
    [
        'username' => 'indah',
        'nama' => 'Indah Permatasari',
        'phone' => '081990011227',
        'rt' => 'RT 05',
        'jenis' => 'Kambing',
        'target' => 3000000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-05-04', 'nom' => 600000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Tabungan Mei'],
            ['tgl' => '2026-06-04', 'nom' => 600000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Tabungan Juni'],
            ['tgl' => '2026-07-04', 'nom' => 600000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Tabungan Juli'],
            ['tgl' => '2026-09-09', 'nom' => 300000, 'metode' => 'Tunai ke Pengurus', 'status' => 'Pending', 'ket' => 'Setoran tunai September'],
        ]
    ],
    [
        'username' => 'slamet',
        'nama' => 'Slamet Riyadi',
        'phone' => '081112233448',
        'rt' => 'RT 02',
        'jenis' => 'Sapi Utuh',
        'target' => 25000000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-04-02', 'nom' => 3500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 1'],
            ['tgl' => '2026-05-02', 'nom' => 3500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 2'],
            ['tgl' => '2026-06-02', 'nom' => 3500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 3'],
            ['tgl' => '2026-07-02', 'nom' => 3500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 4'],
            ['tgl' => '2026-08-02', 'nom' => 3500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 5'],
        ]
    ],
    [
        'username' => 'anisa',
        'nama' => 'Anisa Putri',
        'phone' => '081223344559',
        'rt' => 'RT 04',
        'jenis' => 'Kambing',
        'target' => 3500000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-05-16', 'nom' => 700000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Mei'],
            ['tgl' => '2026-06-16', 'nom' => 700000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juni'],
            ['tgl' => '2026-07-16', 'nom' => 700000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juli'],
        ]
    ],
    [
        'username' => 'suryono',
        'nama' => 'Suryono',
        'phone' => '081334455660',
        'rt' => 'RT 06',
        'jenis' => 'Sapi Kolektif',
        'target' => 3500000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-06-07', 'nom' => 700000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juni'],
            ['tgl' => '2026-07-07', 'nom' => 700000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juli'],
        ]
    ],
    [
        'username' => 'ratna',
        'nama' => 'Ratna Sari',
        'phone' => '081445566771',
        'rt' => 'RT 01',
        'jenis' => 'Kambing',
        'target' => 3000000,
        'status' => 'Aktif',
        'setorans' => [
            ['tgl' => '2026-06-18', 'nom' => 300000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 1'],
            ['tgl' => '2026-07-18', 'nom' => 300000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 2'],
            ['tgl' => '2026-08-18', 'nom' => 300000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran 3'],
        ]
    ],
    [
        'username' => 'teguh',
        'nama' => 'Teguh Iman',
        'phone' => '081556677882',
        'rt' => 'RT 03',
        'jenis' => 'Sapi Kolektif',
        'target' => 3500000,
        'status' => 'Lunas',
        'setorans' => [
            ['tgl' => '2026-04-14', 'nom' => 1000000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran April'],
            ['tgl' => '2026-05-14', 'nom' => 1000000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Mei'],
            ['tgl' => '2026-06-14', 'nom' => 1000000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Setoran Juni'],
            ['tgl' => '2026-07-14', 'nom' => 500000, 'metode' => 'Transfer BSI', 'status' => 'Berhasil', 'ket' => 'Pelunasan Juli'],
        ]
    ]
];

$trxCounter = 1001;

foreach ($residents as $r) {
    // 1. Insert User
    $uStmt = $mysqli->prepare("INSERT INTO users (username, password, nama_lengkap, role, created_at) VALUES (?, ?, ?, 'warga', NOW())");
    $uStmt->bind_param("sss", $r['username'], $defaultPass, $r['nama']);
    $uStmt->execute();
    $id_user = $mysqli->insert_id;

    // Calculate total verified saldo
    $saldo = 0;
    foreach ($r['setorans'] as $s) {
        if ($s['status'] === 'Berhasil') {
            $saldo += $s['nom'];
        }
    }

    // Determine status: if saldo >= target => Lunas
    $status = $r['status'];
    if ($saldo >= $r['target']) {
        $status = 'Lunas';
    }

    // 2. Insert Warga
    $wStmt = $mysqli->prepare("INSERT INTO warga (id_user, no_hp, rt_rw, saldo_tabungan, target_qurban, jenis_qurban, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $wStmt->bind_param("issddss", $id_user, $r['phone'], $r['rt'], $saldo, $r['target'], $r['jenis'], $status);
    $wStmt->execute();
    $id_warga = $mysqli->insert_id;

    // 3. Insert Setoran
    foreach ($r['setorans'] as $s) {
        $dateParts = explode('-', $s['tgl']);
        $trxCode = 'TRX-' . substr($dateParts[0], 2) . $dateParts[1] . $trxCounter++;
        $createdAt = $s['tgl'] . ' ' . sprintf('%02d:%02d:%02d', rand(8, 17), rand(10, 59), rand(10, 59));

        $sStmt = $mysqli->prepare("INSERT INTO setoran (id_warga, kode_trx, tanggal, keterangan, metode, nominal, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $sStmt->bind_param("issssiss", $id_warga, $trxCode, $s['tgl'], $s['ket'], $s['metode'], $s['nom'], $s['status'], $createdAt);
        $sStmt->execute();
    }

    // 4. Insert sample Notification
    $msg = ($status === 'Lunas') 
        ? "Alhamdulillah tabungan qurban Anda telah mencapai target (Lunas). Semoga berkah!" 
        : "Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.";
    $nStmt = $mysqli->prepare("INSERT INTO notifikasi (id_user, pesan, is_read, link_to, created_at) VALUES (?, ?, 0, 'warga/history', NOW())");
    $nStmt->bind_param("is", $id_user, $msg);
    $nStmt->execute();
}

echo "Seeded successfully! Total warga: " . count($residents) . "\n";

// Print summary
$wCount = $mysqli->query("SELECT COUNT(*) as c, SUM(saldo_tabungan) as s FROM warga")->fetch_assoc();
$sCount = $mysqli->query("SELECT COUNT(*) as c, SUM(nominal) as n FROM setoran WHERE status = 'Berhasil'")->fetch_assoc();
$pCount = $mysqli->query("SELECT COUNT(*) as c FROM setoran WHERE status = 'Pending'")->fetch_assoc();

echo "Total Warga: " . $wCount['c'] . "\n";
echo "Total Saldo Warga: Rp" . number_format($wCount['s'], 0, ',', '.') . "\n";
echo "Total Setoran Berhasil: " . $sCount['c'] . " (Rp" . number_format($sCount['n'], 0, ',', '.') . ")\n";
echo "Total Setoran Menunggu Verifikasi (Pending): " . $pCount['c'] . "\n";
