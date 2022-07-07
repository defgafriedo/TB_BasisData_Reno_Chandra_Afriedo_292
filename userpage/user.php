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

  <title>user</title>

</head>

<body>

  <header>
    <h2><a href="../index.php" class="btn btn-outline-light  mt-3 text-light">RAPITTER</a></h2>
    <h3>
      <?php
      if ($_SESSION['level'] == 'user') {
        echo "<a href='laporan.php' class='btn btn-light btn-lg active mt-3 mb-0'>Form Laporan</a>";
        echo "<a href='../pages/logout.php' class='btn btn-light mt-3 mb-0'>logout</a>";
      }
      if ($_SESSION['level'] == 'petugas') {
        echo "<a href='teknisi.php' class='btn btn-light mt-3 mb-0'>teknisi</a>";
        echo "<a href='petugas.php' class='btn btn-light btn-lg active mt-3 mb-0'>petugas</a>";
        echo "<a href='logout.php' class='btn btn-light mt-3 mb-0'>logout</a>";
      }
      if ($_SESSION['level'] == 'teknisi') {
        echo "<a href'teknisi.php' class='btn btn-light mt-3 mb-0'>teknisi</a>";
        echo "<a href='logout.php' class='btn btn-light mt-3 mb-0'>logout</a>";
      }
      ?>
    </h3>
    </nav>
  </header>
  <div class="row row d-flex justify-content-center mt-5 mb-6">
    <div class="col-lg-5">
      <h2>Form Laporan</h2>
      <table class="table table-striped table-hover">
        <form action="insertlap.php" method="post">
          <tr>
            <td>lokasi kelurahan</td>
            <td>
              <select name="lokasi">
                <?php
                include_once("../koneksi.php");
                $tek = mysqli_query($mysqli, "SELECT * FROM lokasi");
                while ($tekres = mysqli_fetch_array($tek)) {
                  echo "<option value=" . $tekres['id_lokasi'] . ">
                  Kecamatan :  " . $tekres['nama_kecamatan'] . "  || 
                  Kelurahan :  " . $tekres['nama_kelurahan'] . "                    
                  </option>";
                }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>Jenis kerusakan</td>
            <td>
              <select name="jenis">
                <?php
                $tek = mysqli_query($mysqli, "SELECT * FROM jenis_kerusakan");
                while ($tekres = mysqli_fetch_array($tek)) {
                  echo "<option value=" . $tekres['id_kerusakan'] . ">" . $tekres['nama_kerusakan'] . "                    
                  </option>";
                }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td><input type="date" name="tanggal" id=""></td>
          </tr>
          <tr>
            <td>Bukti*</td>
            <td><input type="text" name="bukti" id=""></td>
          </tr>
          <tr>
            <td><input type="hidden" name="id" value=<?php echo $id; ?>></td>
            <td><input mame="ok" type="submit" value="SUBMIT"></td>
          </tr>
        </form>
      </table>
    </div>
    <div class="col-lg-6">
      <?php
      $laporan = mysqli_query($mysqli, "SELECT * FROM laporan_transaksi 
       inner join lokasi on(laporan_transaksi.id_lokasi = lokasi.id_lokasi)
       inner join jenis_kerusakan on(jenis_kerusakan.id_kerusakan = laporan_transaksi.id_kerusakan)
       where id_user = '$id';
        "); ?>

      <h2>Daftar Laporan</h2>
      <table width='100%' class="table table-striped table-hover teknisipage">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Kecamatan</th>
            <th scope="col">Kekelurahan</th>
            <th scope="col">alamat_detail</th>
            <th scope="col">Jenis Kerusakan</th>
            <th scope="col">tanggal laporan</th>
            <th scope="col">status</th>
          </tr>
        </thead>
        <?php
        while ($laporanarr = mysqli_fetch_array($laporan)) {
          echo "<tr >";
          echo "<td>" . $laporanarr['nama_kecamatan'] . "</td>";
          echo "<td>" . $laporanarr['nama_kelurahan'] . "</td>";
          echo "<td>" . $laporanarr['alamat_detail'] . "</td>";
          echo "<td>" . $laporanarr['nama_kerusakan'] . "</td>";
          echo "<td>" . $laporanarr['tanggal_laporan'] . "</td>";
          if($laporanarr['id_petugas']==null){
            echo "<td>menunggu</td>";
          }
          else{
            echo "<td>diproses</td>";
          }
        }
        ?>
      </table>
    </div>
  </div>
  <footer>

  </footer>
</body>

<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('.laporan-generate').dataTable({
      pageLength: 5,
      lengthChange: false,
    });
  });
</script>

</html>