<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$tagihan = $model->get("SELECT * FROM tagihan INNER JOIN penggunaan ON tagihan.id_penggunaan = penggunaan.id_penggunaan INNER JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPOB Listrik | Tagihan</title>
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
        <h2>Tagihan</h2>
        <p class="text-muted">Daftar data tagihan</p>
        <a href="./add.php" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah Meter</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tagihan as $tagihan) : ?>
                        <tr>
                            <td><?= $tagihan->nama_pelanggan; ?></td>
                            <td><?= $tagihan->bulan; ?></td>
                            <td><?= $tagihan->tahun; ?></td>
                            <td><?= ($tagihan->meter_akhir - $tagihan->meter_awal); ?></td>
                            <td><?= $tagihan->status; ?></td>
                            <td>
                                <a href="./edit.php?id=<?= $tagihan->id_tagihan; ?>" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
                                <a href="./delete.php?id=<?= $tagihan->id_tagihan; ?>" onclick="return confirm('Yakin untuk hapus data ini?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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