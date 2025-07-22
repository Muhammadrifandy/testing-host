<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT * FROM users WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #e3f2fd, #f3f4f6);
            margin: 0;
            padding: 20px;
            animation: fadeIn 1s ease;
        }

        .profile-container {
            max-width: 550px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 35px;
            border-radius: 16px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            animation: slideUp 0.8s ease;
            transition: box-shadow 0.3s ease;
        }

        .profile-container:hover {
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        h2 {
            text-align: center;
            color: #1976d2;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }

        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
            color: #333;
            transition: color 0.3s;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px 14px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        input:focus,
        textarea:focus {
            border-color: #1976d2;
            outline: none;
            box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.2);
        }

        img.profile-preview {
            display: block;
            max-width: 120px;
            border-radius: 100%;
            margin: 15px auto;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.4s ease;
        }

        img.profile-preview:hover {
            transform: scale(1.1) rotate(1deg);
        }

        button {
            margin-top: 25px;
            width: 100%;
            padding: 14px;
            background-color: #007BFF;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        a.back-link {
            text-align: center;
            display: block;
            margin-top: 20px;
            color: #1976d2;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        a.back-link:hover {
            color: #004c9f;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.03); }
        }
    </style>
</head>
<body>

<div class="profile-container">
    <h2>Edit Profil</h2>

    <?php if (!empty($user['foto'])): ?>
        <img src="uploads/<?= htmlspecialchars($user['foto']) ?>" class="profile-preview">
    <?php endif; ?>

    <form action="proses_edit_profil.php" method="POST" enctype="multipart/form-data">
        <label>Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">

        <label>Bio</label>
        <textarea name="bio" rows="4"><?= htmlspecialchars($user['bio']) ?></textarea>

        <label>Foto Profil (opsional)</label>
        <input type="file" name="foto">

        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="dashboard.php" class="back-link">← Kembali ke Dashboard</a>
</div>

</body>
</html>
