<?php
include 'koneksi.php';
include 'auth.php';


$tampil = "SELECT absensi.*, user.nm_user FROM absensi LEFT JOIN user ON absensi.id_user = user.id_user";
$hasil  = mysqli_query($koneksi, $tampil);

?>


<h1>Tabel Absensi</h1>
<div style="display: flex; justify-content: space-between; width: 88%; margin:10px 0;">
    <a href="index.php?page=absensi-input">
        <button>+ Tambah Absensi</button>
    </a>

    <!-- form filter -->

</div>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Jam Absen</th>
            <th>Tanggal Absen</th>
            <th>Kode Absen</th>
            <th>Jam Keluar</th>
            <th>Jam Lembur</th>
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
                <td><?= $row['nm_user']; ?></td>
                <td><?= $row['jam_absen']; ?></td>
                <td><?= $row['tanggal_absen']; ?></td>
                <td><?= $row['kode_absen']; ?></td>
                <td><?= $row['jam_keluar']; ?></td>
                <td><?= $row['jam_lembur']; ?></td>
                <td>
                    <button type="button"><a href="index.php?page=absensi-edit&id_absensi=<?= $row['id_absensi'] ?>">Edit</a></button>
                    <button type="button"><a href="index.php?page=absensi-hapus&id_absensi=<?= $row['id_absensi'] ?>">Hapus</a></button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>