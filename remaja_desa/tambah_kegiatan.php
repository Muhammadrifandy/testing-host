<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Tambah Kegiatan</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f9;
      margin: 0;
      padding: 40px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
      overflow-x: hidden;
      animation: fadeInBody 1s ease;
    }

    @keyframes fadeInBody {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .form-card {
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
      animation: slideUp 0.8s ease;
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(40px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .form-card h2 {
      margin-top: 0;
      margin-bottom: 25px;
      font-size: 24px;
      text-align: center;
      color: #2c3e50;
      animation: fadeInText 1s ease;
    }

    @keyframes fadeInText {
      from { opacity: 0; transform: scale(0.95); }
      to   { opacity: 1; transform: scale(1); }
    }

    label {
      font-weight: 600;
      display: block;
      margin-bottom: 6px;
      color: #333;
      transition: color 0.3s ease;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 10px 14px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 15px;
      background-color: #fefefe;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    input[type="text"]:focus,
    textarea:focus,
    input[type="file"]:focus {
      border-color: #007bff;
      box-shadow: 0 0 6px rgba(0, 123, 255, 0.3);
      outline: none;
    }

    textarea {
      min-height: 100px;
      resize: vertical;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      color: white;
      font-size: 16px;
      font-weight: 600;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button:hover {
      background-color: #0056b3;
      transform: scale(1.03);
    }

    button:active {
      transform: scale(0.98);
    }
  </style>
</head>
<body>

<div class="form-card">
  <h2>Tambah Kegiatan Remaja</h2>
  <form action="proses_kegiatan.php" method="POST" enctype="multipart/form-data">
    <label for="judul">Judul Kegiatan:</label>
    <input type="text" name="judul" id="judul" required>

    <label for="deskripsi">Deskripsi:</label>
    <textarea name="deskripsi" id="deskripsi" required></textarea>

    <label for="foto">Upload Foto:</label>
    <input type="file" name="foto" id="foto" accept="image/*">

    <button type="submit">Simpan</button>
  </form>
</div>

</body>
</html>
