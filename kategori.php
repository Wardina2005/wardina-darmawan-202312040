<?php
require_once '../config/koneksi.php';
require_once '../auth.php';
require_admin();

$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id_kategori DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Kategori - HiiStyle</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php include '../inc/sidebar_admin.php'; ?>

<div class="main-content" style="margin-left: 240px;">
  <nav class="navbar navbar-expand-lg custom-navbar px-4">
    <div class="container-fluid">
      <span class="navbar-brand">Manajemen Kategori</span>
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

  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-gold"><i class="bi bi-folder2"></i> Manajemen Kategori</h4>
      <div>
        <a href="dashboard.php" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
        <a href="tambah_kategori.php" class="btn btn-gold btn-sm"><i class="bi bi-plus-circle"></i> Tambah Kategori</a>
      </div>
    </div>

    <div class="table-responsive bg-dark p-3 rounded shadow" style="background-color: rgba(0,0,0,0.4);">
      <table class="table table-dark table-bordered align-middle">
        <thead class="table-light text-dark">
          <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; while ($row = mysqli_fetch_assoc($kategori)): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama_kategori'] ?></td>
            <td>
              <a href="edit_kategori.php?id=<?= $row['id_kategori'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
              <a href="hapus_kategori.php?id=<?= $row['id_kategori'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kategori ini?')"><i class="bi bi-trash"></i></a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
