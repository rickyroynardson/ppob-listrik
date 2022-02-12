<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$admin = $model->get("SELECT * FROM admin INNER JOIN level ON admin.id_level = level.id_level");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPOB Listrik | Admin</title>
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
        <h2>Admin</h2>
        <p class="text-muted">Daftar data admin</p>
        <a href="./add.php" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admin as $admin) : ?>
                        <tr>
                            <td><?= $admin->nama_admin; ?></td>
                            <td><?= $admin->username; ?></td>
                            <td><?= $admin->nama_level; ?></td>
                            <td>
                                <a href="./edit.php?id=<?= $admin->id_admin; ?>" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
                                <a href="./delete.php?id=<?= $admin->id_admin; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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