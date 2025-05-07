<?php
include 'koneksi.php';
include 'auth.php';

if ($_SESSION['level'] != 'Karyawan') {
    echo "<script>alert('Akses hanya untuk karyawan'); window.location.href='index.php';</script>";
    exit;
}

$id_user    = $_SESSION['id_user'];
$tampil     = "SELECT * FROM absensi WHERE id_user = $id_user ORDER BY tanggal_absen DESC";
$hasil      = mysqli_query($koneksi, $tampil);

echo "<h1>Riwayat Absensi</h1>";
if (mysqli_num_rows($hasil) == 0) {
    echo "<h4>Tidak ada Riwayat Absensi</h4>";
} else {
?>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Absen</th>
                <th>Jam Masuk</th>
                <th>Kode Absen</th>
                <th>Jam Keluar</th>
                <th>Jam Lembur</th>
            </tr>
        </thead>
        <tbody>
            <?php
            function label($kode)
            {
                switch ($kode) {
                    case '1':
                        return 'Hadir';
                    case '2':
                        return 'Izin';
                    case '3':
                        return 'Sakit';
                    case '4':
                        return 'Tanpa Keterangan';
                }
            }

            $no = 1;
            while ($row = mysqli_fetch_assoc($hasil)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['tanggal_absen'] ?></td>
                    <td><?= $row['jam_absen'] ?></td>
                    <td><?= label($row['kode_absen']) ?></td>
                    <td><?= $row['jam_keluar'] ?></td>
                    <td><?= $row['jam_lembur'] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}
?>