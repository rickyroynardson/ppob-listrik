<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$pembayaran = $model->get("SELECT *, tagihan.bulan AS bulan_tagihan, tagihan.tahun AS tahun_tagihan FROM pembayaran INNER JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan INNER JOIN pelanggan ON pembayaran.id_pelanggan = pelanggan.id_pelanggan INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif INNER JOIN admin ON pembayaran.id_admin = admin.id_admin");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPOB Listrik | Pembayaran</title>
    <!-- icon -->
    <link rel="icon" href="../public/images/logo.png">
    <!-- css -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/all.min.css">
</head>

<body>
    <?php
    define('DirBlock', true);
    include('../layout/navbar.php');
    ?>

    <div class="container">
        <h2>Pembayaran</h2>
        <p class="text-muted">Daftar data pembayaran</p>
        <a href="./add.php" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tagihan Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah Meter</th>
                        <th>Pelanggan</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Bulan Bayar</th>
                        <th>Biaya Admin</th>
                        <th>Total Bayar</th>
                        <th>Admin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pembayaran as $pembayaran) : ?>
                        <tr>
                            <td><?= $pembayaran->bulan_tagihan; ?></td>
                            <td><?= $pembayaran->tahun_tagihan; ?></td>
                            <td><?= $pembayaran->jumlah_meter; ?></td>
                            <td><?= $pembayaran->nama_pelanggan; ?></td>
                            <td><?= $pembayaran->tanggal_pembayaran; ?></td>
                            <td><?= $pembayaran->bulan_bayar; ?></td>
                            <td>Rp <?= number_format($pembayaran->biaya_admin); ?></td>
                            <td>Rp <?= number_format($pembayaran->jumlah_meter * $pembayaran->tarifperkwh); ?></td>
                            <td><?= $pembayaran->nama_admin; ?></td>
                            <td>
                                <a href="./edit.php?id=<?= $pembayaran->id_pembayaran; ?>" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
                                <a href="./delete.php?id=<?= $pembayaran->id_pembayaran; ?>" onclick="return confirm('Yakin untuk hapus data ini?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- js -->
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/all.min.js"></script>
</body>

</html>