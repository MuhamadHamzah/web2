<?php
require_once 'koneksi.php';
include 'auth.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Karyawan</title>
    <style>
        .container {
            display: grid;
            grid-template-columns: 20% 80%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <?php
            include_once './components/sidebar.php'
            ?>
        </div>
        <div class="main">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
            $path = "./pages/$page.php";

            if (file_exists($path)) {
                include $path;
            } else {
                echo "<h3>Halaman tidak ditemukan</h3>";
            }
            ?>
        </div>
    </div>
</body>

</html>