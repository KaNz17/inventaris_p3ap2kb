<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../index.php"); exit; }
include('../config/koneksi.php');

$where = "";
if (!empty($_GET['cari'])) {
  $q = $_GET['cari'];
  $where .= " AND (nama_barang LIKE '%$q%' OR lokasi LIKE '%$q%')";
}
if (!empty($_GET['kategori'])) {
  $k = $_GET['kategori'];
  $where .= " AND kategori_id = '$k'";
}
$kategori_all = mysqli_query($conn, "SELECT * FROM kategori");
$data = mysqli_query($conn, "SELECT barang.*, kategori.nama_kategori FROM barang 
         JOIN kategori ON barang.kategori_id = kategori.id 
         WHERE 1=1 $where ORDER BY barang.id DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <h2 class="mb-3">Data Barang</h2>

  <form class="row g-3 mb-4" method="get">
    <div class="col-md-4">
      <input type="text" name="cari" class="form-control" placeholder="Cari nama/lokasi..." value="<?= $_GET['cari'] ?? '' ?>">
    </div>
    <div class="col-md-3">
      <select name="kategori" class="form-select">
        <option value="">Semua Kategori</option>
        <?php while($k = mysqli_fetch_assoc($kategori_all)) { ?>
          <option value="<?= $k['id'] ?>" <?= (($_GET['kategori'] ?? '')==$k['id'])?'selected':'' ?>><?= $k['nama_kategori'] ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="col-md-2">
      <button class="btn btn-primary w-100">Filter</button>
    </div>
    <div class="col-md-3">
      <a href="data_barang.php" class="btn btn-secondary w-100">Reset</a>
    </div>
  </form>

  <a href="tambah_barang.php" class="btn btn-success mb-3">Tambah Barang</a>
  <a href="../dashboard.php" class="btn btn-secondary mb-3">Kembali</a>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>No</th><th>Nama Barang</th><th>Kategori</th><th>Jumlah</th><th>Lokasi</th><th>Tanggal Masuk</th><th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; while($r = mysqli_fetch_assoc($data)) { ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $r['nama'] ?></td>
        <td><?= $r['nama_kategori'] ?></td>
        <td><?= $r['jumlah'] ?></td>
        <td><?= $r['lokasi'] ?></td>
        <td><?= $r['tanggal_masuk'] ?></td>
        <td>
          <a href="edit_barang.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <?php if ($_SESSION['level'] == 'admin') { ?>
          <a href="hapus_barang.php?id=<?= $r['id'] ?>" onclick="return confirm('Yakin?')" class="btn btn-sm btn-danger">Hapus</a>
          <?php } ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>
