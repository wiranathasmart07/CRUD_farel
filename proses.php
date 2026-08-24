<?php
require 'auth_check.php';
require 'koneksi.php';

$nis   = $_POST['nis'] ?? '';
$nama  = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$kelas = $_POST['kelas'] ?? '';

if ($nis == '' || $nama == '' || $email == '' || $kelas == '') {
    die("Semua data harus diisi. <a href='index.php'>Kembali ke form</a>");
}

$sql = "INSERT INTO siswa (nis, nama, email, kelas) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($koneksi, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "isss", $nis, $nama, $email, $kelas);
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href='tampil.php';</script>";
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Gagal menyiapkan statement: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>