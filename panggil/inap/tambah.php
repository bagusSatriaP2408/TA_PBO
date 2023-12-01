<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		form, table{
			border: 3px solid #f1f1f1;
			background-color: white;
			font-family: arial;
			width: 500px;
			margin: auto;
			padding: 20px;
		}
	</style>
</head>
<body>

</body>
</html>

<?php
error_reporting(0);
	require_once('koneksi.php');

	if($_POST){
		try {
			$date1 = $_POST['tgl_masuk'];
			$date2 = $_POST['tgl_keluar'];
			
			$lama = ((abs(strtotime ($date2) - strtotime ($date1)))/(60*60*24));
				
			$sql = "INSERT INTO inap (id_inap, tgl_masuk, tgl_keluar, lama, id_pasien, id_kamar) VALUES (null, '$date1', '$date2', $lama, {$_POST['id_pasien']}, {$_POST['id_kamar']})";

			if(!$koneksi->query($sql)){
				echo $koneksi->error;
				die();
			}
		} catch (Exception $error) {
			echo $error;
			die();
		}
		
		header("Location: index.php?lihat=inap/index");
	}
?>

<!-- start row -->
<div class="row">
	<!-- start col -->
	<div class="col-lg-6">
		
		<h3 class = "text-primary">Tambah Data Rawat Inap</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<!-- start form -->
		<form action="" method="POST">

			<div class="form-group">
				<label>Nama Pasien</label>
				<select class="form-control" name="id_pasien">
					<?php $result = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY id_pasien"); ?>
					<option value="0">--pilih pasien--</option>
					<?php while ($row = mysqli_fetch_assoc($result)): ?>
						<option value="<?= $row['id_pasien']; ?>"><?= $row['nama_pasien']; ?></option>
					<?php endwhile; ?>
				</select>
			</div>
				
			<div class="form-group">
				<label>Tanggal Masuk</label>
				<input type="date" class="form-control" id="combo_masuk" name="tgl_masuk" required>
			</div>

			<div class="form-group">
				<label>Tanggal Keluar</label>
				<input type="date" class="form-control" id="combo_keluar" name="tgl_keluar">
			</div>		

			<div class="form-group">
				<label>Kamar</label>
				<select class="form-control" name="id_kamar">
					<?php $result= mysqli_query($koneksi, "SELECT * FROM kamar ORDER BY id_kamar"); ?>
					<option value="0">--pilih kamar--</option>
					<?php while ($row = mysqli_fetch_assoc($result)): ?>
						<option value="<?= $row['id_kamar']; ?>"><?= $row['nama_kamar']; ?></option>
					<?php endwhile; ?>
				</select>
			</div>

			<button type="submit" class="btn btn-success">
				<span class="glyphicon glyphicon-floppy-disk"></span> Simpan
			</button>

		</form>
		<!-- end form -->
	</div>
	<!-- end col -->
</div>
<!-- end row -->

