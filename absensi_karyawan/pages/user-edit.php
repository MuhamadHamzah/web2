<?php
include 'auth.php';
include 'koneksi.php';

$tampil_bagian  = "SELECT id_bagian, nama_bagian FROM bagian WHERE deleted_at IS NULL";
$hasil          = mysqli_query($koneksi, $tampil_bagian);

$id_user        = $_GET['id_user'];
$tampil         = "SELECT * FROM user WHERE id_user = ('$id_user')";
$hasil_tampil   = mysqli_query($koneksi, $tampil);
$data           = mysqli_fetch_assoc($hasil_tampil);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik             = $_POST['nik'];
    $username        = $_POST['username'];
    $nm_user         = $_POST['nm_user'];
    $password        = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // $password        = $_POST['password'];
    $no_telp         = $_POST['no_telp'];
    $email           = $_POST['email'];
    $level           = $_POST['jabatan'];
    $id_bagian       = $_POST['id_bagian'];
    $alamat          = $_POST['alamat'];
    $tgl_lahir       = $_POST['tgl_lahir'];
    $tgl_masuk_kerja = $_POST['tgl_masuk_kerja'];

    $edit   = "UPDATE user SET nik = '$nik', username = '$username', nm_user = '$nm_user', password='$password', no_telp = '$no_telp', email = '$email', level = '$level', id_bagian = '$id_bagian', alamat = '$alamat', tgl_lahir = '$tgl_lahir', tgl_masuk_kerja = '$tgl_masuk_kerja' WHERE id_user = '$id_user'";

    if (mysqli_query($koneksi, $edit)) {
        echo "<script>
            alert('Data berhasil Diedit');
            window.location.href = 'index.php?page=user';
        </script>";
    } else {
        echo "Gagal menyimpan data : " . mysqli_errno($koneksi);
    }
}
?>

<h1>Edit Data Pengguna</h1>
<a href="index.php?page=user">
    <button>Kembali</button>
</a>

<form action="" method="post" id="form_input_user">
    <div>
        <label for="nik">NIK</label>
        <input type="number" id="nik" name="nik" value="<?= $data['nik'] ?>" required>
    </div>
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= $data['username'] ?>">
    </div>
    <div>
        <label for="nm_user">Nama Lengkap</label>
        <input type="text" id="nm_user" name="nm_user" value="<?= $data['nm_user'] ?>" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" value="<?= $data['password'] ?>" required>
    </div>
    <div>
        <label for="no_telp">No Telp</label>
        <input type="number" id="no_telp" name="no_telp" value="<?= $data['no_telp'] ?>">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $data['email'] ?>">
    </div>
    <div>
        <label for="jabatan">Jabatan</label>
        <select name="jabatan" id="jabatan" required>
            <option value="">-- Pilih Jabatan --</option>
            <option value="Administator" <?= $data['level'] == "Administator" ? 'selected' : '' ?>>Administrator</option>
            <option value="HRD" <?= $data['level'] == "HRD" ? 'selected' : '' ?>>HRD</option>
            <option value="Karyawan" <?= $data['level'] == "Karyawan" ? 'selected' : '' ?>>Karyawan</option>
        </select>
    </div>
    <!-- <div>
        <label for="status">Status</label>
        <select name="status" id="status" disabled>
            <option value="n" default>Aktif</option>
            <option value="y">Blokir</option>
        </select>
    </div> -->
    <div>
        <label for="bagian">Bagian</label>
        <select name="id_bagian" id="bagian" required>
            <option value="">-- Pilih Bagian --</option>
            <?php
            while ($option_bagian = mysqli_fetch_assoc($hasil)) {
                $selected = ($option_bagian['id_bagian'] == $data['id_bagian']) ? 'selected' : '';
            ?>
                <option value="<?= $option_bagian['id_bagian'] ?>" <?= $selected ?>>
                    <?= $option_bagian['nama_bagian'] ?>
                </option>
            <?php
            }
            ?>
        </select>
    </div>
    <div>
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat"><?= htmlspecialchars($data['alamat']) ?></textarea>
    </div>
    <div>
        <label for="tgl_lahir">Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" id="tgl_lahir" value="<?= $data['tgl_lahir'] ?>" required>
    </div>
    <div>
        <label for="tgl_masuk_kerja">Tanggal Masuk Kerja</label>
        <input type="date" name="tgl_masuk_kerja" id="tgl_masuk_kerja" value="<?= $data['tgl_masuk_kerja'] ?>" required>
    </div>
    <button type="submit" value="Submit">Simpan</button>
</form>