<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$tagihan = $model->get("SELECT * FROM tagihan INNER JOIN penggunaan ON tagihan.id_penggunaan = penggunaan.id_penggunaan INNER JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan WHERE status = 'belum_lunas'");
$admin = $model->get("SELECT * FROM admin INNER JOIN level ON admin.id_level = level.id_level");

if (isset($_POST['simpan'])) {
    queryAdd('pembayaran');
}
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
        <h2>Tambah Pembayaran</h2>
        <p class="text-muted">Tambah data pembayaran</p>
        <a href="./index.php" class="btn btn-sm btn-secondary"><i class="fas fa-angles-left"></i> Kembali</a>
        <div class="card mt-3 col-md-5">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-2">
                        <label for="id_tagihan">Tagihan</label>
                        <select name="id_tagihan" id="id_tagihan" class="form-select" required>
                            <option value="">Pilih tagihan</option>
                            <?php foreach ($tagihan as $tagihan) : ?>
                                <option value="<?= $tagihan->id_tagihan; ?>"><?= $tagihan->nama_pelanggan; ?> - <?= $tagihan->bulan; ?> <?= $tagihan->tahun; ?> - <?= $tagihan->jumlah_meter; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="bulan_bayar">Bulan Bayar</label>
                        <input type="number" class="form-control" name="bulan_bayar" id="bulan_bayar" required>
                    </div>
                    <div class="mb-2">
                        <label for="biaya_admin">Biaya Admin</label>
                        <input type="number" class="form-control" name="biaya_admin" id="biaya_admin" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_admin">Admin</label>
                        <select name="id_admin" id="id_admin" class="form-select" required>
                            <option value="">Pilih admin</option>
                            <?php foreach ($admin as $admin) : ?>
                                <option value="<?= $admin->id_admin; ?>"><?= $admin->nama_admin; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success float-end" name="simpan"><i class="fas fa-paper-plane"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/all.min.js"></script>
</body>

</html>