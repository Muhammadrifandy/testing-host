<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
} else {
    die("Query gagal: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Remaja Desa Lubuk Cemara</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(to right, #dff9fb, #c7ecee);
            color: #333;
            min-height: 100vh;
            animation: fadeIn 0.8s ease-in-out;
        }

        header.navbar {
            background: linear-gradient(to right, #74b9ff, #a29bfe);
            color: white;
            padding: 20px 0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.6s ease-out;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            position: relative;
            text-align: center;
        }

        .logo {
            width: 100%;
            font-size: 2.2em;
            font-weight: 700;
            text-shadow: 1px 2px 3px rgba(0,0,0,0.2);
            margin-bottom: 10px;
        }

        .menu-icon {
            display: none;
            font-size: 28px;
            cursor: pointer;
            color: white;
            position: absolute;
            left: 20px;
            top: 20px;
        }

        .menu-toggle {
            display: none;
        }

        nav.nav-links {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
            width: 100%;
        }

        nav.nav-links a {
            text-decoration: none;
            font-weight: 600;
            padding: 10px 18px;
            border-radius: 12px;
            background: #ffffff;
            color: #2980b9;
            box-shadow: 4px 4px 10px rgba(0,0,0,0.1),
                        -4px -4px 10px rgba(255,255,255,0.6);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        nav.nav-links a:hover {
            transform: translateY(-4px);
            box-shadow: 6px 6px 15px rgba(0,0,0,0.15);
        }

        .main-content {
            padding: 60px 20px;
            text-align: center;
        }

        .welcome {
            background: #ffffff;
            padding: 50px;
            border-radius: 20px;
            max-width: 750px;
            margin: auto;
            box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.1),
                        -6px -6px 15px rgba(255, 255, 255, 0.6);
            transition: transform 0.4s ease;
            animation: floatUp 1.5s ease-out;
        }

        .welcome:hover {
            transform: translateY(-5px);
        }

        .welcome h2 {
            font-size: 2em;
            color: #6c5ce7;
            margin-bottom: 16px;
        }

        .welcome p {
            font-size: 1rem;
            color: #555;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: #dfe6e9;
            color: #666;
            margin-top: 60px;
            font-size: 0.9em;
            border-top: 1px solid #ccc;
        }

        /* Animations */
        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        @keyframes slideDown {
            from {transform: translateY(-100%);}
            to {transform: translateY(0);}
        }

        @keyframes floatUp {
            0% {transform: translateY(30px); opacity: 0;}
            100% {transform: translateY(0); opacity: 1;}
        }

        /* Responsive */
        @media (max-width: 768px) {
            .menu-icon {
                display: block;
            }

            .nav-links {
                flex-direction: column;
                background: #a29bfe;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.4s ease-in-out;
                width: 100%;
            }

            .menu-toggle:checked + .menu-icon + .nav-links {
                max-height: 400px;
            }

            .nav-links a {
                width: 100%;
                padding: 14px;
                margin: 4px 0;
            }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="container">
            <input type="checkbox" id="menu-toggle" class="menu-toggle" />
            <label for="menu-toggle" class="menu-icon">&#9776;</label>

            <h1 class="logo">Remaja Desa Lubuk Cemara</h1>

            <nav class="nav-links">
                <a href="dashboard.php">🏠 Dashboard</a>
                <a href="edit_profil.php">✏️ Profil</a>
                <a href="tambah_kegiatan.php">➕ Kegiatan</a>
                <a href="lihat_kegiatan.php">📄 Lihat Kegiatan</a>
                <a href="forum.php">💬 Forum</a>
                <a href="logout.php" class="logout">🚪 Logout</a>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <section class="welcome">
            <h2>Selamat Datang, <?= htmlspecialchars($user['nama_lengkap'] ?? 'Remaja Desa Lubuk Cemara') ?>!</h2>
            <p>Selamat bergabung di komunitas remaja desa Lubuk Cemara. Di sini kamu bisa menambah kegiatan, melihat aktivitas remaja lain, serta saling berdiskusi!</p>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; <?= date('Y') ?> Remaja Desa Lubuk Cemara. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
