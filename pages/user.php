<?php
include 'auth.php';
include 'koneksi.php';


if ($_SESSION['level'] !== 'Administator') {
    echo "<script>alert('Akses hanya untuk Admin'); window.location.href='index.php';</script>";
    exit;
}

$cari          = isset($_GET['cari']) ? $_GET['cari'] : '';
$filter_bagian = isset($_GET['filter_bagian']) ? $_GET['filter_bagian'] : '';

$tampil     = "SELECT user.*, bagian.nama_bagian FROM user LEFT JOIN bagian ON user.id_bagian = bagian.id_bagian WHERE user.deleted_at IS NULL";

$kondisi = [];
if (!empty($cari)) {
    $kondisi[] = "user.nm_user LIKE '%$cari%' OR user.level LIKE '%$cari' OR bagian.nama_bagian LIKE '%$cari%' OR user.alamat LIKE '%$cari%'";
}
// if (!empty($filter_bagian)) {
//     $kondisi[] = "user.id_bagian = '$filter_bagian'";
// }
if (!empty($kondisi)) {
    $tampil .= " AND " . implode($kondisi);
}


$sort       = isset($_GET['sort']) ? $_GET['sort'] : '';

if ($sort == 'az') {
    $tampil .= ' ORDER BY user.nm_user ASC';
} elseif ($sort == 'za') {
    $tampil .= ' ORDER BY user.nm_user DESC';
} elseif ($sort == 'jabatan') {
    $tampil .= ' ORDER BY user.level ASC';
} elseif ($sort == 'bagian') {
    $tampil .= ' ORDER BY bagian.nama_bagian ASC';
} else {
    $tampil .= ' ORDER BY id_user ASC';
}

$cari_bagian = mysqli_query($koneksi, 'SELECT * FROM bagian WHERE deleted_at IS NULL');
$hasil      = mysqli_query($koneksi, $tampil);

// echo $tampil;
// echo $_SESSION['level'];

?>

<h1>Tabel Pengguna</h1>
<div style="display: flex; justify-content: space-between; width: 88%; margin:10px 0;">

    <div>
        <a href="index.php?page=user-input">
            <button>+ Tambah Pengguna</button>
        </a>
    </div>

    <!-- form filter -->
    <div>
        <form action="" method="get" style="display: flex; gap: 10px;" id="cari">
            <input type="hidden" name="page" value="user">
            <div style="display: grid;">
                <label for="cari">Cari</label>
                <input type="text" id="cari" name="cari" onchange="document.getElementById('cari').submit()" ;>
            </div>
            <!-- <div style="display: grid;">
                <label for="filter_bagian">Filter Bagian</label>
                <select name="filter_bagian" id="filter_bagian">
                    <option value="">-- Pilih Bagian --</option>
                    ?php
                    //while ($option = mysqli_fetch_assoc($cari_bagian)) { ?>
                        <option value="?= $option['id_bagian'] ?>">?= $option['nama_bagian'] ?></option>
                    //?php
                    // }
                    // ?>
                </select>
            </div> -->

            <button type="submit" style=" padding: 0 20px;">Cari</button>

        </form>

        <form action="" id="form_sort" method="get" style="display: flex;">
            <input type="hidden" name="page" value="user">
            <div style="display: grid; margin: 10px 0;">
                <label for="sort">Sort By :</label>
                <select name="sort" id="sort" onchange="document.getElementById('form_sort').submit();">
                    <option value=" ">-- Pilih sorting --</option>
                    <option value="az" <?= ($sort == 'az') ? 'selected' : '' ?>>A - Z</option>
                    <option value="za" <?= ($sort == 'za') ? 'selected' : '' ?>>Z - A</option>
                    <option value="jabatan" <?= ($sort == 'jabatan') ? 'selected' : '' ?>>Jabatan</option>
                    <option value="bagian" <?= ($sort == 'bagian') ? 'selected' : '' ?>>Bagian</option>
                </select>
            </div>
            <!-- <button type="submit">Sort</button> -->
        </form>
    </div>
</div>



<!-- tabel data user -->
<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nik</th>
            <th>Username</th>
            <th>Nama Lengkap</th>
            <th>No Telp</th>
            <th>Email</th>
            <th>Jabatan</th>
            <th>Status</th>
            <th>Bagian</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Tanggal Masuk Kerja</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($hasil)) {
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nik']; ?></td>
                <td><?= $row['username']; ?></td>
                <td><?= $row['nm_user']; ?></td>
                <td><?= $row['no_telp']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['level']; ?></td>
                <td><?= ($row['blokir'] == 'n') ? 'Aktif' : 'Blokir'; ?></td>
                <td><?= $row['nama_bagian']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td><?= $row['tgl_lahir']; ?></td>
                <td><?= $row['tgl_masuk_kerja']; ?></td>
                <td>
                    <button type="button"><a href="index.php?page=user-edit&id_user=<?= $row['id_user'] ?>">Edit</a></button>
                    <button type="button"><a href="index.php?page=user-hapus&id_user=<?= $row['id_user'] ?>">Hapus</a></button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>