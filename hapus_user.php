<?php
require_once '../config/koneksi.php';
require_once '../auth.php';
require_admin();

if (!isset($_GET['id'])) {
  echo "⚠️ ID user tidak ditemukan!";
  exit;
}

$id = $_GET['id'];

// Ambil user berdasarkan ID
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id"));

if (!$user) {
  echo "⚠️ User tidak ditemukan!";
  exit;
}

// Cegah hapus admin
if ($user['role'] === 'admin') {
  echo "❌ Tidak dapat menghapus akun admin!";
  exit;
}

// Hapus user
mysqli_query($conn, "DELETE FROM user WHERE id_user = $id");
header("Location: data_user.php");
exit;
?>
