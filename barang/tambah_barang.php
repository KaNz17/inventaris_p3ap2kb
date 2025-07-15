<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../index.php"); exit; }
include('../config/koneksi.php');

$kategori = mysqli_query($conn, "SELECT * FROM kategori");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama_barang'];
  $kategori_id = $_POST['kategori'];
  $jumlah = $_POST['jumlah'];
  $lokasi = $_POST['lokasi'];
  $tanggal = $_POST['tanggal'];
  mysqli_query($conn, "INSERT INTO barang (nama, kategori_id, jumlah, lokasi, tanggal_masuk) 
    VALUES ('$nama','$kategori_id','$jumlah','$lokasi','$tanggal')");
  header("Location: data_barang.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tambah Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <h3>Tambah Barang</h3>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Nama Barang</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Kategori</label>
      <select name="kategori" class="form-select" required>
        <?php while($k = mysqli_fetch_assoc($kategori)) { ?>
          <option value="<?= $k['id'] ?>"><?= $k['nama_kategori'] ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Jumlah</label>
      <input type="number" name="jumlah" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Lokasi</label>
      <input type="text" name="lokasi" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal Masuk</label>
      <input type="date" name="tanggal" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="data_barang.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
