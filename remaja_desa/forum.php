<?php
session_start();
include 'db_config.php';

$query = "SELECT f.*, u.username FROM forum f JOIN users u ON f.user_id = u.id ORDER BY f.created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Forum Komunitas</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #f7fbff, #eef7f3);
            padding: 30px;
            margin: 0;
            animation: fadeInBody 0.8s ease;
            color: #333;
        }

        @keyframes fadeInBody {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .forum-container {
            max-width: 900px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
            color: #2c3e50;
            animation: zoomFade 0.6s ease;
        }

        @keyframes zoomFade {
            from { opacity: 0; transform: scale(0.95); }
            to   { opacity: 1; transform: scale(1); }
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            background: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }

        .forum-topic {
            margin-bottom: 25px;
            padding: 16px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            background: #f9f9f9;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            animation: fadeInUp 0.5s ease;
        }

        .forum-topic:hover {
            background: #f0faff;
            transform: scale(1.015);
            box-shadow: 0 6px 16px rgba(0,0,0,0.07);
        }

        .forum-topic h3 {
            margin: 0;
            font-size: 20px;
            color: #0077cc;
        }

        .forum-topic h3 a {
            text-decoration: none;
            color: inherit;
            transition: color 0.3s ease;
        }

        .forum-topic h3 a:hover {
            color: #004b80;
        }

        .forum-topic p {
            margin: 6px 0 0;
            color: #555;
            font-size: 14px;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        hr {
            border: none;
            height: 1px;
            background-color: #ccc;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<div class="forum-container">
    <h2>💬 Forum Komunitas Remaja Desa</h2>
    <a href="tambah_forum.php" class="btn">+ Buat Topik Baru</a>
    <hr><br>

    <?php while($row = $result->fetch_assoc()): ?>
        <div class="forum-topic">
            <h3><a href="detail_forum.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['judul']) ?></a></h3>
            <p>Oleh: <strong><?= htmlspecialchars($row['username']) ?></strong> | <?= $row['created_at'] ?></p>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
