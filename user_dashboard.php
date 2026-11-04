<?php
session_start();
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "tubes_perpus");
$query = "select nama_anggota from data_anggota";
$query_run = mysqli_query($connection, $query);
$books_query = "select judul_buku, penulis, penerbit, kategori, status from data_buku";
$books_query_run = mysqli_query($connection, $books_query);
$stat_query = "select status, count(*) as jumlah from data_buku group by status";
$stat_query_run = mysqli_query($connection, $stat_query);
$status = [];
$jumlah = [];
if ($query_run) {
    while ($row = mysqli_fetch_assoc($stat_query_run)) {
        $status[] = $row['status'];
        $jumlah[] = $row['jumlah'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <a class="navbar-brand" href="user_dashboard.php">Perpustakaan Azmi</a>
            </div>
            <ul class="nav navbar-nav navbar-left">
                <li class="nav-item">
                    <a class="nav-link" style="color: aqua" href="pinjam_buku.php">Pinjam Buku</a>
                </li>
            </ul>
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
    <span>
        <marquee>
            Ini adalah sistem manajemen perpustakaan. Perpustakaan buka jam 08:00 dan tutup jam 20:00
        </marquee>
    </span>
    <div class="container">
        <h3 class="text-center">Data Buku Perpustakaan Azmi</h3>
        <canvas id="statusChart"></canvas>
        <h2>Daftar Buku</h2>
        <table id="bookTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Kategori</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($books_query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($books_query_run)) {
                        echo "<tr>";
                        echo "<td>" . $row['judul_buku'] . "</td>";
                        echo "<td>" . $row['penulis'] . "</td>";
                        echo "<td>" . $row['penerbit'] . "</td>";
                        echo "<td>" . $row['kategori'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data buku</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="text-right">
            <a href="pinjam_buku.php" class="btn btn-secondary">Pinjam Buku</a>
        </div>
    </div>
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
            updateChartTheme();
        }

        const status = <?php echo json_encode($status); ?>;
        const jumlah = <?php echo json_encode($jumlah); ?>;

        const ctx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: status,
                datasets: [{
                    label: 'Jumlah Buku',
                    data: jumlah,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(54, 162, 235, 0.5)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        function updateChartTheme() {
            const body = document.body;
            const isDarkTheme = body.classList.contains('dark-theme');
            const tickColor = isDarkTheme ? 'white' : 'black';
            const gridColor = isDarkTheme ? 'rgba(255, 255, 255, 0.5)' : 'rgba(0, 0, 0, 0.5)';
            const fontColor = isDarkTheme ? 'white' : 'black';

            statusChart.options.scales.y.ticks.color = tickColor;
            statusChart.options.scales.y.grid.color = gridColor;
            statusChart.options.scales.x.ticks.color = tickColor;
            statusChart.options.scales.x.grid.color = gridColor;
            statusChart.options.plugins.legend.labels.color = fontColor;

            statusChart.update();
        }
        document.addEventListener('DOMContentLoaded', updateChartTheme);
    </script>
</body>

</html>