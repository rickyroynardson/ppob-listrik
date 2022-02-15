<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$id = $_GET['id'];
$admin = $model->get("SELECT * FROM admin INNER JOIN level ON admin.id_level = level.id_level WHERE id_admin = '$id'");
$level = $model->get("SELECT * FROM level");

if (isset($_POST['simpan'])) {
    queryUpdate('admin');
}

if (isset($_POST['simpan_password'])) {
    queryUpdate('admin_password');
}
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
        <h2>Edit Admin</h2>
        <p class="text-muted">Edit data admin</p>
        <a href="./index.php" class="btn btn-sm btn-secondary"><i class="fas fa-angles-left"></i> Kembali</a>
        <?php if (!$admin) { ?>
            <h6 class="mt-3">Tidak ada data ditemukan.</h6>
        <?php } else { ?>
            <?php foreach ($admin as $admin) : ?>
                <div class="row">
                    <div class="col-md-5">
                        <div class="card mt-3">
                            <div class="card-body">
                                <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?= $admin->id_admin; ?>">
                                    <input type="hidden" name="old_username" value="<?= $admin->username; ?>">
                                    <div class="mb-2">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $admin->nama_admin; ?>" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" value="<?= $admin->username ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="id_level">Level</label>
                                        <select class="form-select" name="id_level" id="id_level" required>
                                            <option value="">Pilih level</option>
                                            <?php foreach ($level as $level) : ?>
                                                <option value="<?= $level->id_level; ?>" <?= ($admin->id_level === $level->id_level) ? 'selected' : '' ?>><?= $level->nama_level; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success float-end" name="simpan"><i class="fas fa-paper-plane"></i> Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php if ($_SESSION['id'] === $admin->id_admin) { ?>
                        <div class="col-md-4">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h6 class="text-secondary">Ubah Password</h6>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id" value="<?= $admin->id_admin ?>">
                                        <div class="mb-2">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirm_password">Konfirmasi Password</label>
                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                                        </div>
                                        <button type="submit" name="simpan_password" class="btn btn-sm btn-success float-end"><i class="fas fa-paper-plane"></i> Ubah Password</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php endforeach; ?>
        <?php } ?>
    </div>

    <!-- js -->
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/all.min.js"></script>
</body>

</html>