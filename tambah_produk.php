<?php
require_once '../config/koneksi.php';
require_once '../auth.php';
require_admin();

$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $kategori_id = $_POST['kategori'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

  $gambar = $_FILES['gambar']['name'];
  $tmp = $_FILES['gambar']['tmp_name'];
  $ext = pathinfo($gambar, PATHINFO_EXTENSION);
  $slug_nama = strtolower(str_replace(' ', '_', $nama));
  $nama_file_gambar = $slug_nama . '.' . $ext;
  $path = "../assets/img/produk/" . $nama_file_gambar;

  if (move_uploaded_file($tmp, $path)) {
    $query = "INSERT INTO produk (nama_produk, id_kategori, harga, stok, deskripsi, gambar, created_at)
              VALUES ('$nama', '$kategori_id', '$harga', '$stok', '$deskripsi', '$nama_file_gambar', NOW())";
    if (mysqli_query($conn, $query)) {
      header("Location: data_produk.php");
      exit;
    } else {
      $error = "❌ Gagal menyimpan produk.";
    }
  } else {
    $error = "❌ Upload gambar gagal!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk - HiiStyle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    body {
      background: url('../assets/img/wallpaper.png') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      color: #f5f5f5;
    }

    .form-wrapper {
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.5);
      color: #fff;
    }

    h4.text-gold {
      color: #ffd700;
    }

    label.form-label {
      color: #ffd700;
      font-weight: 500;
    }

    .btn-warning {
      background-color: #ffd700;
      border: none;
      color: #121212;
      font-weight: bold;
      transition: 0.3s;
    }

    .btn-warning:hover {
      background-color: #e0c000;
      transform: scale(1.05);
    }

    .btn-secondary {
      background-color: #555;
      border: none;
    }

    .btn-secondary:hover {
      background-color: #777;
    }
  </style>
</head>
<body>

<?php include '../inc/header.php'; ?>

<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="form-wrapper">
        <h4 class="mb-4 text-gold"><i class="bi bi-plus-circle-fill"></i> Tambah Produk Baru</h4>

        <?php if (!empty($error)): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
          <div class="mb-3">
            <label class="form-label">👜 Nama Produk</label>
            <input type="text" name="nama" class="form-control shadow-sm" required>
          </div>

          <div class="mb-3">
            <label class="form-label">📂 Kategori</label>
            <select name="kategori" class="form-select shadow-sm" required>
              <option value="">-- Pilih Kategori --</option>
              <?php while ($kat = mysqli_fetch_assoc($kategori)): ?>
                <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">💰 Harga</label>
              <input type="number" name="harga" class="form-control shadow-sm" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">📦 Stok</label>
              <input type="number" name="stok" class="form-control shadow-sm" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">📝 Deskripsi</label>
            <textarea name="deskripsi" class="form-control shadow-sm" rows="3" required></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">🖼️ Gambar Produk</label>
            <input type="file" name="gambar" class="form-control shadow-sm" accept="image/*" required>
          </div>

          <div class="d-flex justify-content-between mt-4">
            <a href="data_produk.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-warning px-4"><i class="bi bi-save2"></i> Simpan Produk</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include '../inc/footer.php'; ?>
</body>
</html>
