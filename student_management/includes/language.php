<?php

// Memulai session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Menentukan bahasa yang tersedia
$available_languages = ['id', 'en'];

// Memproses pilihan bahasa dari pengguna
if (isset($_GET['lang'])) {
    $selected_language = $_GET['lang'];

    if (in_array($selected_language, $available_languages, true)) {
        $_SESSION['language'] = $selected_language;
    }
}

// Menentukan bahasa aktif
if (
    !isset($_SESSION['language']) ||
    !in_array($_SESSION['language'], $available_languages, true)
) {
    $_SESSION['language'] = 'id';
}

$lang = $_SESSION['language'];

// Daftar terjemahan
$translations = [

    'id' => [
        'system_name' => 'Sistem Informasi Mahasiswa',
        'system_description' => 'Pengelolaan Data Mahasiswa',
        'login_title' => 'Login Administrator',
        'username' => 'Username',
        'password' => 'Password',
        'login_button' => 'Masuk',
        'logout' => 'Logout',
        'dashboard' => 'Dashboard Administrator',
        'welcome' => 'Selamat Datang',
        'main_menu' => 'Menu Utama',
        'student_management' => 'Kelola Data Mahasiswa',
        'student_list' => 'Daftar Data Mahasiswa',
        'student_description' => 'Berikut adalah data mahasiswa yang tersimpan di database.',
        'add_student' => 'Tambah Mahasiswa',
        'edit_student' => 'Edit',
        'delete_student' => 'Hapus',
        'student_number' => 'NIM',
        'full_name' => 'Nama Lengkap',
        'study_program' => 'Program Studi',
        'semester' => 'Semester',
        'email' => 'Email',
        'created_at' => 'Tanggal Dibuat',
        'actions' => 'Aksi',
        'save' => 'Simpan',
        'save_changes' => 'Simpan Perubahan',
        'cancel' => 'Batal',
        'back_dashboard' => 'Kembali ke Dashboard',
        'back_list' => 'Kembali ke Daftar Mahasiswa',
        'add_description' => 'Masukkan informasi mahasiswa pada formulir berikut.',
        'edit_description' => 'Perbarui informasi mahasiswa melalui formulir berikut.',
        'required_fields' => 'Semua kolom wajib diisi.',
        'invalid_semester' => 'Semester harus antara 1 sampai 14.',
        'invalid_email' => 'Format email tidak valid.',
        'duplicate_nim' => 'NIM sudah digunakan mahasiswa lain.',
        'update_error' => 'Terjadi kesalahan saat memperbarui data.',
        'empty_data' => 'Belum ada data mahasiswa.',
        'login_error' => 'Username atau password salah.',
        'empty_login' => 'Username dan password wajib diisi.',
        'footer' => 'Sistem Informasi Pengelolaan Data Mahasiswa',
        'language' => 'Bahasa',
        'indonesian' => 'Bahasa Indonesia',
        'english' => 'Bahasa Inggris'
    ],

    'en' => [
        'system_name' => 'Student Information System',
        'system_description' => 'Student Data Management',
        'login_title' => 'Administrator Login',
        'username' => 'Username',
        'password' => 'Password',
        'login_button' => 'Login',
        'logout' => 'Logout',
        'dashboard' => 'Administrator Dashboard',
        'welcome' => 'Welcome',
        'main_menu' => 'Main Menu',
        'student_management' => 'Manage Students',
        'student_list' => 'Student List',
        'student_description' => 'The following student data is stored in the database.',
        'add_student' => 'Add Student',
        'edit_student' => 'Edit',
        'delete_student' => 'Delete',
        'student_number' => 'Student ID',
        'full_name' => 'Full Name',
        'study_program' => 'Study Program',
        'semester' => 'Semester',
        'email' => 'Email',
        'created_at' => 'Date Created',
        'actions' => 'Actions',
        'save' => 'Save',
        'save_changes' => 'Save Changes',
        'cancel' => 'Cancel',
        'back_dashboard' => 'Back to Dashboard',
        'back_list' => 'Back to Student List',
        'add_description' => 'Enter student information in the following form.',
        'edit_description' => 'Update student information using the following form.',
        'required_fields' => 'All fields are required.',
        'invalid_semester' => 'Semester must be between 1 and 14.',
        'invalid_email' => 'Invalid email format.',
        'duplicate_nim' => 'This student ID is already in use.',
        'update_error' => 'An error occurred while updating the data.',
        'empty_data' => 'No student data available.',
        'login_error' => 'Incorrect username or password.',
        'empty_login' => 'Username and password are required.',
        'footer' => 'Student Data Management Information System',
        'language' => 'Language',
        'indonesian' => 'Indonesian',
        'english' => 'English'
    ]

];

// Fungsi untuk mengambil teks sesuai bahasa aktif
function translate($key)
{
    global $translations, $lang;

    return $translations[$lang][$key]
        ?? $translations['id'][$key]
        ?? $key;
}