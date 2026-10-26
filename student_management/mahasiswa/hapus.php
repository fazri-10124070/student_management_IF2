<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';

// Pastikan permintaan menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Validasi ID mahasiswa
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    header('Location: index.php');
    exit;
}

// Hapus data menggunakan prepared statement
$stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE id = :id");
$stmt->execute([':id' => $id]);

header('Location: index.php');
exit;