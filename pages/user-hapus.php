<?php
include 'koneksi.php';
include 'auth.php';


$tampil_bagian  = "SELECT id_bagian, nama_bagian FROM bagian WHERE deleted_at IS NULL";
$hasil          = mysqli_query($koneksi, $tampil_bagian);

$id_user        = $_GET['id_user'];
$tampil         = "SELECT * FROM user WHERE id_user = ('$id_user')";
$hasil_tampil   = mysqli_query($koneksi, $tampil);
$data           = mysqli_fetch_assoc($hasil_tampil);
$tgl_hapus      = date('Y-m-d H:i:s');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik             = $_POST['nik'];
    $username        = $_POST['username'];
    $nm_user         = $_POST['nm_user'];
    $password        = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $no_telp         = $_POST['no_telp'];
    $email           = $_POST['email'];
    $level           = $_POST['jabatan'];
    $id_bagian       = $_POST['id_bagian'];
    $alamat          = $_POST['alamat'];
    $tgl_lahir       = $_POST['tgl_lahir'];
    $tgl_masuk_kerja = $_POST['tgl_masuk_kerja'];

    $hapus   = "UPDATE user SET deleted_at = '$tgl_hapus' WHERE id_user = '$id_user'";

    if (mysqli_query($koneksi, $hapus)) {
        echo "<script>
            alert('Data berhasil Dihapus');
            window.location.href = 'index.php?page=user';
        </script>";
    } else {
        echo "Gagal menyimpan data : " . mysqli_errno($koneksi);
    }
}
?>

<h1>Tambah Data Pengguna</h1>
<a href="index.php?page=user">
    <button>Kembali</button>
</a>

<form action="" method="post" id="form_input_user">
    <div>
        <label for="nik">NIK</label>
        <input type="number" id="nik" name="nik" value="<?= $data['nik'] ?>" required disabled>
    </div>
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= $data['username'] ?>" disabled>
    </div>
    <div>
        <label for="nm_user">Nama Lengkap</label>
        <input type="text" id="nm_user" name="nm_user" value="<?= $data['nm_user'] ?>" required disabled>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" value="<?= $data['password'] ?>" required disabled>
    </div>
    <div>
        <label for="no_telp">No Telp</label>
        <input type="number" id="no_telp" name="no_telp" value="<?= $data['no_telp'] ?>" disabled>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $data['email'] ?>" disabled>
    </div>
    <div>
        <label for="jabatan">Jabatan</label>
        <select name="jabatan" id="jabatan" required disabled>
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
        <select name="id_bagian" id="bagian" required disabled>
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
        <textarea name="alamat" id="alamat" disabled><?= htmlspecialchars($data['alamat']) ?></textarea>
    </div>
    <div>
        <label for="tgl_lahir">Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" id="tgl_lahir" value="<?= $data['tgl_lahir'] ?>" required disabled>
    </div>
    <div>
        <label for="tgl_masuk_kerja">Tanggal Masuk Kerja</label>
        <input type="date" name="tgl_masuk_kerja" id="tgl_masuk_kerja" value="<?= $data['tgl_masuk_kerja'] ?>" required disabled>
    </div>
    <button type="submit" value="Submit">Hapus</button>
</form>