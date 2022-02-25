<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$pelanggan = $model->get("SELECT * FROM pelanggan INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPOB Listrik | Pelanggan</title>
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
        <h2>Pelanggan</h2>
        <p class="text-muted">Daftar data pelanggan</p>
        <a href="./add.php" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <div class="table-responsive mt-3">
            <table class="table table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Username</th>
                        <th>Nomor KWH</th>
                        <th>Daya</th>
                        <th>Tarif/KWH</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pelanggan as $pelanggan) : ?>
                        <tr>
                            <td><?= $pelanggan->nama_pelanggan; ?></td>
                            <td><?= $pelanggan->alamat; ?></td>
                            <td><?= $pelanggan->username; ?></td>
                            <td><?= $pelanggan->nomor_kwh; ?></td>
                            <td><?= $pelanggan->daya; ?> VA</td>
                            <td>Rp <?= number_format($pelanggan->tarifperkwh); ?></td>
                            <td>
                                <a href="./edit.php?id=<?= $pelanggan->id_pelanggan; ?>" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
                                <a href="./delete.php?id=<?= $pelanggan->id_pelanggan; ?>" onclick="return confirm('Yakin untuk hapus data ini?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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