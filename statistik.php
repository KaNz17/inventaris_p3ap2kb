<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: index.php"); exit; }
include('config/koneksi.php');

$kategori_data = mysqli_query($conn, "SELECT nama_kategori, (SELECT COUNT(*) FROM barang WHERE kategori_id=k.id) as jumlah 
                                       FROM kategori k");

$labels = [];
$jumlah = [];
while ($row = mysqli_fetch_assoc($kategori_data)) {
  $labels[] = $row['nama_kategori'];
  $jumlah[] = $row['jumlah'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Statistik Barang</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <h3 class="mb-4">Statistik Barang per Kategori</h3>
  <a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>
  <canvas id="kategoriChart" height="100"></canvas>
</div>

<script>
const ctx = document.getElementById('kategoriChart');
const kategoriChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?= json_encode($labels) ?>,
    datasets: [{
      label: 'Jumlah Barang',
      data: <?= json_encode($jumlah) ?>,
      backgroundColor: 'rgba(54, 162, 235, 0.6)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: { beginAtZero: true }
    }
  }
});
</script>
</body>
</html>
