<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];

if (empty($judul) || empty($deskripsi)) {
    die("Judul dan Deskripsi tidak boleh kosong.");
}

$foto = null;

if (!empty($_FILES['foto']['name'])) {
    $target_dir = "uploads/";
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $nama_baru = uniqid("foto_", true) . "." . strtolower($ext);
    $target_file = $target_dir . $nama_baru;

    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array(strtolower($ext), $allowed_ext)) {
        die("Jenis file tidak didukung.");
    }

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
        $foto = $nama_baru;
    } else {
        die("Gagal mengunggah file.");
    }
}

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO kegiatan (user_id, judul, deskripsi, foto, created_at) VALUES (?, ?, ?, ?, NOW())");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("isss", $user_id, $judul, $deskripsi, $foto);
$stmt->execute();

header("Location: daftar_kegiatan.php?status=sukses");
exit();
?>
