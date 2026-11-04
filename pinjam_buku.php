<?php
session_start();
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "tubes_perpus");
$query = "select nama_anggota from data_anggota";
$query_run = mysqli_query($connection, $query);
$books_query = "select judul_buku from data_buku where status = 'Tersedia'";
$books_query_run = mysqli_query($connection, $books_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pinjam Buku</title>
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
                    <a class="navbar-brand">User: <?php echo $_SESSION['nama_anggota']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: aqua" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav><br>
    <div class="col-md-3" id="main_content">
        <center>
            <h3>Pinjam Buku</h3>
        </center>
        <form action="pinjam_buku2.php" method="post">
        <input type="hidden" name="nama_anggota" value="<?php echo $_SESSION['nama_anggota']; ?>">
            <div class="form-group">
                <label for="judul_buku">Judul Buku</label>
                <select name="judul_buku" class="form-control" required>
                    <option value="">Pilih Buku</option>
                    <?php
                    if (mysqli_num_rows($books_query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($books_query_run)) {
                            echo "<option value='" . $row['judul_buku'] . "'>" . $row['judul_buku'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                <input type="date" name="tanggal_peminjaman" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                <input type="date" name="tanggal_pengembalian" class="form-control" required>
            </div>
            <a href="user_dashboard.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-secondary">Pinjam</button>
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