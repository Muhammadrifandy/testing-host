<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $pesan = $_POST['pesan'];

    $stmt = $conn->prepare("INSERT INTO komunitas (user_id, pesan) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $pesan);
    $stmt->execute();
}

$result = $conn->query("SELECT k.*, u.nama_lengkap FROM komunitas k JOIN users u ON k.user_id = u.id ORDER BY k.id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Forum Komunitas</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .chat-box {
            max-width: 700px;
            margin: 30px auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }
        .chat-message {
            background: white;
            padding: 10px;
            margin-bottom: 10px;
            border-left: 4px solid #2c3e50;
        }
        .chat-message strong {
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="chat-box">
        <h2>💬 Forum Komunitas Remaja Desa</h2>
        <form method="POST">
            <textarea name="pesan" placeholder="Tulis pesanmu..." required></textarea><br>
            <button type="submit">Kirim</button>
        </form>

        <hr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="chat-message">
                <strong><?= htmlspecialchars($row['nama_lengkap']) ?>:</strong><br>
                <?= nl2br(htmlspecialchars($row['pesan'])) ?>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
