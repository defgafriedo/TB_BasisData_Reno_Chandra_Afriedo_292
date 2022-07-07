<?php
session_start();

if (!isset($_SESSION['id'])) {
  header("Location: ../index.php");
} else {
  $id = $_SESSION['id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>



  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">

  <title>petugas</title>

</head>

<body>
  <?php
  // Create database connection using config file
  include_once("../koneksi.php");
  $laporan = mysqli_query($mysqli, "SELECT * FROM laporan_transaksi 
        inner join lokasi on(laporan_transaksi.id_lokasi = lokasi.id_lokasi)
        inner join user on(laporan_transaksi.id_user = user.id_user)
        inner join jenis_kerusakan on(jenis_kerusakan.id_kerusakan = laporan_transaksi.id_kerusakan)");

  $laporanpetugas = mysqli_query($mysqli, "SELECT * FROM laporan_transaksi 
        inner join lokasi on(laporan_transaksi.id_lokasi = lokasi.id_lokasi)
        inner join jenis_kerusakan on(jenis_kerusakan.id_kerusakan = laporan_transaksi.id_kerusakan)
        left join penanganan_laporan on(laporan_transaksi.id_laporan = penanganan_laporan.id_penanganan)
        where id_petugas='$id'");
  $laporancek = mysqli_query($mysqli, "SELECT id_penanganan FROM penanganan_laporan");
  // Fetch all users data from database
  $petugastb = mysqli_query($mysqli, "SELECT * FROM petugas");
  $teknisitb = mysqli_query($mysqli, "SELECT * FROM teknisi");

  ?>
  <header>
    <h2><a href="../index.php" class="btn btn-outline-light  mt-3 text-light">RAPITTER</a></h2>
    <h3>
      <?php
      if ($_SESSION['level'] == 'petugas') {
        echo "<a href='../teknisipage/teknisi.php' class='btn btn-light mt-3 mb-0'>teknisi</a>";
        echo "<a href='petugas.php' class='btn btn-light btn-lg active mt-3 mb-0'>petugas</a>";
        echo "<a href='../pages/logout.php' class='btn btn-light mt-3 mb-0'>logout</a>";
      }
      ?>
    </h3>
    </nav>
  </header>
  <div class="height-control">
    <div class="row d-flex justify-content-center mt-3">
      <div class="col-lg-5 mr-5">
        <h2>Laporan Terkini</h2>
        <table width='100%' class="table table-striped table-hover laporan-generate">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Kecamatan</th>
              <th scope="col">Kekelurahan</th>
              <th scope="col">alamat_detail</th>
              <th scope="col">Jenis Kerusakan</th>
              <th scope="col">tanggal laporan</th>
              <th scope="col">action</th>
            </tr>
          </thead>
          <?php

          while ($data = mysqli_fetch_array($laporan)) {
            echo "<tr >";
            echo "<td>" . $data['nama_kecamatan'] . "</td>";
            echo "<td>" . $data['nama_kelurahan'] . "</td>";
            echo "<td>" . $data['alamat_detail'] . "</td>";
            echo "<td>" . $data['nama_kerusakan'] . "</td>";
            echo "<td>" . $data['tanggal_laporan'] . "</td>";
            if ($data['id_petugas'] != null) {
              echo "<td><p class='text-success'>PROSES</p></td>";
            } else {
              echo "<td>
                       <a href='prosescek.php?id=$data[id_laporan]' class='btn btn-primary'>proses</a>
                </td>";
            }
            echo "</tr>";
          }
          ?>
        </table>
      </div>
      <div class="col-sm-1"></div>
      <div class="col-lg-4">
        <h2>Daftar Petugas</h2>
        <table width='100%' class="table table-striped table-hover petugaspage">
          <thead class="thead-dark">
            <tr>
              <th scope="col">no</th>
              <th scope="col">nama</th>
              <th scope="col">alamat</th>
            </tr>
          </thead>
          <?php
          while ($petugasarr = mysqli_fetch_array($petugastb)) {
            echo "<tr >";
            echo "<td>" . $petugasarr['id_petugas'] . "</td>";
            echo "<td>" . $petugasarr['nama_petugas'] . "</td>";
            echo "<td>" . $petugasarr['alamat'] . "</td>";
          }
          ?>
        </table>
      </div>
    </div>
    <div class="height-control">
      <div class="row d-flex justify-content-center mt-3">
        <div class="col-lg-8">
          <h2>Proses</h2>
          <table width='100%' class="table table-striped table-hover proses">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Kecamatan</th>
                <th scope="col">Kekelurahan</th>
                <th scope="col">Kerusakan</th>
                <th scope="col">tanggal laporan</th>
                <th scope="col">Jenis Kerusakan</th>
                
                <th scope="col">action</th>
              </tr>
            </thead>
            <?php
            function cek($a,$b){
              if($a!=$b){
                echo "<a href='inserttek.php?id=$a' class='btn btn-primary'>proses</a>";
              }
              else{

              }
            }

            while ($datapetugas = mysqli_fetch_array($laporanpetugas)) {
              echo "<tr >";
              echo "<td>" . $datapetugas['nama_kecamatan'] . "</td>";
              echo "<td>" . $datapetugas['nama_kelurahan'] . "</td>";
              echo "<td>" . $datapetugas['nama_kerusakan'] . "</td>";
              echo "<td>" . $datapetugas['tanggal_laporan'] . "</td>";
              echo "<td>" . $datapetugas['bukti_laporan'] . "</td>";
              echo "<td>";
              cek($datapetugas['id_laporan'],$datapetugas['id_penanganan']);
              echo "</td>";
              echo "</tr>";
            }
            ?>
          </table>
        </div>
          <div class="col-lg-4">
            <h2>Daftar Teknisi <a href="insert.php" class='btn btn-primary'>+</a></h2>
            <table width='100%' class="table table-striped table-hover teknisipage">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">no</th>
                  <th scope="col">Lokasi</th>
                  <th scope="col">Jenis Kerusakan</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <?php
              while ($teknisiarr = mysqli_fetch_array($teknisitb)) {
                echo "<tr >";
                echo "<td>" . $teknisiarr['id_teknisi'] . "</td>";
                echo "<td>" . $teknisiarr['nama_teknisi'] . "</td>";
                echo "<td>" . $teknisiarr['alamat_teknisi'] . "</td>";
                echo "<td>
                <a href='constedit.php?id=$teknisiarr[id_teknisi]' class='btn btn-primary'>Edit</a>
                <a href='deletetek.php?id=$teknisiarr[id_teknisi]' class='btn btn-danger'>Delete</a>
                </td>
            ";
              }
              ?>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="height-control ">
      <div class="row d-flex justify-content-center mt-7 mc-0">



      </div>

    </div>

    <footer>

    </footer>
</body>

<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('.petugaspage').dataTable({
      pageLength: 5,
      lengthChange: false
    });
  });
  $(document).ready(function() {
   
    $('.teknisipage').dataTable({
      pageLength: 5,
      lengthChange: false,
    });
  });
  $(document).ready(function() {
   
   $('.proses').dataTable({
     pageLength: 5,
     lengthChange: false,
   });


 });
  $(document).ready(function() {
    $('.laporan-generate').dataTable({
      pageLength: 5,
      lengthChange: false,
    });
  });
</script>

</html>