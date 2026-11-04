<?php
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"tubes_perpus");
	$query = "insert into data_peminjaman values('','$_POST[nama_anggota]','$_POST[judul_buku]','$_POST[tanggal_peminjaman]','$_POST[tanggal_pengembalian]')";
	$query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
	alert("Peminjaman Berhasil, silakan ke perpustakaan untuk mengambil buku");
	window.location.href = "user_dashboard.php";
</script>