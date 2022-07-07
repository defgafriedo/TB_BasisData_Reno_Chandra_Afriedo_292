<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
}
include_once("../koneksi.php");
$id = $_GET['id'];
$id_petugas = $_SESSION['id'];

$result = mysqli_query($mysqli, "UPDATE laporan_transaksi SET id_petugas='$id_petugas' where id_laporan='$id'");

echo "<script>window.location.href='petugas.php'</script>";

?>