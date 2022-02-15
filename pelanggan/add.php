<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$tarif = $model->get("SELECT * FROM tarif");

if (isset($_POST['simpan'])) {
    queryAdd('pelanggan');
}
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
</head>

<body>
    <?php
    define('DirBlock', true);
    include('../layout/navbar.php');
    ?>

    <div class="container">
        <h2>Tambah Pelanggan</h2>
        <p class="text-muted">Tambah data pelanggan</p>
        <a href="./index.php" class="btn btn-sm btn-secondary"><i class="fas fa-angles-left"></i> Kembali</a>
        <div class="card mt-3 col-md-9">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" required>
                            </div>
                            <div class="mb-2">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" required>
                            </div>
                            <div class="mb-2">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                </div>
                                <div class="col">
                                    <label for="confirm_password">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="nomor_kwh">Nomor KWH</label>
                                <input type="number" class="form-control" name="nomor_kwh" id="nomor_kwh" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_tarif">Tarif</label>
                                <select class="form-select" name="id_tarif" id="id_tarif" required>
                                    <option value="">Pilih tarif</option>
                                    <?php foreach ($tarif as $tarif) : ?>
                                        <option value="<?= $tarif->id_tarif; ?>"><?= $tarif->daya; ?> VA | Rp <?= number_format($tarif->tarifperkwh); ?>/KWH</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success float-end" name="simpan"><i class="fas fa-paper-plane"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/all.min.js"></script>
</body>

</html>