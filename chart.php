<?php
include_once('koneksi.php');
$datajan = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan WHERE tanggal_selesai BETWEEN '2022-01-01' AND '2022-01-31'")->fetch_array();
$datafeb = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan WHERE tanggal_selesai BETWEEN '2022-02-01' AND '2022-02-31'")->fetch_array();
$datamar = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan WHERE tanggal_selesai BETWEEN '2022-03-01' AND '2022-03-31'")->fetch_array();
$dataapr = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan WHERE tanggal_selesai BETWEEN '2022-04-01' AND '2022-04-31'")->fetch_array();
$datamei = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan WHERE tanggal_selesai BETWEEN '2022-05-01' AND '2022-05-31'")->fetch_array();
$datajun = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan WHERE tanggal_selesai BETWEEN '2022-06-01' AND '2022-06-31'")->fetch_array();
$datajul = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan WHERE tanggal_selesai BETWEEN '2022-07-01' AND '2022-07-31'")->fetch_array();
$dataaug = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan WHERE tanggal_selesai BETWEEN '2022-08-01' AND '2022-08-31'")->fetch_array();
$datasep = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan WHERE tanggal_selesai BETWEEN '2022-09-01' AND '2022-09-31'")->fetch_array();
$dataokt = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan WHERE tanggal_selesai BETWEEN '2022-10-01' AND '2022-10-31'")->fetch_array();
$datanov = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan WHERE tanggal_selesai BETWEEN '2022-11-01' AND '2022-11-31'")->fetch_array();
$datades = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan WHERE tanggal_selesai BETWEEN '2022-12-01' AND '2022-12-31'")->fetch_array();

$pie1val1 = mysqli_query($mysqli, "SELECT count(id_laporan) as reno FROM laporan_transaksi where id_petugas is null")->fetch_array();
$pie1val2 = mysqli_query($mysqli, "SELECT count(id_laporan) as reno FROM laporan_transaksi where id_petugas is not null")->fetch_array();
$pie2val1 = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan where bukti_selesai is null")->fetch_array();
$pie2val2 = mysqli_query($mysqli, "SELECT count(id_penanganan) as reno FROM penanganan_laporan where bukti_selesai is not null")->fetch_array();
?>
<script>

//bar
var xValues = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus", "September", "Oktober", "November", "Desember"];
var yValues = [ <?php echo $datajan['reno'] ?>,
                <?php echo $datafeb['reno'] ?>,
                <?php echo $datamar['reno'] ?>,
                <?php echo $dataapr['reno'] ?>,
                <?php echo $datamei['reno'] ?>,
                <?php echo $datajun['reno'] ?>,
                <?php echo $datajul['reno'] ?>,
                <?php echo $dataaug['reno'] ?>,
                <?php echo $datasep['reno'] ?>,
                <?php echo $dataokt['reno'] ?>,
                <?php echo $datanov['reno'] ?>,
                <?php echo $datades['reno'] ?>,
                ];
var barColors = ["red", "green","blue","orange","brown","red", "green","blue","orange","brown","red"];
new Chart("barchart1", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Rata Rata penyelesaian"
    }
  }
});



//pie

var pie1x = ["Belum tervalidasi","Tervalidasi"];
var pie1y = [<?php echo$pie1val1['reno']?>,<?php echo$pie1val2['reno']?>];
var pie1c = ["red","blue"];

new Chart("piechart1", {
  type: "pie",
  data: {
    labels: pie1x,
    datasets: [{
      backgroundColor: pie1c,
      data: pie1y
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Tervalidasi"
    }
  }
});
//pie 2
var pie2x = ["proses","selesai"];
var pie2y = [<?php echo$pie2val1['reno']?>,<?php echo$pie2val2['reno']?>];
var pie2c = ["red","blue"];
new Chart("piechart2", {
  type: "pie",
  data: {
    labels: pie2x,
    datasets: [{
      backgroundColor: pie2c,
      data: pie2y
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Pengerjaan"
    }
  }
});
</script>
