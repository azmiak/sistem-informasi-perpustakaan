<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "tubes_perpus");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['kode_admin']) && isset($_POST['password'])) {
    $kode_admin = $_POST['kode_admin'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM data_admin WHERE kode_admin = '$kode_admin'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run && mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);

        if ($row['password'] == $password) {
            $_SESSION['nama_admin'] = $row['nama_admin'];
            $_SESSION['kode_admin'] = $row['kode_admin'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "<script type='text/javascript'>
                alert('Password salah');
                window.location.href = 'login_admin.php';
                </script>";
        }
    } else {
        echo "<script type='text/javascript'>
            alert('Kode Admin tidak ditemukan');
            window.location.href = 'login_admin.php';
            </script>";
    }
} else {
    echo "<script type='text/javascript'>
        alert('Mohon isi Kode dan Password');
        window.location.href = 'login_admin.php';
        </script>";
}
?>