# AT-TAQWA (Tabungan Qurban Warga)

**AT-TAQWA** adalah sebuah Sistem Informasi berbasis web untuk mengelola, mencatat, dan memantau program tabungan qurban warga secara transparan dan terencana. Aplikasi ini dibangun menggunakan framework **CodeIgniter 4**.

## Fitur Utama

- **Kalkulator Qurban**: Fitur simulasi bagi warga untuk merencanakan tabungan qurban (misal: Sapi Patungan, Kambing/Domba, Sapi Utuh) berdasarkan target waktu pencapaian.
- **Manajemen Warga**: Pendataan warga yang mengikuti program tabungan qurban.
- **Pencatatan Tabungan (Setoran)**: Pencatatan riwayat setoran tabungan secara berkala.
- **Dashboard Transparansi**: Menampilkan total warga terdaftar, total tabungan yang terkumpul, serta estimasi target pencapaian secara realtime.
- **Notifikasi/Riwayat**: Warga dapat melihat riwayat setoran tabungan mereka sendiri.

## Teknologi yang Digunakan

- **Backend**: CodeIgniter 4 (PHP 8.2+)
- **Database**: MySQL (`at_taqwa_ci4.sql` disertakan di dalam folder `app/Database/`)
- **Styling**: Native CSS

## Cara Instalasi di Localhost (XAMPP)

1. **Clone / Extract Folder:**
   Letakkan folder project ini di dalam direktori `htdocs` (jika menggunakan XAMPP) atau direktori root web server Anda.
   
2. **Import Database:**
   - Buat database baru di phpMyAdmin (misal: `at_taqwa_ci4`).
   - Import file database `app/Database/at_taqwa_ci4.sql` ke dalam database yang baru dibuat.

3. **Konfigurasi Environment:**
   - Ubah nama file `env` menjadi `.env`.
   - Buka file `.env` dan atur konfigurasi database Anda:
     ```env
     database.default.hostname = localhost
     database.default.database = at_taqwa_ci4
     database.default.username = root
     database.default.password = 
     database.default.DBDriver = MySQLi
     ```
   - Sesuaikan `app.baseURL` jika diperlukan.

4. **Jalankan Aplikasi:**
   Anda dapat mengaksesnya langsung melalui browser, atau menggunakan fitur serve dari CodeIgniter dengan menjalankan perintah di terminal:
   ```bash
   php spark serve
   ```
   Lalu buka `http://localhost:8080` di browser.

---
*Aplikasi ini dikembangkan untuk memfasilitasi niat baik warga dalam berqurban dengan cara yang lebih terencana, aman, dan barokah.*
