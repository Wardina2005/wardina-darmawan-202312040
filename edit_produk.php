<?php
require_once '../config/koneksi.php';
require_once '../auth.php';
require_admin();

if (!isset($_GET['id'])) {
  header("Location: data_produk.php");
  exit;
}

$id = $_GET['id'];
$produk = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $id");
$data = mysqli_fetch_assoc($produk);
$kategori = mysqli_query($conn, "SELECT * FROM kategori");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $kategori_id = $_POST['kategori'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
  $gambar_lama = $_POST['gambar_lama'];

  if ($_FILES['gambar']['name']) {
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $path = "../assets/img/produk/" . $gambar;
    move_uploaded_file($tmp, $path);
  } else {
    $gambar = $gambar_lama;
  }

  $query = "UPDATE produk SET 
              nama_produk='$nama', 
              id_kategori='$kategori_id', 
              harga='$harga', 
              stok='$stok', 
              deskripsi='$deskripsi', 
              gambar='$gambar' 
            WHERE id_produk=$id";

  if (mysqli_query($conn, $query)) {
    header("Location: data_produk.php");
    exit;
  } else {
    $error = "❌ Gagal mengupdate produk!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk - HiiStyle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include '../inc/header.php'; ?>

<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card border-0 shadow-lg rounded-4 bg-light-gold p-4">
        <h4 class="mb-4 text-gold"><i class="bi bi-pencil-square"></i> Edit Produk</h4>

        <?php if (isset($error)): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
          <div class="mb-3">
            <label class="form-label">👜 Nama Produk</label>
            <input type="text" name="nama" class="form-control shadow-sm" value="<?= $data['nama_produk'] ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">📂 Kategori</label>
            <select name="kategori" class="form-select shadow-sm" required>
              <?php while ($kat = mysqli_fetch_assoc($kategori)): ?>
                <option value="<?= $kat['id_kategori'] ?>" <?= $data['id_kategori'] == $kat['id_kategori'] ? 'selected' : '' ?>>
                  <?= $kat['nama_kategori'] ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">💰 Harga</label>
              <input type="number" name="harga" class="form-control shadow-sm" value="<?= $data['harga'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">📦 Stok</label>
              <input type="number" name="stok" class="form-control shadow-sm" value="<?= $data['stok'] ?>" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">📝 Deskripsi</label>
            <textarea name="deskripsi" class="form-control shadow-sm" rows="3" required><?= $data['deskripsi'] ?></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">🖼️ Gambar Produk Saat Ini</label><br>
            <img src="../assets/img/produk/<?= $data['gambar'] ?>" alt="Gambar Produk" class="rounded shadow" height="90"><br><br>
            <label class="form-label">📁 Upload Gambar Baru (Opsional)</label>
            <input type="file" name="gambar" class="form-control shadow-sm">
            <input type="hidden" name="gambar_lama" value="<?= $data['gambar'] ?>">
          </div>

          <div class="d-flex justify-content-between mt-4">
            <a href="data_produk.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Batal</a>
            <button type="submit" class="btn btn-gold px-4"><i class="bi bi-save"></i> Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include '../inc/footer.php'; ?>
</body>
</html>
