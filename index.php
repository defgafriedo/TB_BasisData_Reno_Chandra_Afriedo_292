<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">



  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <title>BDTB</title>

</head>

<body>
  <?php
  include_once("koneksi.php");
  $totaljob = mysqli_query($mysqli, "SELECT count(id_penanganan) as total FROM penanganan_laporan")->fetch_array();
  $totalteknisi = mysqli_query($mysqli, "SELECT count(id_teknisi) as total FROM teknisi")->fetch_array();
  $totalratarata = mysqli_query($mysqli, "SELECT avg(DATEDIFF(tanggal_selesai, tanggal_pengerjaan)) as rata FROM penanganan_laporan where tanggal_selesai is not null")->fetch_array();
  $laporan = mysqli_query($mysqli, "SELECT * FROM laporan_transaksi 
        inner join lokasi on(laporan_transaksi.id_lokasi = lokasi.id_lokasi)
        inner join jenis_kerusakan on(jenis_kerusakan.id_kerusakan = laporan_transaksi.id_kerusakan)
        inner join user on(laporan_transaksi.id_user = user.id_user)
        where id_petugas is null order by id_laporan desc");

  $laporangenerate = mysqli_query($mysqli, "SELECT * FROM laporan_transaksi 
        inner join lokasi on(laporan_transaksi.id_lokasi = lokasi.id_lokasi)
        inner join jenis_kerusakan on(jenis_kerusakan.id_kerusakan = laporan_transaksi.id_kerusakan)
        inner join user on(laporan_transaksi.id_user = user.id_user)
        where id_petugas is not null order by id_laporan desc");

  $laporanproses = mysqli_query($mysqli, "SELECT * FROM penanganan_laporan
        inner join laporan_transaksi on(laporan_transaksi.id_laporan = penanganan_laporan.id_penanganan)
        inner join lokasi on(laporan_transaksi.id_lokasi = lokasi.id_lokasi)
        inner join jenis_kerusakan on(jenis_kerusakan.id_kerusakan = laporan_transaksi.id_kerusakan)
        where bukti_selesai is null");

  $laporanselesai = mysqli_query($mysqli, "SELECT * FROM penanganan_laporan
        inner join laporan_transaksi on(laporan_transaksi.id_laporan = penanganan_laporan.id_penanganan)
        inner join lokasi on(laporan_transaksi.id_lokasi = lokasi.id_lokasi)
        inner join jenis_kerusakan on(jenis_kerusakan.id_kerusakan = laporan_transaksi.id_kerusakan)
        where bukti_selesai is not null");


  ?>


  <header>
    <h2><a href="index.php" class="btn btn-outline-light  mt-3 text-light">RAPITTER</a></h2>
    <h3>
      <?php
      if (!isset($_SESSION['level'])) {
        echo "<a href='pages/login.php' class='btn btn-light mt-3 mb-0'>login</a>";
      } else {
        if ($_SESSION['level'] == 'user') {
          echo "<a href='userpage/user.php' class='btn btn-light mt-3 mb-0'>Form Laporan</a>";
          echo "<a href='pages/logout.php' class='btn btn-light mt-3 mb-0'>logout</a>";
        }
        if ($_SESSION['level'] == 'petugas') {
          echo "<a href='teknisipage/teknisi.php' class='btn btn-light mt-3 mb-0'>teknisi</a>";
          echo "<a href='petugaspage/petugas.php' class='btn btn-light mt-3 mb-0'>petugas</a>";
          echo "<a href='pages/logout.php' class='btn btn-light mt-3 mb-0'>logout</a>";
        }
        if ($_SESSION['level'] == 'teknisi') {
          echo "<a href='teknisipage/teknisi.php' class='btn btn-light mt-3 mb-0'>teknisi</a>";
          echo "<a href='pages/logout.php' class='btn btn-light mt-3 mb-0'>logout</a>";
        } else {
        }
      }
      ?>


    </h3>

  </header>



  <div class="row d-flex justify-content-center mt-5">
    <div class="col-lg-3 col-sm-1">
      <div class="card  mb-2">
        <div class="card-header p-1 pt-3">
          <div class="icon icon-sm icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">settings</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">TOTAL PROSES PENGERJAAN</p>
            <h4 class="mb-0"><?php echo $totaljob['total'] ?> PROSES</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-sm-1">
      <div class="card  mb-2">
        <div class="card-header p-2 pt-3">
          <div class="icon icon-sm icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">account_box</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">TOTAL KONTRAKTOR</p>
            <h4 class="mb-0"><?php echo $totalteknisi['total'] ?> KONTRAKTOR</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-sm-1">
      <div class="card  mb-2">
        <div class="card-header p-2 pt-3">
          <div class="icon icon-sm icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">alarm</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">RATA RATA WAKTU PENGERJAAN (*DAY)</p>
            <h4 class="mb-0"><?php echo $totalratarata['rata'] ?> DAY</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <div class="row d-flex justify-content-center mt-5 ct">
    <div class="col-md-5 col-sm-1 mr-5">
      <canvas id="barchart1" style="width:200%;max-width:2000px">
    </div>
    <div class="col-md-2 col-sm-1">
      <canvas id="piechart1" style="width:100%;max-width:2000px">
    </div>
    <div class="col-md-2 col-sm-1">
      <canvas id="piechart2" style="width:100%;max-width:2000px">
    </div>
  </div>


  <div class="row d-flex justify-content-center mt-5">
    <div class="col-lg-7">
      <h2>Laporan Terkini</h2>
      <table width='100%' class="table table-striped table-hover  laporan-generate">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Kecamatan</th>
            <th scope="col">Kekelurahan</th>
            <th scope="col">pelapor</th>
            <th scope="col">Jenis Kerusakan</th>
            <th scope="col">tanggal laporan</th>
          </tr>
        </thead>
        <?php

        while ($data = mysqli_fetch_array($laporan)) {
          echo "<tr >";
          echo "<td>" . $data['nama_kecamatan'] . "</td>";
          echo "<td>" . $data['nama_kelurahan'] . "</td>";
          echo "<td>" . $data['nama_lengkap'] . "</td>";
          echo "<td>" . $data['nama_kerusakan'] . "</td>";
          echo "<td>" . $data['tanggal_laporan'] . "</td>";
          echo "</tr>";
        }
        ?>
      </table>
    </div>
  </div>
  <div class="row d-flex justify-content-center mt-5">
    <div class="col-lg-7">
      <h2>Laporan berjalan</h2>
      <table width='100%' class="table table-striped table-hover laporan-generate">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Kecamatan</th>
            <th scope="col">Kekelurahan</th>
            <th scope="col">pelapor</th>
            <th scope="col">Jenis Kerusakan</th>
            <th scope="col">tanggal laporan</th>
          </tr>
        </thead>
        <?php

        while ($data = mysqli_fetch_array($laporangenerate)) {
          echo "<tr >";
          echo "<td>" . $data['nama_kecamatan'] . "</td>";
          echo "<td>" . $data['nama_kelurahan'] . "</td>";
          echo "<td>" . $data['nama_lengkap'] . "</td>";
          echo "<td>" . $data['nama_kerusakan'] . "</td>";
          echo "<td>" . $data['tanggal_laporan'] . "</td>";
          echo "</tr>";
        }
        ?>
      </table>
    </div>
  </div>
  <div class="row d-flex justify-content-center mt-5">
    <div class="col-lg-7">
    <h2>Pengerjaan</h2>
        <table width='100%' class="table table-striped table-hover tabel-validasi">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Kecamatan</th>
              <th scope="col">Kekelurahan</th>
              <th scope="col">Jenis Kerusakan</th>
              <th scope="col">Tanggal laporan</th>
              <th scope="col">Tanggal pengerjaan</th>

            </tr>
          </thead>
          <?php
          while ($dataproses = mysqli_fetch_array($laporanproses)) {
            echo "<tr >";
            echo "<td>" . $dataproses['nama_kecamatan'] . "</td>";
            echo "<td>" . $dataproses['nama_kelurahan'] . "</td>";
            echo "<td>" . $dataproses['nama_kerusakan'] . "</td>";
            echo "<td>" . $dataproses['tanggal_laporan'] . "</td>";
            echo "<td>" . $dataproses['tanggal_pengerjaan'] . "</td>";
            echo "<td>" . $dataproses['tanggal_selesai'] . "</td>";
            echo "</tr>";
          }
          ?>
        </table>
  </div>
  </div>
  <div class="row d-flex justify-content-center mt-5">
    <div class="col-lg-7">
    <h2>Laporan Selesai</h2>
        <table width='100%' class="table table-striped table-hover tabel-validasi">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Kecamatan</th>
              <th scope="col">Kekelurahan</th>
              <th scope="col">Jenis Kerusakan</th>
              <th scope="col">Tanggal laporan</th>
              <th scope="col">Tanggal pengerjaan</th>
              <th scope="col">Tanggal selesai</th>

            </tr>
          </thead>
          <?php
          while ($datapetugas = mysqli_fetch_array($laporanselesai)) {
            echo "<tr >";
            echo "<td>" . $datapetugas['nama_kecamatan'] . "</td>";
            echo "<td>" . $datapetugas['nama_kelurahan'] . "</td>";
            echo "<td>" . $datapetugas['nama_kerusakan'] . "</td>";
            echo "<td>" . $datapetugas['tanggal_laporan'] . "</td>";
            echo "<td>" . $datapetugas['tanggal_pengerjaan'] . "</td>";
            echo "<td>" . $datapetugas['tanggal_selesai'] . "</td>";
            echo "</tr>";
          }
          ?>
        </table>
  </div>
  </div>


  <footer>

  </footer>
</body>
<!-- <script  type="text/javascript">
$(document).ready(function() {
	$('.laporan-generate').dataTable({pageLength: 5,lengthChange: false,});

 } );
 
  
</script> -->


<?php
include 'chart.php';
?>

</html>