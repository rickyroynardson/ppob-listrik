<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$tarif = $model->get("SELECT * FROM tarif");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPOB Listrik | Tarif</title>
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
        <h2>Tarif</h2>
        <p class="text-muted">Daftar data tarif</p>
        <a href="./add.php" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Daya</th>
                        <th>Tarif/KWH</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarif as $tarif) : ?>
                        <tr>
                            <td><?= $tarif->daya; ?></td>
                            <td>Rp <?= number_format($tarif->tarifperkwh); ?></td>
                            <td>
                                <a href="./edit.php?id=<?= $tarif->id_tarif; ?>" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
                                <a href="./delete.php?id=<?= $tarif->id_tarif; ?>" onclick="return confirm('Yakin untuk hapus data ini?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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