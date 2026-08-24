<?php require 'auth_check.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #fdfdfd; }
        .container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        input { width: 100%; margin-bottom: 15px; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 15px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-weight: bold; }
        button:hover { background: #1d4ed8; }
        .nav-link { display: inline-block; margin-top: 15px; text-decoration: none; color: #2563eb; font-size: 14px; text-align: center; width: 100%;}
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center;">Tambah Siswa</h2>
        <form action="proses.php" method="POST">
            <label>NIS:</label>
            <input type="number" name="nis" required>

            <label>Nama:</label>
            <input type="text" name="nama" required>
            
            <label>Email:</label>
            <input type="email" name="email" required>
            
            <label>Kelas:</label>
            <input type="text" name="kelas" required>
            
            <button type="submit">Simpan Data</button>
        </form>
        <a href="tampil.php" class="nav-link">Lihat Daftar Siswa &rarr;</a>
    </div>
</body>
</html>