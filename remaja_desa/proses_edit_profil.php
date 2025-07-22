<?php
session_start();
include 'db_config.php';

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$bio = $_POST['bio'];

// Proses upload foto jika ada
$foto_nama = null;
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_nama = time() . '_' . basename($_FILES['foto']['name']);
    move_uploaded_file($foto_tmp, "uploads/" . $foto_nama);
}

// Debug: pastikan kolom dan tabel cocok
if ($foto_nama) {
    $query = "UPDATE users SET username=?, email=?, bio=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed (with foto): " . $conn->error);
    }
    $stmt->bind_param("ssssi", $username, $email, $bio, $foto_nama, $id);
} else {
    $query = "UPDATE users SET username=?, email=?, bio=? WHERE id=?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed (no foto): " . $conn->error);
    }
    $stmt->bind_param("sssi", $username, $email, $bio, $id);
}

if ($stmt->execute()) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Gagal mengupdate profil: " . $stmt->error;
}
?>
