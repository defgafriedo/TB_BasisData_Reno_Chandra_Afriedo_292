<?php
include '../koneksi.php';
$id = $_POST['id'];
$lokasi = $_POST['lokasi'];
$jenis = $_POST['jenis'];
$tanggal = $_POST['tanggal'];
$bukti=$_POST['bukti'];
$result = mysqli_query($mysqli, "INSERT INTO laporan_transaksi(id_user,id_lokasi,id_kerusakan,tanggal_laporan,bukti_laporan)
 values('$id','$lokasi','$jenis','$tanggal','$bukti')");
echo "<script>alert('berhasil');</script>";
echo "<script>window.location.href='user.php'</script>";	
?>

