<?php
// include database connection file
include_once("../koneksi.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	$bukti = $_POST['foto'];
	$selesai = date('Y-m-d', strtotime($_POST['selesai']));
	$result = mysqli_query($mysqli, "UPDATE penanganan_laporan SET tanggal_selesai='$selesai',
									 bukti_selesai='$bukti' WHERE id_penanganan=$id");
		
	
	
	// Redirect to homepage to display updated user in list
	 header("Location: teknisi.php");
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
$result = mysqli_query($mysqli, "SELECT * FROM penanganan_laporan
                                          inner join laporan_transaksi on(laporan_transaksi.id_laporan = penanganan_laporan.id_penanganan)
                                          inner join lokasi on(laporan_transaksi.id_lokasi = lokasi.id_lokasi)
                                          inner join jenis_kerusakan on(jenis_kerusakan.id_kerusakan = laporan_transaksi.id_kerusakan)
                                          where id_penanganan='$id'");
while($user_data = mysqli_fetch_array($result))
{
	$kelurahan = $user_data['nama_kecamatan'];
	$kecamatan = $user_data['nama_kelurahan'];
	$kerusakan = $user_data['nama_kerusakan'];
	$pengerjaan = $user_data['tanggal_pengerjaan'];
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
				<td>kerusakan</td>
				<td><input type="text" name="pengerjaan" value=<?php echo $pengerjaan;?> disabled></td>
			</tr>
			<tr> 
				<td>tanggal selesai</td>
				<td><input type="date" name="selesai"></td>
			</tr>
			<tr> 
				<td>bukti selesai</td>
				<td><input type="text" name="foto"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $id;?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
			<tr>
				<td>
				<a href="../index.php">Home</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>