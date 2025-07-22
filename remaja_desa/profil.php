<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Remaja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Profil Remaja</h2>
    <img src="uploads/<?= htmlspecialchars($user['foto_profil']) ?>" width="100" alt="Foto Profil">
    <p><strong>Nama:</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Bio:</strong> <?= nl2br(htmlspecialchars($user['bio'])) ?></p>
    <a href="edit_profil.php">Edit Profil</a>
</body>
</html>
