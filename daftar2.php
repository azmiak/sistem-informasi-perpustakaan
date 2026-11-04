<?php
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"tubes_perpus");
	$query = "insert into data_anggota values('','$_POST[nama_anggota]','$_POST[password]','$_POST[nim]','$_POST[no_hp]','$_POST[alamat]')";
	$query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
	alert("Pendaftaran sukses, anda bisa login sekarang");
	window.location.href = "index.php";
</script>