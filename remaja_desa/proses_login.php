<?php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    print_r($_POST); // Cek data terkirim
    echo "</pre>";

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        echo "Username atau password kosong.";
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    if (!$stmt) {
        echo "Prepare gagal: " . $conn->error;
        exit();
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Untuk debug, tampilkan hash password
        echo "Password di database: " . $user['password'] . "<br>";

        if (password_verify($password, $user['password'])) {
            echo "Login berhasil!";
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Username tidak ditemukan.";
    }
} else {
    echo "Permintaan tidak valid.";
}
?>
