<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../index.php"); exit; }
include('../config/koneksi.php');
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM barang WHERE id=$id");
header("Location: data_barang.php");
?>