<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$id = $_GET['id'];
$tagihan = $model->get("SELECT * FROM tagihan WHERE id_tagihan = '$id'");
$penggunaan = $model->get("SELECT * FROM penggunaan INNER JOIN pelanggan ON penggunaan.id_pelanggan = pelanggan.id_pelanggan");

if (isset($_POST['simpan'])) {
    queryUpdate('tagihan');
}
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
        <h2>Edit Tagihan</h2>
        <p class="text-muted">Edit data tagihan</p>
        <a href="./index.php" class="btn btn-sm btn-secondary"><i class="fas fa-angles-left"></i> Kembali</a>
        <?php if ($tagihan) { ?>
            <?php foreach ($tagihan as $tagihan) : ?>
                <div class="card mt-3 col-md-5">
                    <div class="card-body">
                        <form action="" method="POST">
                            <input type="hidden" name="id_penggunaan" value="<?= $tagihan->id_penggunaan; ?>">
                            <div class="mb-2">
                                <label for="id_penggunaan">Penggunaan</label>
                                <select class="form-select" name="id_penggunaan" id="id_penggunaan" required readonly>
                                    <option value="" disabled>Pilih penggunaan</option>
                                    <?php foreach ($penggunaan as $penggunaan) : ?>
                                        <option value="<?= $penggunaan->id_penggunaan; ?>" <?= ($tagihan->id_penggunaan == $penggunaan->id_penggunaan) ? 'selected' : ''; ?> disabled><?= $penggunaan->nama_pelanggan . " - " . $penggunaan->bulan . " " . $penggunaan->tahun; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status">Status Pembayaran</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="">Pilih status pembayaran</option>
                                    <option value="belum_lunas" <?= ($tagihan->status == 'belum_lunas') ? 'selected' : ''; ?>>Belum Lunas</option>
                                    <option value="lunas" <?= ($tagihan->status == 'lunas') ? 'selected' : ''; ?>>Lunas</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success float-end" name="simpan"><i class="fas fa-paper-plane"></i> Simpan</button>
                        </form>
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