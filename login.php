<?php
session_start();
require 'koneksi.php';

if (isset($_SESSION['login'])) {
    header("Location: tampil.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            header("Location: tampil.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #fdfdfd; }
        .container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        input { width: 100%; margin-bottom: 15px; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 15px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-weight: bold; }
        button:hover { background: #1d4ed8; }
        .error { color: #dc2626; margin-bottom: 15px; text-align: center; font-weight: bold; }
        .nav-link { display: inline-block; margin-top: 15px; text-decoration: none; color: #2563eb; font-size: 14px; text-align: center; width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center;">Login</h2>
        <?php if ($error): ?><p class="error"><?= $error; ?></p><?php endif; ?>
        <form action="" method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        <a href="register.php" class="nav-link">Belum punya akun? Register di sini</a>
    </div>
</body>
</html>