<?php
require 'auth_check.php';
require 'koneksi.php';

$sql = "SELECT * FROM siswa ORDER BY nis ASC";
$query = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #fdfdfd; }
        .container { max-width: 900px; margin: auto; }
        table { border-collapse: collapse; width: 100%; margin: 20px 0; background: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        th, td { border: 1px solid #ddd; padding: 12px 15px; text-align: left; }
        th { background-color: #f8fafc; color: #333; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .action-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
        .btn { display: inline-block; padding: 8px 12px; background: #2563eb; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 14px; }
        .btn:hover { background: #1d4ed8; }
        .btn-warning { background: #eab308; color: #fff; }
        .btn-warning:hover { background: #ca8a04; }
        .btn-danger { background: #dc2626; color: #fff; }
        .btn-danger:hover { background: #b91c1c; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Siswa Sekolah</h2>
        <div class="action-bar">
            <a href="index.php" class="btn">+ Tambah Data Baru</a>
            <a href="logout.php" class="btn btn-danger">Logout (<?= htmlspecialchars($_SESSION['username']); ?>)</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; 
                while ($siswa = mysqli_fetch_assoc($query)) : 
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($siswa['nis']); ?></td>
                        <td><?= htmlspecialchars($siswa['nama']); ?></td>
                        <td><?= htmlspecialchars($siswa['email']); ?></td>
                        <td><?= htmlspecialchars($siswa['kelas']); ?></td>
                        <td>
                            <a href="edit.php?nis=<?= $siswa['nis']; ?>" class="btn btn-warning" style="padding: 5px 10px; font-size: 12px;">Edit</a>
                            <a href="hapus.php?nis=<?= $siswa['nis']; ?>" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px;" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                
                <?php if(mysqli_num_rows($query) == 0): ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Belum ada data siswa.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>