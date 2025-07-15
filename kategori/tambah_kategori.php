<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../index.php"); exit; }
include('../config/koneksi.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama'];
  mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
  header("Location: data_kategori.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tambah Kategori</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <h3>Tambah Kategori</h3>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Nama Kategori</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="data_kategori.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
