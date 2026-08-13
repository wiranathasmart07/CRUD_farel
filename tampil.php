<?php
require 'koneksi.php';

// Menjalankan query untuk mengambil data
$sql = "SELECT * FROM siswa ORDER BY id DESC";
$query = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #fdfdfd; }
        .container { max-width: 800px; margin: auto; }
        table { border-collapse: collapse; width: 100%; margin: 20px 0; background: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        th, td { border: 1px solid #ddd; padding: 12px 15px; text-align: left; }
        th { background-color: #f8fafc; color: #333; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .btn { display: inline-block; padding: 10px 15px; background: #2563eb; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; }
        .btn:hover { background: #1d4ed8; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Siswa Sekolah</h2>
        <a href="index.php" class="btn">+ Tambah Data Baru</a>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; 
                while ($siswa = mysqli_fetch_assoc($query)) : 
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($siswa['nama']); ?></td>
                        <td><?= htmlspecialchars($siswa['email']); ?></td>
                        <td><?= htmlspecialchars($siswa['kelas']); ?></td>
                    </tr>
                <?php endwhile; ?>
                
                <?php if(mysqli_num_rows($query) == 0): ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">Belum ada data siswa.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>