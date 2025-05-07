<?php
include 'koneksi.php';
include 'auth.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_bagian    = $_POST['nama_bagian'];
    $status_aktif   = $_POST['status_aktif'];

    $simpan = "INSERT INTO bagian (nama_bagian,status_aktif) VALUES ('$nama_bagian','$status_aktif')";

    if (mysqli_query($koneksi, $simpan)) {
        echo "<script>
        alert('Data berhasil Disimpan');
        window.location.href = 'index.php?page=bagian';
    </script>";
    } else {
        echo "Gagal menyimpan data : " . mysqli_errno($koneksi);
    }
}

?>

<h1>Tambah Data Bagian</h1>
<a href="index.php?page=bagian">
    <button>Kembali</button>
</a>

<form action="" method="post" id="form_input_bagian">
    <div>
        <label for="nama_bagian">Nama Bagian</label>
        <input type="text" id="nama_bagian" name="nama_bagian" required>
    </div>
    <div>
        <label for="status_aktif">Status Aktif</label>
        <select name="status_aktif" id="status_aktif" required>
            <option value="1" default>Aktif</option>
            <option value="2">Tidak Aktif</option>
        </select>
    </div>
    <button type="submit" value="Submit">Simpan</button>
</form>