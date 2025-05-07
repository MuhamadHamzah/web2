<?php
include 'koneksi.php';
include 'auth.php';


$id_absensi     = $_GET['id_absensi'];
$tampil         = "SELECT * FROM absensi WHERE id_absensi = ('$id_absensi')";
$hasil          = mysqli_query($koneksi, $tampil);
$data           = mysqli_fetch_assoc($hasil);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user       = $_POST['id_user'];
    $jam_absen     = $_POST['jam_absen'];
    $tanggal_absen = $_POST['tanggal_absen'];
    $kode_absen    = $_POST['kode_absen'];
    $jam_keluar    = $_POST['jam_keluar'];
    $jam_lembur    = $_POST['jam_lembur'];

    $edit   = "UPDATE absensi SET id_user = '$id_user', jam_absen = '$jam_absen', tanggal_absen = '$tanggal_absen', kode_absen = '$kode_absen', jam_keluar = '$jam_keluar', jam_lembur = '$jam_lembur' WHERE id_absensi = '$id_absensi'";

    if (mysqli_query($koneksi, $edit)) {
        echo "<script>
        alert('Data berhasil Diedit');
        window.location.href = 'index.php?page=absensi';
    </script>";
    } else {
        echo "Gagal menyimpan data : " . mysqli_errno($koneksi);
    }
}

?>
<h1>Edit Data Absen</h1>
<a href="index.php?page=absensi">
    <button>Kembali</button>
</a>

<form action="" method="post">
    <div>
        <label for="id_user">Nama Lengkap</label>
        <input type="text" id="id_user" name="id_user" value="<?= $data['id_user'] ?>" required>
    </div>
    <div>
        <label for="jam_absen">Jam Absen</label>
        <input type="time" id="jam_absen" name="jam_absen" value="<?= $data['jam_absen'] ?>" required>
    </div>
    <div>
        <label for="tanggal_absen">Tanggal Absen</label>
        <input type="date" id="tanggal_absen" name="tanggal_absen" value="<?= $data['tanggal_absen'] ?>" required>
    </div>
    <div>
        <label for="kode_absen">Kode Absen</label>
        <select name="kode_absen" id="kode_absen">
            <option value="">-- Pilih Kode Absen --</option>
            <option value="1" <?= $data['kode_absen'] == "1" ? 'selected' : '' ?>>Hadir</option>
            <option value="2" <?= $data['kode_absen'] == "2" ? 'selected' : '' ?>>Izin</option>
            <option value="3" <?= $data['kode_absen'] == "3" ? 'selected' : '' ?>>Sakit</option>
            <option value="4" <?= $data['kode_absen'] == "4" ? 'selected' : '' ?>>Alfa</option>
        </select>
    </div>
    <div>
        <label for="jam_keluar">Jam Keluar</label>
        <input type="time" name="jam_keluar" id="jam_keluar" value="<?= $data['jam_keluar'] ?>">
    </div>
    <div>
        <label for="jam_lembur">Jam Lembur</label>
        <input type="time" name="jam_lembur" id="jam_lembur" value="<?= $data['jam_lembur'] ?>">
    </div>
    <button type="submit">Edit</button>
</form>