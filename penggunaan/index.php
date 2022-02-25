<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$penggunaan = $model->get("SELECT * FROM penggunaan INNER JOIN pelanggan ON penggunaan.id_pelanggan = pelanggan.id_pelanggan");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPOB Listrik | Penggunaan</title>
    <!-- icon -->
    <link rel="icon" href="../public/images/logo.png">
    <!-- css -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/all.min.css">
    <link rel="stylesheet" href="../public/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <?php
    define('DirBlock', true);
    include('../layout/navbar.php');
    ?>

    <div class="container">
        <h2>Penggunaan</h2>
        <p class="text-muted">Daftar data penggunaan</p>
        <a href="./add.php" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <div class="table-responsive mt-3">
            <table class="table table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Meter Awal</th>
                        <th>Meter Akhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penggunaan as $penggunaan) : ?>
                        <tr>
                            <td><?= $penggunaan->nama_pelanggan; ?></td>
                            <td><?= $penggunaan->bulan; ?></td>
                            <td><?= $penggunaan->tahun; ?></td>
                            <td><?= $penggunaan->meter_awal; ?></td>
                            <td><?= $penggunaan->meter_akhir; ?></td>
                            <td>
                                <?php if (!$penggunaan->is_tagihan) { ?>
                                    <a href="./edit.php?id=<?= $penggunaan->id_penggunaan; ?>" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
                                <?php } ?>
                                <a href="./delete.php?id=<?= $penggunaan->id_penggunaan; ?>" onclick="return confirm('Yakin untuk hapus data ini?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- js -->
    <script src="../public/js/jquery.min.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/all.min.js"></script>
    <script type="text/javascript" src="../public/js/jquery.dataTables.min.js"></script>
    <script src="../public/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#data-table').DataTable();
        })
    </script>
</body>

</html>