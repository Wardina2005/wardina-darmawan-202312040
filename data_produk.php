<?php
require_once '../config/koneksi.php';
require_once '../auth.php';
require_admin();

$produk = mysqli_query($conn, "SELECT p.*, k.nama_kategori FROM produk p 
JOIN kategori k ON p.id_kategori = k.id_kategori ORDER BY p.id_produk DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Produk - HiiStyle</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php include '../inc/sidebar_admin.php'; ?>

<div class="main-content" style="margin-left: 220px;">
  <!-- Header/Navbar -->
  <nav class="navbar navbar-expand-lg custom-navbar px-4">
    <div class="container-fluid">
      <span class="navbar-brand">Manajemen Produk</span>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-warning" href="../logout.php">
              <i class="bi bi-box-arrow-right"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Konten -->
  <div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="dashboard-header"><i class="bi bi-bag"></i> Daftar Produk</h3>
      <a href="tambah_produk.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Produk
      </a>
    </div>

    <div class="table-responsive">
      <table class="table table-dark table-bordered table-striped table-hover align-middle rounded">
        <thead class="table-dark text-warning">
          <tr>
            <th>#</th>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; while ($row = mysqli_fetch_assoc($produk)): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><img src="../assets/img/produk/<?= $row['gambar'] ?>" style="height:80px;width:80px;object-fit:cover;border-radius:10px;"></td>
            <td><?= $row['nama_produk'] ?></td>
            <td><?= $row['nama_kategori'] ?></td>
            <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td><?= $row['stok'] ?></td>
            <td>
              <a href="edit_produk.php?id=<?= $row['id_produk'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="hapus_produk.php?id=<?= $row['id_produk'] ?>" class="btn btn-danger btn-sm" 
                onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      <a href="dashboard.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard</a>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
