<?php
session_start();
include 'db_config.php';

$user_id = $_SESSION['user_id'];
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];

// Simpan kegiatan
$stmt = $conn->prepare("INSERT INTO kegiatan (user_id, judul, deskripsi, created_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("iss", $user_id, $judul, $deskripsi);
$stmt->execute();
$kegiatan_id = $stmt->insert_id;

// Upload banyak foto
$target_dir = "uploads/";
foreach ($_FILES['foto']['tmp_name'] as $index => $tmp_name) {
    $nama_file = basename($_FILES['foto']['name'][$index]);
    $target_file = $target_dir . uniqid() . "_" . $nama_file;
    
    if (move_uploaded_file($tmp_name, $target_file)) {
        // Simpan nama file ke tabel kegiatan_foto
        $stmt_foto = $conn->prepare("INSERT INTO kegiatan_foto (kegiatan_id, filename) VALUES (?, ?)");
        $stmt_foto->bind_param("is", $kegiatan_id, $target_file);
        $stmt_foto->execute();
    }
}

header("Location: daftar_kegiatan.php?status=sukses");
exit();
?>
