<!DOCTYPE html>
<html>
<head>
	<title>Halaman Wali Kelas</title>
    <script type="text/javascript" src="Charts/Chart.js"></script>
</head>
<body>
    <style type="text/css">
	body{
		font-family: roboto;
	}
 
	table{
		margin: 0px auto;
	}
	</style>
    
	<?php 
	session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:index.php?pesan=gagal");
	}
 
	?>
	<h1>Halaman Wali Kelas</h1>
 
	<p>Halo <b><?php echo $_SESSION['username']; ?></b> Anda telah login sebagai <b><?php echo $_SESSION['level']; ?></b>.</p>
	<a href="logout.php">LOGOUT</a>

    <?php 
	include 'koneksi.php';
	?>
 
    <div style="width: 800px;margin: 0px auto;">
		<canvas id="myChart"></canvas>
	</div>

	<br/>
	<br/>

    <table border="1">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Siswa</th>
				<th>Kelas</th>
				<th>Jenis Kelamin</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			$data = mysqli_query($koneksi,"select * from siswa");
			while($d=mysqli_fetch_array($data)){
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['nama']; ?></td>
					<td><?php echo $d['kelas']; ?></td>
					<td align="center" bgcolor="pink"><?php echo $d['jk']; ?></td>
				</tr>
				<?php 
			}
			?>
		</tbody>
	</table>
 
 
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: ["Laki-laki", "Perempuan"],
				datasets: [{
					label: '',
					data: [
					<?php 
					$jumlah_laki = mysqli_query($koneksi,"select * from siswa where jk='Laki-laki'");
					echo mysqli_num_rows($jumlah_laki);
					?>, 
					<?php 
					$jumlah_perempuan = mysqli_query($koneksi,"select * from siswa where jk='Perempuan'");
					echo mysqli_num_rows($jumlah_perempuan);
					?>
					],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>