#############################
Aplikasi Pendaftaran Pasien RS
#############################

Aplikasi ini adalah sistem pendaftaran pasien Rumah Sakit berbasis web yang dibangun menggunakan CodeIgniter 3. Fitur utama meliputi manajemen data pasien, pendaftaran berobat online, manajemen poliklinik, dokter, serta dashboard statistik untuk admin.

************
Fitur Utama
************

- Registrasi akun pasien secara online
- Login multi-level (admin & pasien)
- Pendaftaran berobat secara online oleh pasien
- Manajemen data pasien, dokter, poliklinik, dan user oleh admin
- Persetujuan/penolakan pendaftaran oleh admin
- Riwayat pendaftaran pasien
- Export data pendaftaran ke CSV & PDF
- Dashboard statistik dan grafik pendaftaran
- Jadwal kunjungan pasien dalam tampilan kalender (FullCalendar)
- Validasi form dan notifikasi flash message

*******************
Struktur Direktori
*******************

- application/
    - controllers/
    - models/
    - views/
    - config/
    - libraries/
    - helpers/
- assets/
    - css/
    - js/
    - img/
    - vendor/
- system/
- index.php

************
Instalasi
************

1. Pastikan PHP 5.6+ dan MySQL/MariaDB sudah terpasang.
2. Clone/download repository ini ke folder web server Anda (misal: `htdocs/app_pendaftaranpasien_ci3`).
3. Import file `db_rs_ci3.sql` ke database MySQL Anda.
4. Atur konfigurasi database di `application/config/database.php`.
5. Jalankan aplikasi melalui browser: `http://localhost/app_pendaftaranpasien_ci3/`

*********
Akun Default
*********

- Admin
    - Username: admin
    - Password: password

*******
Lisensi
*******

Aplikasi ini menggunakan lisensi MIT, silakan lihat file [license.txt](d:/xampp74/htdocs/app_pendaftaranpasien_ci3/license.txt).

*********
Referensi
*********

- [CodeIgniter 3 User Guide](https://codeigniter.com/userguide3/)
- [FullCalendar](https://fullcalendar.io/)
- [Dompdf (PDF Export)](https://github.com/dompdf/dompdf)

***************
Kontribusi
***************

Silakan fork dan pull request untuk kontribusi pengembangan lebih lanjut.

***************
Tim Pengembang
***************

- [Nama Anda/Tim]
