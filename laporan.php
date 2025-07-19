<?php
require_once '../config/koneksi.php';
require_once '../auth.php';
require_admin();

$laporan = mysqli_query($conn, "
  SELECT t.*, u.nama AS nama_user
  FROM transaksi t
  JOIN user u ON t.id_user = u.id_user
  WHERE t.status = 'selesai'
  ORDER BY t.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Transaksi - HiiStyle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
    }

    body {
      background: url('../assets/img/wallpaper.png') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      color: #f5f5f5;
    }

    main {
      flex: 1;
    }

    .card {
      background-color: rgba(18, 18, 18, 0.92);
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
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

    .btn-secondary {
      background-color: #444;
      border: none;
      color: #f5f5f5;
    }

    .btn-secondary:hover {
      background-color: #333;
      color: #d4af37;
    }

    .text-gold {
      color: #d4af37;
      font-weight: 600;
    }

    .badge-selesai {
      background-color: #28a745;
    }

    .fw-bold {
      font-weight: 600;
    }
  </style>
</head>
<body>

<?php include '../inc/header.php'; ?>

<main class="container mt-5 mb-5">
  <div class="card shadow-lg">
    <h4 class="text-gold mb-4"><i class="bi bi-clipboard-data me-2"></i> Laporan Transaksi Selesai</h4>

    <div class="table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $totalSemua = 0;
          while ($row = mysqli_fetch_assoc($laporan)) :
            $totalSemua += $row['total'];
          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_user']) ?></td>
            <td><?= date('d M Y H:i', strtotime($row['created_at'])) ?></td>
            <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
            <td><span class="badge badge-selesai">Selesai</span></td>
          </tr>
          <?php endwhile; ?>
          <tr class="fw-bold table-secondary">
            <td colspan="3" class="text-end">Total Pendapatan</td>
            <td colspan="2">Rp<?= number_format($totalSemua, 0, ',', '.') ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <a href="dashboard.php" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left"></i> Kembali ke Dashboard</a>
  </div>
</main>

<?php include '../inc/footer.php'; ?>
</body>
</html>
