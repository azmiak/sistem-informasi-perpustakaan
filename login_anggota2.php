<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "tubes_perpus");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['nim']) && isset($_POST['password'])) {
    $nim = $_POST['nim'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM data_anggota WHERE nim = '$nim'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run && mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);

        if ($row['password'] == $password) {
            $_SESSION['nama_anggota'] = $row['nama_anggota'];
            $_SESSION['nim'] = $row['nim'];
            header("Location: user_dashboard.php");
            exit();
        } else {
            echo "<script type='text/javascript'>
                alert('Password salah');
                window.location.href = 'login_anggota.php';
                </script>";
        }
    } else {
        echo "<script type='text/javascript'>
            alert('NIM tidak ditemukan');
            window.location.href = 'login_anggota.php';
            </script>";
    }
} else {
    echo "<script type='text/javascript'>
        alert('Mohon isi NIM dan Password');
        window.location.href = 'login_anggota.php';
        </script>";
}
?>