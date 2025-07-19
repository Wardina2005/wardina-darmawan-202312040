<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'config/koneksi.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = $_POST['password'];

  $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
  $user = mysqli_fetch_assoc($query);

  if ($user) {
    if (password_verify($password, $user['password'])) {
      $_SESSION['id_user']   = $user['id_user'];
      $_SESSION['nama']      = $user['nama'];
      $_SESSION['username']  = $user['username'];
      $_SESSION['role']      = $user['role'];

      if ($user['role'] === 'admin') {
        header("Location: admin/dashboard.php");
      } else {
        header("Location: user/dashboard.php");
      }
      exit;
    } else {
      $error = "⚠️ Password salah!";
    }
  } else {
    $error = "⚠️ Username tidak ditemukan!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - HiiStyle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #1c1c1c;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .login-card {
      background-color: #121212;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 0 30px rgba(212, 175, 55, 0.3);
      width: 100%;
      max-width: 400px;
      color: #ffffff;
      border: 1px solid #cda34f;
    }

    .login-card h3 {
      color: #d4af37;
      font-weight: bold;
      text-align: center;
      margin-bottom: 30px;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    .form-label {
      color: #d4af37;
      font-weight: 500;
    }

    .form-control {
      border-radius: 10px;
      background-color: #2a2a2a;
      border: 1px solid #444;
      color: #fff;
    }

    .form-control:focus {
      background-color: #2a2a2a;
      border-color: #d4af37;
      box-shadow: 0 0 5px rgba(212, 175, 55, 0.5);
    }

    .btn-login {
      background-color: #d4af37;
      border: none;
      border-radius: 12px;
      padding: 12px;
      font-size: 16px;
      font-weight: 600;
      color: #1c1c1c;
      transition: background 0.3s ease;
    }

    .btn-login:hover {
      background-color: #cda34f;
      color: #000;
    }

    .alert-danger {
      font-size: 14px;
      border-radius: 10px;
    }

    .signup-text {
      text-align: center;
      margin-top: 20px;
    }

    .signup-text a {
      color: #d4af37;
      text-decoration: none;
      font-weight: 600;
    }

    .signup-text a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="login-card">
  <h3>HiiStyle</h3>

  <?php if ($error): ?>
    <div class="alert alert-danger text-center"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required autofocus>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-login">Login</button>
    </div>
  </form>

  <div class="signup-text">
    Belum punya akun? <a href="register.php">Daftar di sini</a>
  </div>
</div>

</body>
</html>
