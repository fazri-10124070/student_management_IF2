# student_management_IF2
Aplikasi Sistem Informasi Mahasiswa 

Aplikasi berbasis web untuk mengelola data mahasiswa yang dikembangkan menggunakan PHP Native dan MySQL/MariaDB.

## Deskripsi Proyek

Student Information System merupakan aplikasi sederhana yang membantu administrator mengelola data mahasiswa melalui antarmuka berbasis web. Aplikasi ini dibuat sebagai bagian dari tugas mata kuliah Penerapan Teknologi Internet.

## Fitur Utama

- Login administrator.
- Dashboard administrator.
- Menampilkan daftar mahasiswa.
- Menambahkan data mahasiswa.
- Mengubah data mahasiswa.
- Menghapus data mahasiswa.
- Validasi input dan pemeriksaan format email.
- Koneksi database menggunakan PDO.
- Pengamanan akses halaman menggunakan session.
- Antarmuka dalam bahasa Indonesia dan Inggris.

## Teknologi yang Digunakan

- PHP Native
- MySQL/MariaDB
- HTML
- CSS
- PDO
- Session

## Persyaratan Sistem

- PHP yang mendukung PDO MySQL.
- MySQL atau MariaDB.
- Web server Apache.
- Laragon atau lingkungan server lokal sejenis.
- Browser web.

## Cara Menjalankan Aplikasi

1. Instal dan jalankan Laragon.
2. Salin folder proyek ke direktori `www` Laragon.
3. Buat database dengan nama `db_mahasiswa` melalui phpMyAdmin atau HeidiSQL.
4. Impor file `db_mahasiswa.sql` ke database tersebut.
5. Periksa konfigurasi koneksi database pada `config/database.php` dan sesuaikan dengan lingkungan lokal.
6. Jalankan Apache dan MySQL/MariaDB.
7. Buka aplikasi melalui browser menggunakan alamat `http://localhost/student_management/login.php`.

## Struktur Proyek

```text
student_management/
├── config/
│   └── database.php
├── includes/
│   ├── auth.php
│   └── language.php
├── mahasiswa/
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
├── admin.php
├── login.php
├── logout.php
├── db_mahasiswa.sql
├── README.md
└── laporan.pdf
```

*Catatan: Nama dan lokasi file pada struktur di atas perlu disesuaikan jika berbeda dengan struktur proyek sebenarnya.*

## Database

Database aplikasi bernama `db_mahasiswa` dan digunakan untuk menyimpan data administrator serta data mahasiswa.

File ekspor database disediakan dalam format SQL agar struktur tabel dan data yang diperlukan dapat diimpor ke lingkungan MySQL/MariaDB.

## Dokumentasi

Dokumentasi dan penjelasan alur kerja aplikasi tersedia dalam laporan PDF yang disertakan dalam repository.

## Tujuan

Proyek ini bertujuan menerapkan konsep pengembangan aplikasi web menggunakan PHP Native dan MySQL/MariaDB, termasuk autentikasi, pengelolaan data, validasi input, dan penggunaan session.
