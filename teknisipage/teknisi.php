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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <title>teknisi</title>

</head>

<body>
  <?php
  // Create database connection using config file
  include_once("../koneksi.php");

  // Fetch all users data from database
  if ($_SESSION['level'] == 'teknisi') {
    $laporanpetugas = mysqli_query($mysqli, "SELECT * FROM penanganan_laporan
                                          inner join laporan_transaksi on(laporan_transaksi.id_laporan = penanganan_laporan.id_penanganan)
                                          inner join lokasi on(laporan_transaksi.id_lokasi = lokasi.id_lokasi)
                                          inner join jenis_kerusakan on(jenis_kerusakan.id_kerusakan = laporan_transaksi.id_kerusakan)
                                          where id_teknisi='$id'");
  }
  else{
    $laporanpetugas = mysqli_query($mysqli, "SELECT * FROM penanganan_laporan
                                          inner join laporan_transaksi on(laporan_transaksi.id_laporan = penanganan_laporan.id_penanganan)
                                          inner join lokasi on(laporan_transaksi.id_lokasi = lokasi.id_lokasi)
                                          inner join jenis_kerusakan on(jenis_kerusakan.id_kerusakan = laporan_transaksi.id_kerusakan)");
  }
  ?>
  <header>
    <h2><a href="../index.php" class="btn btn-outline-light  mt-3 text-light">RAPITTER</a></h2>
    <h3>
      <?php
      if ($_SESSION['level'] == 'petugas') {
        echo "<a href='teknisi.php' class='btn btn-light btn-lg active mt-3 mb-0'>teknisi</a>";
        echo "<a href='../petugaspage/petugas.php' class='btn btn-light mt-3 mb-0'>petugas</a>";
        echo "<a href='../pages/logout.php' class='btn btn-light mt-3 mb-0'>logout</a>";
      }
      if ($_SESSION['level'] == 'teknisi') {
        echo "<a href'teknisi.php' class='btn btn-light btn-lg active mt-3 mb-0'>teknisi</a>";
        echo "<a href='../pages/logout.php' class='btn btn-light mt-3 mb-0'>logout</a>";
      }
      ?>
    </h3>
    </nav>
  </header>

  <body>
    <div class="row d-flex justify-content-center mt-3">
      <div class="col-lg-11">
        <h2>PENGERJAAN</h2>
        <table width='100%' class="table table-striped table-hover tabel-validasi">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Kecamatan</th>
              <th scope="col">Kekelurahan</th>
              <th scope="col">Jenis Kerusakan</th>
              <th scope="col">Jenis Kerusakan</th>
              <th scope="col">Tanggal pengerjaan</th>
              <th scope="col">Tanggal selesai</th>
              <th scope="col">bukti</th>
              <th scope="col">update</th>

            </tr>
          </thead>
          <?php
          while ($datapetugas = mysqli_fetch_array($laporanpetugas)) {
            echo "<tr >";
            echo "<td>" . $datapetugas['nama_kecamatan'] . "</td>";
            echo "<td>" . $datapetugas['nama_kelurahan'] . "</td>";
            echo "<td>" . $datapetugas['nama_kerusakan'] . "</td>";
            echo "<td>" . $datapetugas['tanggal_laporan'] . "</td>";
            echo "<td>" . $datapetugas['tanggal_pengerjaan'] . "</td>";
            echo "<td>" . $datapetugas['tanggal_selesai'] . "</td>";
            echo "<td>" . $datapetugas['bukti_selesai'] . "</td>";
            echo "<td>";
            if($_SESSION['level'] == 'teknisi'){
              echo"<a href='inserttek.php?id=$datapetugas[id_penanganan]' class='btn btn-primary'>proses</a>";
            }
            else{

            }
            echo "</td>";
            
            echo "</tr>";
          }
          ?>
        </table>
      </div>
    </div>
  </body>


  <footer>

  </footer>
</body>

</html>