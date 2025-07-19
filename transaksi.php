<?php
require_once '../config/koneksi.php';
require_once '../auth.php';
require_admin();

$transaksi = mysqli_query($conn, "
  SELECT t.*, u.nama AS nama_user 
  FROM transaksi t
  JOIN user u ON t.id_user = u.id_user
  ORDER BY t.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Transaksi - HiiStyle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('../assets/img/wallpaper.png') no-repeat center center fixed;
      background-size: cover;
      color: #f5f5f5;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
    }

    .container {
      margin-top: 4rem;
      margin-bottom: 4rem;
    }

    .card-transaksi {
      background-color: rgba(18, 18, 18, 0.95);
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 0 12px rgba(212, 175, 55, 0.2);
    }

    h4 {
      color: #d4af37;
      font-weight: bold;
      margin-bottom: 1.5rem;
    }

    .table thead th {
      background-color: #1e1e1e;
      color: #d4af37;
      border-color: #333;
    }

    .table tbody tr {
      background-color: #121212;
      color: #fff;
      border-color: #2b2b2b;
    }

    .table tbody tr:hover {
      background-color: #1c1c1c;
    }

    .badge-pending {
      background-color: #ffc107;
      color: #000;
      font-weight: 600;
    }

    .badge-selesai {
      background-color: #28a745;
      font-weight: 600;
    }

    .btn-gold {
      background-color: #d4af37;
      color: #121212;
      border: none;
      font-weight: bold;
    }

    .btn-gold:hover {
      background-color: #b8962e;
      color: #fff;
    }

    .btn-secondary {
      background-color: #444;
      color: #f5f5f5;
      border: none;
    }

    .btn-secondary:hover {
      background-color: #333;
      color: #d4af37;
    }

    footer {
      background-color: #1a1a1a;
      text-align: center;
      padding: 1rem;
      font-size: 0.9rem;
      color: #999;
      border-top: 1px solid #2e2e2e;
    }
  </style>
</head>
<body>

<?php include '../inc/header.php'; ?>

<main class="container">
  <div class="card-transaksi">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4><i class="bi bi-receipt-cutoff me-2"></i> Daftar Transaksi</h4>
      <a href="dashboard.php" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
    </div>

    <div class="table-responsive">
      <table class="table table-hover table-bordered align-middle shadow-sm rounded-3">
        <thead class="text-center">
          <tr>
            <th style="width: 5%;">#</th>
            <th>Nama User</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status</th>
            <th style="width: 12%;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; while ($row = mysqli_fetch_assoc($transaksi)): ?>
          <tr class="text-center">
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_user']) ?></td>
            <td><?= date('d M Y H:i', strtotime($row['created_at'])) ?></td>
            <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
            <td>
              <span class="badge <?= $row['status'] == 'selesai' ? 'badge-selesai' : 'badge-pending' ?>">
                <?= ucfirst($row['status']) ?>
              </span>
            </td>
            <td>
              <a href="detail_transaksi.php?id=<?= $row['id_transaksi'] ?>" class="btn btn-sm btn-gold"><i class="bi bi-eye-fill"></i> Detail</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<footer>
  &copy; 2025 <span class="text-gold">HiiStyle</span>. All rights reserved.
</footer>

</body>
</html>
