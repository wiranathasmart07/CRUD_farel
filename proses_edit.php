<?php
require 'auth_check.php';
require 'koneksi.php';

$nis_lama = $_POST['nis_lama'] ?? '';
$nis_baru = $_POST['nis'] ?? '';
$nama     = $_POST['nama'] ?? '';
$email    = $_POST['email'] ?? '';
$kelas    = $_POST['kelas'] ?? '';

if ($nis_lama == '' || $nis_baru == '' || $nama == '' || $email == '' || $kelas == '') {
    die("Semua data harus diisi. <a href='tampil.php'>Kembali</a>");
}

// Mengubah NIS lama ke NIS baru serta memperbarui nama, email, dan kelas
$sql = "UPDATE siswa SET nis = ?, nama = ?, email = ?, kelas = ? WHERE nis = ?";
$stmt = mysqli_prepare($koneksi, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "isssi", $nis_baru, $nama, $email, $kelas, $nis_lama);
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='tampil.php';</script>";
    } else {
        echo "Data gagal diperbarui: " . mysqli_error($koneksi);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Gagal menyiapkan statement: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>