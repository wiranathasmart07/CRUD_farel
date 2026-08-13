<?php
// Membuat koneksi ke database
$koneksi = mysqli_connect('localhost', 'root', '', 'sekolah');

// Memeriksa apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>