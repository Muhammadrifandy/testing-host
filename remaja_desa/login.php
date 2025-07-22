<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Remaja Desa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: fadeInBody 1s ease;
        }

        @keyframes fadeInBody {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 12px 28px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: zoomFade 0.8s ease;
        }

        @keyframes zoomFade {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .form-container h2 {
            margin-bottom: 25px;
            color: #00796b;
            font-size: 28px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #26a69a;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #26a69a;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #00796b;
        }

        p {
            margin-top: 20px;
            font-size: 14px;
        }

        a {
            color: #00796b;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Login Remaja Desa</h2>
        <form action="proses_login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Masuk</button>
            <p>Belum punya akun? <a href="register.php">Daftar</a></p>
        </form>
    </div>
</body>
</html>
