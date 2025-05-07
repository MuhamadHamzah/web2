<?php
include 'koneksi.php';
include 'auth.php';

if ($_SESSION['level'] !== 'Karyawan') {
    echo "<script>alert('Akses hanya untuk karyawan'); window.location.href='index.php';</script>";
    exit;
}

$id_user = $_SESSION['id_user'];
// echo $id_user;

$tgl_hari_ini   = date('Y-m-d');
// $tgl_hari_ini   = '2024-05-02';
$tampil         = "SELECT * FROM absensi WHERE id_user = $id_user AND tanggal_absen = '$tgl_hari_ini'";
$hasil          = mysqli_query($koneksi, $tampil);
$data           = mysqli_fetch_assoc($hasil);
$jam_sekarang = date('H:i:s');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_absen'])) {
    $kode_absen = $_POST['kode_absen'];

    $cek = mysqli_query($koneksi, "SELECT * FROM absensi WHERE id_user = $id_user AND tanggal_absen = '$tgl_hari_ini'");
    if (mysqli_num_rows($cek) == 0) {
        mysqli_query($koneksi, "INSERT INTO absensi (id_user, tanggal_absen, jam_absen, kode_absen) 
            VALUES ($id_user, '$tgl_hari_ini', '$jam_sekarang', $kode_absen)");
        echo "<script>alert('Absensi berhasil!'); window.location='index.php?page=absensi-karyawan';</script>";
    } else {
        echo "<script>alert('Anda sudah absen hari ini!')</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_keluar'])) {
    $cek = mysqli_query($koneksi, "SELECT * FROM absensi WHERE id_user = $id_user AND tanggal_absen = '$tgl_hari_ini'");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($koneksi, "UPDATE absensi SET jam_keluar = '$jam_sekarang' WHERE id_user = '$id_user' AND tanggal_absen = '$tgl_hari_ini'");
        echo "<script>alert('Keluar berhasil!'); window.location='index.php?page=absensi-karyawan';</script>";
    } else {
        echo "<script>alert('Anda belum absen hari ini!')</script>";
    }
}
?>

<!-- Tombol untuk membuka modal -->
<button onclick="document.getElementById('modalAbsen').style.display='block'">Absen Sekarang</button>
<button onclick="document.getElementById('modalAbsenKeluar').style.display='block'">Keluar Sekarang</button>

<!-- Modal pop-up sederhana -->
<div id="modalAbsen" style="display:none; position:fixed; top:20%; left:35%; background:#fff; padding:20px; border:1px solid #ccc;">
    <h3>Isi Absen Tanggal <?= date('d/m/Y') ?></h3>
    <form action="" method="post">
        <label>Pilih Jenis Absen:</label><br>
        <select name="kode_absen" required>
            <option value="">-- Pilih --</option>
            <option value="1">Masuk</option>
            <option value="2">Izin</option>
            <option value="3">Sakit</option>
        </select><br><br>
        <button type="submit" name="submit_absen">Kirim</button>
        <button type="button" onclick="document.getElementById('modalAbsen').style.display='none'">Batal</button>
    </form>
</div>

<!-- Jam Keluar -->
<div id="modalAbsenKeluar" style="display:none; position:fixed; top:20%; left:35%; background:#fff; padding:20px; border:1px solid #ccc;">
    <h3>Isi Absen Tanggal <?= date('d/m/Y') ?></h3>
    <form action="" method="post">
        <button type="submit" name="submit_keluar">Absen Keluar</button>
        <button type="button" onclick="document.getElementById('modalAbsenKeluar').style.display='none'">Batal</button>
    </form>
</div>