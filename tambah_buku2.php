<?php
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"tubes_perpus");
	$query = "insert into data_buku values('','$_POST[judul_buku]','$_POST[penulis]','$_POST[penerbit]','$_POST[kategori]','$_POST[status]')";
	$query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
	alert("Data buku berhasil ditambahkan");
	window.location.href = "list_buku.php";
</script>