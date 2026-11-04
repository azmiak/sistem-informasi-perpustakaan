<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Anggota</title>
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
                <a class="navbar-brand" href="index.php">Perpustakaan Azmi</a>
            </div>
            <ul class="nav navbar-header navbar-right">
                <li class="nav-item">
                    <a class="nav-link" style="color: aqua" href="login_admin.php">Login Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: aqua" href="login_anggota.php">Login Anggota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: aqua" href="daftar.php">Daftar</a>
                </li>
            </ul>
        </div>
    </nav><br>

    <div class="col-md-3" id="main_content">
        <center>
            <h3>Login Anggota</h3>
        </center>
        <form action="login_anggota2.php" method="post">
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" class="form-control" required>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-secondary">Login</button>
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