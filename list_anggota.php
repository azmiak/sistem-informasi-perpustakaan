<?php
session_start();
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "tubes_perpus");
$query = "select kode_admin from data_admin";
$query_run = mysqli_query($connection, $query);
$members_query = "select nama_anggota, nim, no_hp, alamat from data_anggota";
$members_query_run = mysqli_query($connection, $members_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>List Anggota</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            transition: background-color 0.5s ease, color 0.5s ease;
        }

        .dark-theme {
            background-color: #333;
            color: white;
        }

        .dark-theme .dataTables_wrapper .dataTables_info {
            color: white;
        }

        .dark-theme .dataTables_wrapper .dataTables_length label {
            color: white;
        }

        .dark-theme .dataTables_wrapper .dataTables_filter {
            color: white;
        }

        .dark-theme .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: white;
            background-color: white;
            border-color: #333;
        }

        .dark-theme table.dataTable,
        .dark-theme th,
        .dark-theme td {
            background-color: #333;
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

        .light-theme table.dataTable,
        .light-theme th,
        .light-theme td {
            background-color: white;
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
            <ul class="nav navbar-nav navbar-left">
                <li class="nav-item">
                    <a class="nav-link" style="color: aqua" href="list_buku.php">List Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: aqua" href="list_anggota.php">List Anggota</a>
                </li>
            </ul>
            <ul class="nav navbar-header navbar-right">
                <li>
                    <a class="navbar-brand">Admin: <?php echo $_SESSION['kode_admin']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: aqua" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav><br>
    <div class="container">
        <h2>List Anggota</h2>
        <table id="bookTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Nomor HP</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($members_query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($members_query_run)) {
                        echo "<tr>";
                        echo "<td>" . $row['nama_anggota'] . "</td>";
                        echo "<td>" . $row['nim'] . "</td>";
                        echo "<td>" . $row['no_hp'] . "</td>";
                        echo "<td>" . $row['alamat'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data buku</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="theme-toggle">
        <button class="btn btn-dark" onclick="toggleTheme()">Toggle Theme</button>
    </div>
    <script>
        $(document).ready(function () {
            $('#bookTable').DataTable();
        });
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