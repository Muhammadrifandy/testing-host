<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT k.*, u.username FROM kegiatan k JOIN users u ON k.user_id = u.id ORDER BY k.created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kegiatan | Remaja Desa</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f9fc;
            color: #333;
        }

        header {
            background-color: #00695c;
            padding: 20px;
            color: #fff;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border-left: 5px solid #28a745;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .kegiatan {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .kegiatan:last-child {
            border-bottom: none;
        }

        .kegiatan img {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 10px;
        }

        .kegiatan h3 {
            margin: 0 0 5px;
            color: #00695c;
        }

        .kegiatan small {
            color: #888;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #00796b;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #004d40;
        }

        .top-link {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        @media (max-width: 600px) {
            .top-link {
                flex-direction: column;
                gap: 10px;
            }

            .button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>📋 Daftar Kegiatan Remaja Desa</h1>
    </header>

    <div class="container">
        <div class="top-link">
            <a class="button" href="tambah_kegiatan.php">➕ Tambah Kegiatan</a>
            <a class="button" href="dashboard.php">🏠 Dashboard</a>
        </div>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'sukses'): ?>
            <div class="success">✅ Kegiatan berhasil ditambahkan!</div>
        <?php endif; ?>

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="kegiatan">
                <h3><?= htmlspecialchars($row['judul']) ?></h3>
                <p><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
                <small>Oleh: <?= htmlspecialchars($row['username']) ?> | <?= $row['created_at'] ?></small>
                <?php if (!empty($row['filename'])): ?>
                    <img src="uploads/<?= $row['foto'] ?>" alt="Foto kegiatan">

                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
