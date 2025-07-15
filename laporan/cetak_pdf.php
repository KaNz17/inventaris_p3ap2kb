<?php
require '../vendor/autoload.php';
use Dompdf\Dompdf;

include('../config/koneksi.php');
$barang = mysqli_query($conn, "SELECT barang.*, kategori.nama_kategori FROM barang 
  JOIN kategori ON barang.kategori_id = kategori.id ORDER BY barang.id DESC");

$html = '<h3 style="text-align:center;">Laporan Inventaris Barang</h3><hr><table border="1" cellspacing="0" cellpadding="5" width="100%">
  <thead>
    <tr>
      <th>No</th><th>Nama Barang</th><th>Kategori</th><th>Jumlah</th><th>Lokasi</th><th>Tanggal Masuk</th>
    </tr>
  </thead><tbody>';
$no = 1;
while ($row = mysqli_fetch_assoc($barang)) {
  $html .= "<tr>
    <td>{$no}</td>
    <td>{$row['nama']}</td>
    <td>{$row['nama_kategori']}</td>
    <td>{$row['jumlah']}</td>
    <td>{$row['lokasi']}</td>
    <td>{$row['tanggal_masuk']}</td>
  </tr>";
  $no++;
}
$html .= '</tbody></table>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("laporan_inventaris.pdf");
?>
