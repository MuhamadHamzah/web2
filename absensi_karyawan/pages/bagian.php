<?php
include 'koneksi.php';
include_once 'auth.php';

$tampil     = 'SELECT * FROM bagian WHERE deleted_at IS NULL';
$hasil      = mysqli_query($koneksi, $tampil);
?>

<h1>Tabel Data Bagian</h1>

<a href="index.php?page=bagian-input">
    <button>+ Tambah Bagian</button>
</a>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Bagian</th>
            <th>Status Aktif</th>
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
                <td><?= $row['nama_bagian']; ?></td>
                <td><?= ($row['status_aktif'] == 1 ? 'Aktif' : 'Tidak Aktif'); ?></td>
                <td>
                    <button><a href="index.php?page=bagian-edit&id_bagian=<?= $row['id_bagian'] ?>">Edit</a></button>
                    <button><a href="index.php?page=bagian-hapus&id_bagian=<?= $row['id_bagian'] ?>">Hapus</a></button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>