<?php
require_once '../config/koneksi.php';
require_once '../auth.php';
require_admin();

// Ambil semua aktivitas terbaru
$log = mysqli_query($conn, "SELECT a.*, u.nama FROM aktivitas a 
JOIN user u ON a.id_user = u.id_user 
ORDER BY a.waktu DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Aktivitas Pengguna - HiiStyle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f7f9fc;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    h3 {
      font-weight: 600;
    }
    .log-item {
      padding: 12px;
      border-bottom: 1px solid #eee;
    }
  </style>
</head>
<body>

<?php include '../inc/header.php'; ?>

<div class="container mt-4">
  <h3 class="mb-4">📄 Aktivitas Pengguna</h3>

  <div class="card">
    <div class="card-body">
      <?php if (mysqli_num_rows($log) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($log)): ?>
          <div class="log-item">
            <strong><?= htmlspecialchars($row['nama']) ?></strong> - <?= htmlspecialchars($row['aksi']) ?>
            <br><small class="text-muted"><?= date('d M Y, H:i', strtotime($row['waktu'])) ?></small>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-muted">Belum ada aktivitas yang dicatat.</p>
      <?php endif; ?>
    </div>
  </div>

  <a href="dashboard.php" class="btn btn-secondary mt-3">⬅️ Kembali ke Dashboard</a>
</div>

<?php include '../inc/footer.php'; ?>
</body>
</html>
