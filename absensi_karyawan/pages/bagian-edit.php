<?php
include 'koneksi.php';
include 'auth.php';


$id_bagian  = $_GET['id_bagian'];
$tampil     = "SELECT * FROM bagian WHERE id_bagian = ('$id_bagian')";
$hasil      = mysqli_query($koneksi, $tampil);
$data       = mysqli_fetch_assoc($hasil);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_bagian    = $_POST['nama_bagian'];
    $status_aktif   = $_POST['status_aktif'];

    $edit = "UPDATE bagian SET nama_bagian = '$nama_bagian', status_aktif = '$status_aktif' WHERE id_bagian ='$id_bagian' ";

    if (mysqli_query($koneksi, $edit)) {
        echo "<script>
        alert('Data berhasil Disimpan');
        window.location.href = 'index.php?page=bagian';
    </script>";
    } else {
        echo "Gagal menyimpan data : " . mysqli_errno($koneksi);
    }
}

?>

<h1>Edit Data Bagian - <?= $data['nama_bagian'] ?></h1>
<a href="index.php?page=bagian">
    <button>Kembali</button>
</a>

<form action="" method="post" id="form_input_bagian">
    <div>
        <label for="nama_bagian">Nama Bagian</label>
        <input type="text" id="nama_bagian" name="nama_bagian" value="<?= $data['nama_bagian'] ?>" required>
    </div>
    <div>
        <label for="status_aktif">Status Aktif</label>
        <select name="status_aktif" id="status_aktif" required>
            <option value="1" <?= $data['status_aktif'] == 1 ? 'selected' : '' ?> default>Aktif</option>
            <option value="2" <?= $data['status_aktif'] == 2 ? 'selected' : '' ?>>Tidak Aktif</option>
        </select>
    </div>
    <button type="submit" value="Submit">Simpan</button>
</form>