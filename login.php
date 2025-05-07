<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username ada
    $query = "SELECT * FROM user WHERE username = '$username'";
    $hasil = mysqli_query($koneksi, $query);
    $data  = mysqli_fetch_assoc($hasil);

    if ($data) {
        if (password_verify($password, $data['password'])) {
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['level'] = $data['level'];

            echo "<script>alert('Login berhasil'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Password salah');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body style="width : 100%; height: 100vh; display: flex; justify-content: center; align-items: center">
    <div sytle="width:100%;">
        <form action="" method="post" style="display: grid; gap:10px; ">
            <div style="display :grid;">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </div>
            <div style="display :grid;">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <button type="submit">Login</button>
        </form>

    </div>
</body>

</html>