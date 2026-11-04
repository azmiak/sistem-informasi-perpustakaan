<?php
session_start();
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "tubes_perpus");
$query = "select kode_admin from data_admin";
$query_run = mysqli_query($connection, $query);
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
$user_query = "select count(*) as jumlah_anggota from data_anggota";
$user_result = mysqli_query($connection, $user_query);
$user_row = mysqli_fetch_assoc($user_result);
$anggota = $user_row['jumlah_anggota'];
$book_query = "select count(*) as jumlah_buku from data_buku";
$book_result = mysqli_query($connection, $book_query);
$book_row = mysqli_fetch_assoc($book_result);
$buku = $book_row['jumlah_buku'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            transition: background-color 0.5s ease, color 0.5s ease;
        }

        .dark-theme {
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

        .dark-theme .card {
            background-color: #555;
            color: white;
        }

        .light-theme {
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

        .light-theme .card {
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
            <ul class="nav navbar-nav navbar-right">
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
        <h3 class="text-center">Data Buku Perpustakaan Azmi</h3>
        <canvas id="statusChart"></canvas>
        <div class="row">
            <div class="col-md-3" style="margin: auto">
                <div class="card" style="width: 300px">
                    <div class="card-header bg-success">Buku</div>
                    <div class="card-body">
                        <p class="card-text">Jumlah Buku: <?php echo $buku; ?></p>
                        <a class="btn btn-secondary" href="list_buku.php">List Buku</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="margin: auto">
                <div class="card" style="width: 300px">
                    <div class="card-header bg-danger">Anggota Terdaftar</div>
                    <div class="card-body">
                        <p class="card-text">Jumlah Anggota Terdaftar: <?php echo $anggota; ?></p>
                        <a class="btn btn-secondary" href="list_anggota.php">List Anggota</a>
                    </div>
                </div>
            </div>
        </div>
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
    <div class="theme-toggle">
        <button class="btn btn-dark" onclick="toggleTheme()">Toggle Theme</button>
    </div>
</body>

</html>