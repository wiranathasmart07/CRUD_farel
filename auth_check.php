<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login, jika belum lempar ke login.php
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>