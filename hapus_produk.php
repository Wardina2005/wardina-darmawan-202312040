<?php
require_once '../config/koneksi.php';
require_once '../auth.php';
require_admin();

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Ambil data produk dulu untuk tahu nama file gambar
  $query = mysqli_query($conn, "SELECT gambar FROM produk WHERE id_produk = '$id'");
  $data = mysqli_fetch_assoc($query);

  // Hapus gambar dari folder jika ada
  if ($data && file_exists("../assets/img/produk/" . $data['gambar'])) {
    unlink("../assets/img/produk/" . $data['gambar']);
  }

  // Hapus data produk dari database
  $delete = mysqli_query($conn, "DELETE FROM produk WHERE id_produk = '$id'");

  if ($delete) {
    header("Location: data_produk.php");
    exit;
  } else {
    echo "<script>alert('❌ Gagal menghapus produk.'); window.location='data_produk.php';</script>";
  }
} else {
  echo "<script>alert('ID tidak ditemukan!'); window.location='data_produk.php';</script>";
}
?>
