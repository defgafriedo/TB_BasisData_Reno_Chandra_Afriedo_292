<?php
include '../koneksi.php';
$nama = $_POST['nama'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$alamat=$_POST['alamat'];
$no = $_POST['no'];

$result = mysqli_query($mysqli, "INSERT INTO user values(null,'$nama','$user','$pass','$alamat','$no')");
echo "<script>alert('berhasil');</script>";
echo "<script>window.location.href='login.php'</script>";
?>

