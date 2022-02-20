<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$id = $_GET['id'];
$tarif = $model->get("SELECT * FROM tarif WHERE id_tarif = '$id'");

if (isset($_POST['simpan'])) {
    queryUpdate('tarif');
}
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
        <h2>Edit Tarif</h2>
        <p class="text-muted">Edit data tarif</p>
        <a href="./index.php" class="btn btn-sm btn-secondary"><i class="fas fa-angles-left"></i> Kembali</a>
        <?php if ($tarif) { ?>
            <?php foreach ($tarif as $tarif) : ?>
                <div class="card mt-3 col-md-5">
                    <div class="card-body">
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $tarif->id_tarif; ?>">
                            <div class="mb-2">
                                <label for="daya">Daya</label>
                                <input type="number" class="form-control" name="daya" id="daya" value="<?= $tarif->daya; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="tarifperkwh">Tarif/KWH</label>
                                <input type="number" class="form-control" name="tarifperkwh" id="tarifperkwh" value="<?= $tarif->tarifperkwh; ?>" required>
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