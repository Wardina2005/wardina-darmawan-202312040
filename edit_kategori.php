<?php
require_once '../config/koneksi.php';
require_once '../auth.php';
require_admin();

if (!isset($_GET['id'])) {
    header("Location: kategori.php");
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori = $id");
$kategori = mysqli_fetch_assoc($query);

if (!$kategori) {
    echo "Kategori tidak ditemukan.";
    exit;
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama_kategori = mysqli_real_escape_string($conn, $_POST['nama_kategori']);

    if (!empty($nama_kategori)) {
        $update = mysqli_query($conn, "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori=$id");
        if ($update) {
            $success = "✅ Kategori berhasil diperbarui.";
            $kategori['nama_kategori'] = $nama_kategori;
        } else {
            $error = "❌ Gagal memperbarui kategori.";
        }
    } else {
        $error = "⚠️ Nama kategori tidak boleh kosong.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Kategori - Admin HiiStyle</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php include '../inc/sidebar_admin.php'; ?>

<div class="main-content" style="margin-left: 240px;">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg custom-navbar px-4">
    <div class="container-fluid">
      <span class="navbar-brand">Edit Kategori</span>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item">
            <span class="nav-link">Halo, <?= $_SESSION['nama']; ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link text-warning" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Form Edit -->
  <div class="container py-4">
    <div class="bg-light-gold p-4 rounded shadow" style="max-width: 500px; margin: auto;">
      <h4 class="text-gold mb-4"><i class="bi bi-pencil-square"></i> Edit Kategori</h4>

      <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php elseif ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
      <?php endif; ?>

      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Nama Kategori</label>
          <input type="text" name="nama_kategori" class="form-control" value="<?= htmlspecialchars($kategori['nama_kategori']) ?>" required>
        </div>
        <button type="submit" class="btn btn-gold w-100"><i class="bi bi-save"></i> Simpan Perubahan</button>
        <a href="kategori.php" class="btn btn-secondary w-100 mt-2"><i class="bi bi-arrow-left"></i> Kembali</a>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
