<?php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $isi = $_POST['isi'];
    $forum_id = $_POST['forum_id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO komentar_forum (forum_id, user_id, isi) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $forum_id, $user_id, $isi);
    $stmt->execute();

    header("Location: detail_forum.php?id=" . $forum_id);
}
?>
