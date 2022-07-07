<?php
include_once("../koneksi.php");
session_start();
  $username = $_POST['user'];
  $password = $_POST['pw'];
  $data1 = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username' and password='$password' ");
  $cek1 = mysqli_num_rows($data1);

  $data2 = mysqli_query($mysqli, "SELECT * FROM petugas WHERE username='$username' and password='$password' ");
  $cek2 = mysqli_num_rows($data2);

  $data3 = mysqli_query($mysqli, "SELECT * FROM teknisi WHERE nama_teknisi='$username' and id_teknisi='$password' ");
  $cek3 = mysqli_num_rows($data3);
  if($cek1 > 0){
    $cek1 = mysqli_fetch_array($data1);
    $_SESSION['id'] = $cek1['id_user'];
    $_SESSION['level'] = "user";
    echo "<script>window.location.href='../userpage/user.php'</script>";
  }
  elseif($cek2 > 0){
    $cek2 = mysqli_fetch_array($data2);
    $_SESSION['id'] = $cek2['id_petugas'];
    $_SESSION['level'] = "petugas";
    echo "<script>window.location.href='../petugaspage/petugas.php'</script>";
  }
  elseif($cek3 > 0){
    $cek3 = mysqli_fetch_array($data3);
    $_SESSION['id'] = $cek3['id_teknisi'];
    $_SESSION['level'] = "teknisi";
    echo "<script>window.location.href='../teknisipage/teknisi.php'</script>";
  }
  else{
    echo "<script>window.location.href='login.php'</script>";
  }
?>