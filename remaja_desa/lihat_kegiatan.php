<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT k.*, u.username FROM kegiatan k JOIN users u ON k.user_id = u.id ORDER BY k.created_at DESC";
$result = $conn->query($query);
if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kegiatan Remaja</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #f0f4ff, #eaf8f2);
            margin: 0;
            padding: 30px;
            color: #333;
            animation: fadeInBody 0.8s ease;
        }

        @keyframes fadeInBody {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 30px;
            color: #2c3e50;
            animation: fadeInTitle 1s ease;
        }

        @keyframes fadeInTitle {
            from { opacity: 0; transform: scale(0.95); }
            to   { opacity: 1; transform: scale(1); }
        }

        a.back-link {
            display: inline-block;
            margin-bottom: 25px;
            text-decoration: none;
            color: #007bff;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        a.back-link:hover {
            color: #0056b3;
        }

        .kegiatan-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .card {
            background: linear-gradient(135deg, #ffffff, #f0f8ff);
            border-radius: 16px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: zoomIn 0.6s ease;
        }

        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.9); }
            to   { opacity: 1; transform: scale(1); }
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            margin: 0 0 8px;
            font-size: 22px;
            color: #1a1a1a;
        }

        .card p {
            margin: 6px 0;
            line-height: 1.5;
            color: #444;
        }

        .card small {
            color: #999;
        }

        .card img {
            margin: 14px 0;
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            transition: transform 0.3s ease;
        }

        .card img:hover {
            transform: scale(1.04);
        }

        .timestamp {
            font-size: 14px;
            margin-top: 14px;
            display: flex;
            align-items: center;
            color: #666;
        }

        .timestamp::before {
            content: "📅";
            margin-right: 6px;
        }
    </style>
</head>
<body>

<h2>📸 Daftar Kegiatan Remaja</h2>
<a href="dashboard.php" class="back-link">← Kembali ke Dashboard</a>

<div class="kegiatan-container">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card">
            <h3><?= htmlspecialchars($row['judul']) ?></h3>

            <?php if (!empty($row['foto'])): ?>
                <img src="uploads/<?= htmlspecialchars($row['foto']) ?>" alt="Foto kegiatan">
            <?php endif; ?>

            <p><strong>Oleh:</strong> <?= htmlspecialchars($row['username']) ?></p>
            <p><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
            <div class="timestamp"><?= htmlspecialchars($row['created_at']) ?></div>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
