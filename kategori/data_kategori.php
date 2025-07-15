<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../index.php"); exit; }
include('../config/koneksi.php');
$data = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Kategori</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <h2 class="mb-3">Data Kategori</h2>
  <a href="tambah_kategori.php" class="btn btn-primary mb-3">Tambah Kategori</a>
  <a href="../dashboard.php" class="btn btn-secondary mb-3">Kembali</a>
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr><th>No</th><th>Nama Kategori</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      <?php $no=1; while($r = mysqli_fetch_assoc($data)) { ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $r['nama_kategori'] ?></td>
        <td>
          <a href="hapus_kategori.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>
