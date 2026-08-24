<?php
require 'koneksi.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $check_sql = "SELECT id FROM users WHERE username = ?";
        $stmt_check = mysqli_prepare($koneksi, $check_sql);
        mysqli_stmt_bind_param($stmt_check, "s", $username);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            $error = "Username sudah digunakan!";
        } else {
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = mysqli_prepare($koneksi, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                $success = "Registrasi berhasil! Silakan login.";
            } else {
                $error = "Gagal mendaftar!";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_stmt_close($stmt_check);
    } else {
        $error = "Semua kolom wajib diisi!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Sistem Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #fdfdfd; }
        .container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        input { width: 100%; margin-bottom: 15px; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 15px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-weight: bold; }
        button:hover { background: #1d4ed8; }
        .msg { margin-bottom: 15px; font-weight: bold; text-align: center; }
        .error { color: #dc2626; }
        .success { color: #16a34a; }
        .nav-link { display: inline-block; margin-top: 15px; text-decoration: none; color: #2563eb; font-size: 14px; text-align: center; width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center;">Register User</h2>
        <?php if ($error): ?><p class="msg error"><?= $error; ?></p><?php endif; ?>
        <?php if ($success): ?><p class="msg success"><?= $success; ?></p><?php endif; ?>
        <form action="" method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Daftar Akun</button>
        </form>
        <a href="login.php" class="nav-link">Sudah punya akun? Login di sini</a>
    </div>
</body>
</html>