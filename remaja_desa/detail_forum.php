<?php
session_start();
include 'db_config.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT f.*, u.username FROM forum f JOIN users u ON f.user_id = u.id WHERE f.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$forum = $stmt->get_result()->fetch_assoc();

$komentar = $conn->prepare("SELECT k.*, u.username FROM komentar_forum k JOIN users u ON k.user_id = u.id WHERE k.forum_id = ? ORDER BY k.created_at ASC");
$komentar->bind_param("i", $id);
$komentar->execute();
$komentar_result = $komentar->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($forum['judul']) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #f7f7f7, #e8eaf6);
            margin: 0;
            padding: 0;
            animation: fadeIn 1s ease-in;
        }

        .container {
            max-width: 850px;
            margin: 50px auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            padding: 30px;
            transition: transform 0.3s ease;
            animation: slideIn 0.8s ease;
        }

        .container:hover {
            transform: perspective(1000px) rotateX(1deg) rotateY(1deg);
        }

        h2 {
            margin-top: 0;
            color: #3f51b5;
            font-size: 28px;
        }

        p {
            font-size: 16px;
            line-height: 1.7;
        }

        .meta {
            color: #777;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .komentar {
            margin-top: 40px;
        }

        .komentar-item {
            padding: 15px;
            border-left: 5px solid #3f51b5;
            background: #f5f5f5;
            border-radius: 10px;
            margin-bottom: 15px;
            animation: fadeUp 0.6s ease;
        }

        .komentar-item strong {
            color: #3f51b5;
        }

        form textarea {
            width: 100%;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #ccc;
            resize: vertical;
            transition: all 0.3s ease;
        }

        form textarea:focus {
            border-color: #3f51b5;
            outline: none;
            box-shadow: 0 0 5px rgba(63,81,181,0.3);
        }

        button {
            background-color: #3f51b5;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #303f9f;
        }

        a {
            color: #3f51b5;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; } to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?= htmlspecialchars($forum['judul']) ?></h2>
        <p class="meta"><strong><?= $forum['username'] ?></strong> | <?= $forum['created_at'] ?></p>
        <p><?= nl2br(htmlspecialchars($forum['isi'])) ?></p>

        <div class="komentar">
            <h3>Komentar</h3>
            <?php while($row = $komentar_result->fetch_assoc()): ?>
                <div class="komentar-item">
                    <strong><?= $row['username'] ?></strong> (<?= $row['created_at'] ?>)
                    <p><?= htmlspecialchars($row['isi']) ?></p>
                </div>
            <?php endwhile; ?>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="proses_komentar.php" method="POST">
                <input type="hidden" name="forum_id" value="<?= $forum['id'] ?>">
                <textarea name="isi" rows="4" placeholder="Tulis komentar kamu..." required></textarea><br>
                <button type="submit">Kirim Komentar</button>
            </form>
        <?php else: ?>
            <p>Silakan <a href="login.php">login</a> untuk berkomentar.</p>
        <?php endif; ?>

        <br><a href="forum.php">← Kembali ke Forum</a>
    </div>
</body>
</html>
