<?php
require 'auth_check.php';
require 'koneksi.php';

$nis = $_GET['nis'] ?? '';

if (!empty($nis)) {
    $sql = "DELETE FROM siswa WHERE nis = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $nis);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data berhasil dihapus!'); window.location.href='tampil.php';</script>";
        } else {
            echo "Gagal menghapus data: " . mysqli_error($koneksi);
        }
        mysqli_stmt_close($stmt);
    }
} else {
    echo "<script>alert('NIS tidak ditemukan!'); window.location.href='tampil.php';</script>";
}

mysqli_close($koneksi);
?>