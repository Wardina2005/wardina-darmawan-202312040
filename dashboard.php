<?php
require_once '../config/koneksi.php';
require_once '../auth.php';
require_admin(); // hanya admin boleh masuk
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Admin - HiiStyle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <style>
    body {
      background: url('../assets/img/wallpaper.png') no-repeat center center fixed;
      background-size: cover;
      backdrop-filter: brightness(0.8);
    }

    .main-content {
      margin-left: 220px;
      min-height: 100vh;
      background-color: rgba(18, 18, 18, 0.85); /* gelap transparan */
      padding-bottom: 2rem;
    }

    .custom-navbar {
      background-color: transparent;
      border-bottom: 1px solid #d4af37;
      color: #d4af37;
    }

    .custom-navbar .navbar-brand {
      font-weight: bold;
      color: #d4af37;
    }

    .navbar-nav .nav-link {
      color: #f0f0f0;
    }

    .navbar-nav .nav-link:hover {
      color: #d4af37;
    }
  </style>
</head>
<body>

<?php include '../inc/sidebar_admin.php'; ?>

<!-- Konten Utama -->
<div class="main-content">
  <!-- Header / Navbar -->
  <nav class="navbar navbar-expand-lg custom-navbar px-4">
    <div class="container-fluid">
      <span class="navbar-brand"></span>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item">
            <span class="nav-link">Halo, <?= $_SESSION['nama']; ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link text-warning" href="../logout.php">
              <i class="bi bi-box-arrow-right"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Konten Dashboard -->
  <div class="container-fluid px-4 py-4">
    <div class="dashboard-header">👑 Selamat Datang, <?= $_SESSION['nama']; ?>!</div>

    <div class="dashboard-grid">
      <div class="dashboard-item">
        <i class="bi bi-bag-check"></i>
        <h5>Manajemen Produk</h5>
        <p>Tambah, edit, dan kelola produk tas branded.</p>
        <a href="data_produk.php">Kelola</a>
      </div>

      <div class="dashboard-item">
        <i class="bi bi-people-fill"></i>
        <h5>Data Pengguna</h5>
        <p>Kelola akun pelanggan & admin.</p>
        <a href="data_user.php">Lihat</a>
      </div>

      <div class="dashboard-item">
        <i class="bi bi-clipboard-data"></i>
        <h5>Laporan</h5>
        <p>Lihat dan unduh laporan transaksi.</p>
        <a href="laporan.php">Buka</a>
      </div>
    </div>
  </div>
</div>

<!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
