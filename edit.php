<?php
require 'auth_check.php';
require 'koneksi.php';

$nis = $_GET['nis'] ?? '';

if (empty($nis)) {
    die("NIS siswa tidak ditemukan. <a href='tampil.php'>Kembali</a>");
}

$sql = "SELECT * FROM siswa WHERE nis = ?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $nis);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$siswa = mysqli_fetch_assoc($result);

if (!$siswa) {
    die("Data siswa tidak ditemukan di database. <a href='tampil.php'>Kembali</a>");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #fdfdfd; }
        .container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        input { width: 100%; margin-bottom: 15px; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 15px; background: #eab308; color: white; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-weight: bold; }
        button:hover { background: #ca8a04; }
        .nav-link { display: inline-block; margin-top: 15px; text-decoration: none; color: #2563eb; font-size: 14px; text-align: center; width: 100%;}
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center;">Edit Data Siswa</h2>
        <form action="proses_edit.php" method="POST">
            <!-- Menampung NIS lama untuk acuan pencarian data di database -->
            <input type="hidden" name="nis_lama" value="<?= $siswa['nis']; ?>">

            <label>NIS:</label>
            <input type="number" name="nis" value="<?= $siswa['nis']; ?>" required>

            <label>Nama:</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($siswa['nama']); ?>" required>
            
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($siswa['email']); ?>" required>
            
            <label>Kelas:</label>
            <input type="text" name="kelas" value="<?= htmlspecialchars($siswa['kelas']); ?>" required>
            
            <button type="submit">Simpan Perubahan</button>
        </form>
        <a href="tampil.php" class="nav-link">&larr; Batal & Kembali ke Daftar Siswa</a>
    </div>
</body>
</html>