<?php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO forum (user_id, judul, isi) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $judul, $isi);
    $stmt->execute();

    header("Location: forum.php");
}
?>
