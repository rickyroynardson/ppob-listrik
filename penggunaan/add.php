<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$pelanggan = $model->get("SELECT * FROM pelanggan INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif");

if (isset($_POST['simpan'])) {
    queryAdd('penggunaan');
}
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
</head>

<body>
    <?php
    define('DirBlock', true);
    include('../layout/navbar.php');
    ?>

    <div class="container">
        <h2>Tambah Penggunaan</h2>
        <p class="text-muted">Tambah data penggunaan</p>
        <a href="./index.php" class="btn btn-sm btn-secondary"><i class="fas fa-angles-left"></i> Kembali</a>
        <div class="card mt-3 col-md-5">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-2">
                        <label for="id_pelanggan">Pelanggan</label>
                        <select class="form-select" name="id_pelanggan" id="id_pelanggan" required>
                            <option value="">Pilih pelanggan</option>
                            <?php foreach ($pelanggan as $pelanggan) : ?>
                                <option value="<?= $pelanggan->id_pelanggan; ?>"><?= $pelanggan->nama_pelanggan; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select" required>
                            <option value="">Pilih bulan</option>
                            <option value="1">1 - Januari</option>
                            <option value="2">2 - Februari</option>
                            <option value="3">3 - Maret</option>
                            <option value="4">4 - April</option>
                            <option value="5">5 - Mei</option>
                            <option value="6">6 - Juni</option>
                            <option value="7">7 - Juli</option>
                            <option value="8">8 - Agustus</option>
                            <option value="9">9 - September</option>
                            <option value="10">10 - Oktober</option>
                            <option value="11">11 - November</option>
                            <option value="12">12 - Desember</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="tahun">Tahun</label>
                        <input type="number" class="form-control" name="tahun" id="tahun" min="2022" required>
                    </div>
                    <div class="mb-2">
                        <label for="meter_awal">Meter Awal</label>
                        <input type="number" class="form-control" name="meter_awal" id="meter_awal" required>
                    </div>
                    <div class="mb-3">
                        <label for="meter_akhir">Meter Akhir</label>
                        <input type="number" class="form-control" name="meter_akhir" id="meter_akhir" required>
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