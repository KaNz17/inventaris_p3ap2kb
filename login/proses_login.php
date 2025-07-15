<?php
session_start();
include('../config/koneksi.php');

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query);

if ($data) {
  $_SESSION['login'] = true;
  $_SESSION['username'] = $data['username'];
  $_SESSION['level'] = $data['level'];
  header("Location: ../dashboard.php");
} else {
  echo "<script>alert('Login gagal!'); window.location='../index.php';</script>";
}
?>