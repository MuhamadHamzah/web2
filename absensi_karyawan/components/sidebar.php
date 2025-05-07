<!-- <ul>
    <li><a href="index.php?page=absensi">Tabel Absensi</a></li>
    <li><a href="index.php?page=user">Tabel Pengguna</a></li>
    <li><a href="index.php?page=bagian">Tabel Bagian</a></li>
</ul> -->

<?php
// include 'auth.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['level'] == 'Administator') {
?>
    <ul>
        <li><a href="index.php">Halaman Utama</a></li>
        <li><a href="index.php?page=user">Kelola User</a></li>
        <li><a href="index.php?page=bagian">Kelola Bagian</a></li>
        <li><a href="index.php?page=absensi">Laporan Absensi</a></li>
    </ul>
<?php
}

if ($_SESSION['level'] == 'Karyawan') {
?>
    <ul>
        <li><a href="index.php">Halaman Utama</a></li>
        <li><a href="index.php?page=absensi-karyawan">Absen</a></li>
        <li><a href="index.php?page=absensi-riwayat">Riwayat Absensi</a></li>
    </ul>
<?php
}
?>
<a href="logout.php">Logout</a>