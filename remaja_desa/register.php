<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Remaja Desa</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 1s ease-in-out;
        }

        .form-container {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            animation: slideUp 0.8s ease forwards;
            opacity: 0;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 600;
            color: #333;
        }

        form input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 12px;
            transition: border 0.3s, box-shadow 0.3s;
        }

        form input:focus {
            border-color: #4facfe;
            box-shadow: 0 0 8px rgba(79, 172, 254, 0.4);
            outline: none;
        }

        form button {
            width: 100%;
            padding: 12px;
            background: #4facfe;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form button:hover {
            background: #1e90ff;
        }

        form p {
            text-align: center;
            margin-top: 15px;
            color: #555;
        }

        form a {
            color: #4facfe;
            text-decoration: none;
            transition: color 0.3s;
        }

        form a:hover {
            color: #1e90ff;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Daftar Akun Remaja Desa</h2>
    <form action="proses_register.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap">
        <input type="number" name="umur" placeholder="Umur">
        <input type="text" name="desa" placeholder="Desa">
        <input type="text" name="hobi" placeholder="Hobi">
        <button type="submit">Daftar</button>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </form>
</div>
</body>
</html>
