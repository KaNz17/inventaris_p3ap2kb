<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../index.php"); exit; }
include('../config/koneksi.php');
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM barang WHERE id = $id"));
$kategori = mysqli_query($conn, "SELECT * FROM kategori");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama'];
  $kategori_id = $_POST['kategori'];
  $jumlah = $_POST['jumlah'];
  $lokasi = $_POST['lokasi'];
  $tanggal = $_POST['tanggal'];
  mysqli_query($conn, "UPDATE barang SET nama='$nama', kategori_id='$kategori_id', jumlah='$jumlah',
    lokasi='$lokasi', tanggal_masuk='$tanggal' WHERE id=$id");
  header("Location: data_barang.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <h3>Edit Barang</h3>
  <form method="post">
    <div class="mb-3"><label class="form-label">Nama Barang</label>
      <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Kategori</label>
      <select name="kategori" class="form-select" required>
        <?php while($k = mysqli_fetch_assoc($kategori)) { ?>
        <option value="<?= $k['id'] ?>" <?= $k['id']==$data['kategori_id']?'selected':'' ?>><?= $k['nama_kategori'] ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="mb-3"><label class="form-label">Jumlah</label>
      <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Lokasi</label>
      <input type="text" name="lokasi" value="<?= $data['lokasi'] ?>" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Tanggal Masuk</label>
      <input type="date" name="tanggal" value="<?= $data['tanggal_masuk'] ?>" class="form-control"></div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="data_barang.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
