<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'config/koneksi.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = $_POST['password'];
  $role     = 'user'; // default user biasa

  // Cek apakah username sudah digunakan
  $cek = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
  if (mysqli_num_rows($cek) > 0) {
    $error = "⚠️ Username sudah digunakan!";
  } else {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $query = mysqli_query($conn, "INSERT INTO user (nama, username, password, role, created_at) VALUES ('$nama', '$username', '$hashed', '$role', NOW())");

    if ($query) {
      $success = "✅ Registrasi berhasil! Silakan login.";
      header("Refresh:2; url=login.php");
    } else {
      $error = "❌ Gagal menyimpan data.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Akun - HiiStyle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #e0f7fa, #fce4ec);
      font-family: 'Segoe UI', sans-serif;
    }
    .register-box {
      margin-top: 80px;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    .btn-primary {
      background-color: #03a9f4;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0288d1;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5 register-box">
      <h3 class="text-center mb-4 text-primary">Daftar Akun Baru</h3>

      <?php if ($error): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
      <?php elseif ($success): ?>
        <div class="alert alert-success text-center"><?= $success ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Daftar</button>
        </div>
      </form>

      <p class="mt-3 text-center">Sudah punya akun? <a href="login.php" class="text-decoration-none">Login di sini</a></p>
    </div>
  </div>
</div>

</body>
</html>
