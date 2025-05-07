<?php
include 'koneksi.php';
include 'auth.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user       = $_POST['id_user'];
    $jam_absen     = $_POST['jam_absen'];
    $tanggal_absen = $_POST['tanggal_absen'];
    $kode_absen    = $_POST['kode_absen'];
    $jam_keluar    = $_POST['jam_keluar'];
    $jam_lembur    = $_POST['jam_lembur'];

    $simpan   = "INSERT INTO absensi (id_user,jam_absen,tanggal_absen,kode_absen,jam_keluar,jam_lembur) VALUES ('$id_user','$jam_absen','$tanggal_absen','$kode_absen','$jam_keluar','$jam_lembur')";

    if (mysqli_query($koneksi, $simpan)) {
        echo "<script>
        alert('Data berhasil Disimpan');
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
        <select name="id_user" id="id_user">
            <option value="">-- Pilih Nama Karyawan --</option>
            <?php
            $tampil_user = mysqli_query($koneksi, "SELECT id_user,nm_user FROM user WHERE blokir = 'n'");
            while ($nama = mysqli_fetch_assoc($tampil_user)) {
            ?>
                <option value="<?= $nama['id_user'] ?>"><?= $nama['nm_user'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div>
        <label for="jam_absen">Jam Absen</label>
        <input type="time" id="jam_absen" name="jam_absen" required>
    </div>
    <div>
        <label for="tanggal_absen">Tanggal Absen</label>
        <input type="date" id="tanggal_absen" name="tanggal_absen" required>
    </div>
    <div>
        <label for="kode_absen">Kode Absen</label>
        <select name="kode_absen" id="kode_absen">
            <option value="">-- Pilih Kode Absen --</option>
            <option value="1">Hadir</option>
            <option value="2">Izin</option>
            <option value="3">Sakit</option>
            <option value="4">Alfa</option>
        </select>
    </div>
    <div>
        <label for="jam_keluar">Jam Keluar</label>
        <input type="time" name="jam_keluar" id="jam_keluar">
    </div>
    <div>
        <label for="jam_lembur">Jam Lembur</label>
        <input type="time" name="jam_lembur" id="jam_lembur">
    </div>
    <button type="submit">Simpan</button>
</form>