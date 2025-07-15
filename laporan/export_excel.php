<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../index.php"); exit; }
include('../config/koneksi.php');

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=export_inventaris.xls");

$data = mysqli_query($conn, "SELECT barang.*, kategori.nama_kategori FROM barang 
         JOIN kategori ON barang.kategori_id = kategori.id ORDER BY barang.id DESC");

echo "<table border='1'>";
echo "<tr>
  <th>No</th><th>Nama Barang</th><th>Kategori</th><th>Jumlah</th><th>Lokasi</th><th>Tanggal Masuk</th>
</tr>";
$no = 1;
while ($row = mysqli_fetch_assoc($data)) {
  echo "<tr>
    <td>{$no}</td>
    <td>{$row['nama']}</td>
    <td>{$row['nama_kategori']}</td>
    <td>{$row['jumlah']}</td>
    <td>{$row['lokasi']}</td>
    <td>{$row['tanggal_masuk']}</td>
  </tr>";
  $no++;
}
echo "</table>";
?>
