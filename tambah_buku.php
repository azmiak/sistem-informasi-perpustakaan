<?php
session_start();
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "tubes_perpus");
$query = "select nama_admin from data_admin";
$query_run = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tambah Buku</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            transition: background-color 0.5s ease, color 0.5s ease;
        }

        #main_content {
            margin: auto;
        }

        .dark-theme {
            background-color: #333;
            color: white;
        }

        .dark-theme table,
        .dark-theme th,
        .dark-theme td {
            color: white;
        }

        .dark-theme .btn {
            background-color: white;
            color: black;
        }

        .dark-theme .btn:hover {
            background-color: black;
            color: white;
        }

        .light-theme {
            background-color: white;
            color: black;

        }

        .light-theme table,
        .light-theme th,
        .light-theme td {
            color: black;
        }

        .light-theme .btn {
            background-color: black;
            color: white;
        }

        .light-theme .btn:hover {
            background-color: white;
            color: black;
        }

        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
</head>

<body class="<?php echo isset($_SESSION['theme']) ? $_SESSION['theme'] : 'dark-theme'; ?>">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="admin_dashboard.php">Perpustakaan Azmi</a>
            </div>
            <ul class="nav navbar-header navbar-right">
                <li>
                    <a class="navbar-brand">Admin: <?php echo $_SESSION['nama_admin']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: aqua" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav><br>
    <div class="col-md-3" id="main_content">
        <center>
            <h3>Tambah Data Buku</h3>
        </center>
        <form action="tambah_buku2.php" method="post">
            <div class="form-group">
                <label for="judul_buku">Judul Buku</label>
                <input type="text" name="judul_buku" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" name="penulis" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="penerbit">Penerbit</label>
                <input type="text" name="penerbit" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <input type="radio" id="tersedia" name="status" value="Tersedia" required>
                <label for="tersedia">Tersedia</label>
                <input type="radio" id="dipinjam" name="status" value="Dipinjam" required>
                <label for="dipinjam">Dipinjam</label>
                <input type="radio" id="tidak_tersedia" name="status" value="Tidak Tersedia" required>
                <label for="tidak_tersedia">Tidak Tersedia</label>
            </div>
            <a href="list_buku.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-secondary">Simpan</button>
        </form>
    </div>
    <div class="theme-toggle">
        <button class="btn btn-dark" onclick="toggleTheme()">Toggle Theme</button>
    </div>
    <script>
        function toggleTheme() {
            const body = document.body;
            const isDarkTheme = body.classList.contains('dark-theme');
            const newTheme = isDarkTheme ? 'light-theme' : 'dark-theme';
            body.classList.toggle('dark-theme');
            body.classList.toggle('light-theme');
            $.ajax({
                url: 'save_theme.php',
                method: 'POST',
                data: { theme: newTheme },
                success: function (response) {
                    console.log('Theme saved:', response);
                },
                error: function (error) {
                    console.error('Error saving theme:', error);
                }
            });
        }
    </script>
</body>

</html>