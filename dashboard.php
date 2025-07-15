<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: index.php"); exit; }
include('config/koneksi.php');

$total_barang = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM barang"))[0];
$total_kategori = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM kategori"))[0];
$total_stok = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(jumlah) FROM barang"))[0];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard - Inventaris</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary">Dashboard Inventaris</h2>
    <div>
      <span class="me-3">Login sebagai: <strong><?= $_SESSION['username'] ?> (<?= $_SESSION['level'] ?>)</strong></span>
      <a href="login/logout.php" class="btn btn-danger">Logout</a>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-md-4"><div class="card text-bg-primary mb-3"><div class="card-body">Total Kategori: <strong><?= $total_kategori ?></strong></div></div></div>
    <div class="col-md-4"><div class="card text-bg-success mb-3"><div class="card-body">Total Barang: <strong><?= $total_barang ?></strong></div></div></div>
    <div class="col-md-4"><div class="card text-bg-warning mb-3"><div class="card-body">Total Stok: <strong><?= $total_stok ?></strong></div></div></div>
  </div>
  <a href="barang/data_barang.php" class="btn btn-outline-primary">Kelola Barang</a>
  <a href="kategori/data_kategori.php" class="btn btn-outline-secondary">Kelola Kategori</a>
  <?php if ($_SESSION['level'] == 'admin') { ?>
    <a href="laporan/cetak_pdf.php" class="btn btn-outline-success" target="_blank">Cetak PDF</a>
    <a href="laporan/export_excel.php" class="btn btn-outline-success">Export Excel</a>
  <?php } ?>
</div>
</body>
</html>
