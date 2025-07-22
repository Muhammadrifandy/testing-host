<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Buat Topik Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div style="max-width:600px;margin:auto;padding:20px;background:white;border-radius:8px;">
    <h2>Buat Topik Diskusi</h2>
    <form action="proses_forum.php" method="POST">
        <label>Judul:</label><br>
        <input type="text" name="judul" required style="width:100%;padding:10px;"><br><br>

        <label>Isi:</label><br>
        <textarea name="isi" rows="6" required style="width:100%;padding:10px;"></textarea><br><br>

        <button type="submit">Posting</button>
    </form>
    <br><a href="forum.php">← Kembali ke Forum</a>
</div>
</body>
</html>
