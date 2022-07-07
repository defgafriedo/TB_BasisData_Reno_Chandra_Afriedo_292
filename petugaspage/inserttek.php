<?php
// include database connection file
include_once("../koneksi.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	$teknisi = $_POST['teknisi'];
	$pengerjaan = date('Y-m-d', strtotime($_POST['mulai']));
	$result2 = mysqli_query($mysqli, "INSERT INTO `penanganan_laporan`(`id_penanganan`, `id_teknisi`, `tanggal_pengerjaan`) 
	VALUES ($id,$teknisi,'$pengerjaan')");
		
	
	
	// Redirect to homepage to display updated user in list
	 header("Location: petugas.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
if(isset($_POST['id'])){
	$id = $_POST['id'];
}
else{
	$id = $_GET['id'];
}


 
// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM laporan_transaksi 
        inner join lokasi on(laporan_transaksi.id_lokasi = lokasi.id_lokasi)
        inner join jenis_kerusakan on(jenis_kerusakan.id_kerusakan = laporan_transaksi.id_kerusakan)
        where id_laporan='$id'");
 
while($user_data = mysqli_fetch_array($result))
{
	$kelurahan = $user_data['nama_kecamatan'];
	$kecamatan = $user_data['nama_kelurahan'];
	$kerusakan = $user_data['nama_kerusakan'];
}
?>
<html>
<head>	
	<title>Edit User Data</title>
</head>
 
<body>
	
	<br/><br/>
	
	<form name="inserttek.php" method="post" action="inserttek.php">
		<table border="0" align="center">
			<tr> 
				<td>kecamatan</td>
				<td><input type="text" name="kecamatan" value=<?php echo $kecamatan;?> disabled></td>
			</tr>
			<tr> 
				<td>kelurahan</td>
				<td><input type="text" name="kelurahan" value=<?php echo $kelurahan;?> disabled></td>
			</tr>
			<tr> 
				<td>kerusakan</td>
				<td><input type="text" name="kerusakan" value=<?php echo $kerusakan;?> disabled></td>
			</tr>
			<tr> 
			<td>Nama Teknisi *</td>
			<td><select name="teknisi">
				<?php
				$tek = mysqli_query($mysqli, "SELECT * FROM teknisi");
				while($tekres = mysqli_fetch_array($tek)) { 
					echo "<option value=".$tekres['id_teknisi'].">".$tekres['nama_teknisi']."</option>";
				}
				?>
                </select ></td>
			</tr>
			<tr> 
				<td>tanggal mulai</td>
				<td><input type="date" name="mulai"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $id;?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
			<tr>
				<td>
				<a href="index.php">Home</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>