<?php
require 'koneksi.php';

// Menangkap data dari form dengan fallback string kosong
$nama  = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$kelas = $_POST['kelas'] ?? '';

// Validasi sederhana
if ($nama == '' || $email == '' || $kelas == '') {
    die("Semua data harus diisi. <a href='index.php'>Kembali ke form</a>");
}

// Menyiapkan perintah SQL dengan Prepared Statement
$sql = "INSERT INTO siswa (nama, email, kelas) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($koneksi, $sql);

if ($stmt) {
    // Binding parameter (sss = string, string, string)
    mysqli_stmt_bind_param($stmt, "sss", $nama, $email, $kelas);
    
    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href='tampil.php';</script>";
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
    
    // Tutup statement
    mysqli_stmt_close($stmt);
} else {
    echo "Gagal menyiapkan statement: " . mysqli_error($koneksi);
}

// Tutup koneksi
mysqli_close($koneksi);
?>