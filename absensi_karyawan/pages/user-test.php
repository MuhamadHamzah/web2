<?php
// koneksi ke database
include 'koneksi.php';

// ambil pengaturan perusahaan
$pengaturan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pengaturan LIMIT 1"));

// ambil data user
$user = mysqli_query($koneksi, "SELECT user.*, bagian.nama_bagian FROM user 
    LEFT JOIN bagian ON user.id_bagian = bagian.id_bagian
    WHERE user.blokir = 'n'");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Pengguna</title>
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            height: 60px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header">
        <?php if (!empty($pengaturan['logo'])) : ?>
            <img src="../assets/img/<?= $pengaturan['logo'] ?>" alt="Logo">
        <?php endif; ?>
        <h2><?= $pengaturan['nama_perusahaan'] ?? 'Nama Perusahaan' ?></h2>
        <p><?= $pengaturan['alamat'] ?? '' ?></p>
    </div>

    <h3 style="text-align:center;">LAPORAN DATA PENGGUNA</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>No Telp</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th>Bagian</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            while ($row = mysqli_fetch_assoc($user)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nik'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['nm_user'] ?></td>
                    <td><?= $row['no_telp'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['level'] ?></td>
                    <td><?= $row['nama_bagian'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Tanggal Cetak: <?= date('d-m-Y') ?></p>
        <p>Dicetak oleh: <?= $_SESSION['username'] ?? 'Administrator' ?></p>
    </div>

</body>

</html>