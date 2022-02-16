<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$id = $_GET['id'];
$pelanggan = $model->get("SELECT * FROM pelanggan INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif WHERE id_pelanggan = $id");
$tarif = $model->get("SELECT * FROM tarif");

if (isset($_POST['simpan'])) {
    queryUpdate('pelanggan');
}
if (isset($_POST['simpan_password'])) {
    queryUpdate('pelanggan_password');
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
        <h2>Edit Pelanggan</h2>
        <p class="text-muted">Edit data pelanggan</p>
        <a href="./index.php" class="btn btn-sm btn-secondary"><i class="fas fa-angles-left"></i> Kembali</a>
        <?php if ($pelanggan) { ?>
            <?php foreach ($pelanggan as $pelanggan) : ?>
                <div class="card mt-3 col-md-9">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?= $pelanggan->id_pelanggan; ?>">
                                    <input type="hidden" name="old_username" value="<?= $pelanggan->username; ?>">
                                    <div class="mb-2">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $pelanggan->nama_pelanggan; ?>" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $pelanggan->alamat; ?>" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" value="<?= $pelanggan->username; ?>" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="nomor_kwh">Nomor KWH</label>
                                        <input type="number" class="form-control" name="nomor_kwh" id="nomor_kwh" value="<?= $pelanggan->nomor_kwh; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="id_tarif">Tarif</label>
                                        <select class="form-select" name="id_tarif" id="id_tarif" required>
                                            <option value="">Pilih tarif</option>
                                            <?php foreach ($tarif as $tarif) : ?>
                                                <option value="<?= $tarif->id_tarif; ?>" <?= ($tarif->id_tarif === $pelanggan->id_tarif) ? 'selected' : ''; ?>><?= $tarif->daya; ?> VA | Rp <?= number_format($tarif->tarifperkwh); ?>/KWH</option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success float-end" name="simpan"><i class="fas fa-paper-plane"></i> Simpan</button>
                                </form>
                            </div>
                            <div class="col">
                                <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?= $pelanggan->id_pelanggan; ?>">
                                    <div class="mb-2">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password">Konfirmasi Password</label>
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success float-end" name="simpan_password"><i class="fas fa-paper-plane"></i> Ubah Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php } else { ?>
            <h6 class="mt-3">Tidak ada data ditemukan.</h6>
        <?php } ?>
    </div>

    <!-- js -->
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/all.min.js"></script>
</body>

</html>