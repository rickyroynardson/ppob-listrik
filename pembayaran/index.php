<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$pembayaran = $model->get("SELECT *, tagihan.bulan AS bulan_tagihan, tagihan.tahun AS tahun_tagihan FROM pembayaran INNER JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan INNER JOIN pelanggan ON pembayaran.id_pelanggan = pelanggan.id_pelanggan INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif INNER JOIN admin ON pembayaran.id_admin = admin.id_admin");

if (isset($_POST['bayar'])) {
    queryUpdate('pembayaran_status');
}
if (isset($_POST['verifikasi'])) {
    queryUpdate('pembayaran_verifikasi');
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
    <link rel="stylesheet" href="../public/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <?php
    define('DirBlock', true);
    include('../layout/navbar.php');
    ?>

    <div class="container">
        <h2>Pembayaran</h2>
        <p class="text-muted">Daftar data pembayaran</p>
        <?php if (checkRole(['Admin'])) { ?>
            <a href="./add.php" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <?php } ?>
        <div class="table-responsive mt-3">
            <table class="table table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th>Tagihan Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah Meter</th>
                        <th>Pelanggan</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Bulan Bayar</th>
                        <th>Biaya Admin</th>
                        <th>Total Bayar</th>
                        <th>Admin</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pembayaran as $pembayaran) : ?>
                        <tr>
                            <td><?= $pembayaran->bulan_tagihan; ?></td>
                            <td><?= $pembayaran->tahun_tagihan; ?></td>
                            <td><?= $pembayaran->jumlah_meter; ?></td>
                            <td><?= $pembayaran->nama_pelanggan; ?></td>
                            <td><?= $pembayaran->tanggal_pembayaran; ?></td>
                            <td><?= $pembayaran->bulan_bayar; ?></td>
                            <td>Rp <?= number_format($pembayaran->biaya_admin); ?></td>
                            <td>Rp <?= number_format($pembayaran->total_bayar); ?></td>
                            <td><?= $pembayaran->nama_admin; ?></td>
                            <td>
                                <?php if ($pembayaran->status_bayar == 'Verifikasi') { ?>
                                    <span class="badge bg-warning">Verifikasi</span>
                                <?php } else if ($pembayaran->status_bayar == 'Lunas') { ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php } else { ?>
                                    <span class="badge bg-secondary">Belum Bayar</span>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if (checkRole(['Pelanggan'])) { ?>
                                    <?php if ($pembayaran->status_bayar != 'Lunas' && $pembayaran->status_bayar != 'Verifikasi') { ?>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?= $pembayaran->id_pembayaran; ?>">
                                            <button type="submit" name="bayar" class="btn btn-sm btn-success"><i class="fas fa-dollar"></i></button>
                                        </form>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (checkRole(['Admin', 'Bank'])) { ?>
                                    <?php if ($pembayaran->status_bayar != 'Lunas') { ?>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?= $pembayaran->id_pembayaran; ?>">
                                            <button type="submit" name="verifikasi" class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                        </form>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (checkRole(['Admin'])) { ?>
                                    <a href="./delete.php?id=<?= $pembayaran->id_pembayaran; ?>" onclick="return confirm('Yakin untuk hapus data ini?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                <?php } ?>
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
            $('#data-table').DataTable({
                "scrollX": true
            });
        })
    </script>
</body>

</html>