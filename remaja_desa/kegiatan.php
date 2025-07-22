<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT k.*, u.nama_lengkap FROM kegiatan k JOIN users u ON k.user_id = u.id ORDER BY k.id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kegiatan Remaja</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .kegiatan {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .kegiatan img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .kegiatan h3 {
            margin: 10px 0 5px;
        }
        .kegiatan p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">📋 Daftar Kegiatan Remaja Desa</h2>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="kegiatan">
            <img src="uploads/<?= htmlspecialchars($row['foto']) ?>" alt="Foto Kegiatan">
            <h3><?= htmlspecialchars($row['judul']) ?></h3>
            <p><strong>Oleh:</strong> <?= htmlspecialchars($row['nama_lengkap']) ?></p>
            <p><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
        </div>
    <?php endwhile; ?>
</body>
</html>
