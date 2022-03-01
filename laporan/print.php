<?php
require_once '../core/init.php';
require_once '../core/functions.php';
checkLog();

$tagihan = $model->get("SELECT * FROM tagihan INNER JOIN penggunaan ON tagihan.id_penggunaan = penggunaan.id_penggunaan INNER JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan");
$belum_bayar = $model->get("SELECT *, tagihan.bulan AS bulan_tagihan, tagihan.tahun AS tahun_tagihan FROM pembayaran INNER JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan INNER JOIN pelanggan ON pembayaran.id_pelanggan = pelanggan.id_pelanggan INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif INNER JOIN admin ON pembayaran.id_admin = admin.id_admin WHERE status_bayar IS NULL");
$verifikasi = $model->get("SELECT *, tagihan.bulan AS bulan_tagihan, tagihan.tahun AS tahun_tagihan FROM pembayaran INNER JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan INNER JOIN pelanggan ON pembayaran.id_pelanggan = pelanggan.id_pelanggan INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif INNER JOIN admin ON pembayaran.id_admin = admin.id_admin WHERE status_bayar = 'Verifikasi'");
$lunas = $model->get("SELECT *, tagihan.bulan AS bulan_tagihan, tagihan.tahun AS tahun_tagihan FROM pembayaran INNER JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan INNER JOIN pelanggan ON pembayaran.id_pelanggan = pelanggan.id_pelanggan INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif INNER JOIN admin ON pembayaran.id_admin = admin.id_admin WHERE status_bayar = 'Lunas'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPOB Listrik | Laporan</title>
    <!-- icon -->
    <link rel="icon" href="../public/images/logo.png">
    <!-- css -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/all.min.css">
    <link rel="stylesheet" href="../public/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <?php if (!empty($_GET['q']) && $_GET['q'] == 'tagihan') { ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah Meter</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tagihan as $tagihan) : ?>
                        <tr>
                            <td><?= $tagihan->nama_pelanggan; ?></td>
                            <td><?= $tagihan->bulan; ?></td>
                            <td><?= $tagihan->tahun; ?></td>
                            <td><?= $tagihan->jumlah_meter; ?></td>
                            <td>
                                <?php if ($tagihan->status == 'lunas') { ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php } else if ($tagihan->status == 'belum_lunas') { ?>
                                    <span class="badge bg-danger">Belum Lunas</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
    <?php if (!empty($_GET['q']) && $_GET['q'] == 'belum_bayar') { ?>
        <div class="table-responsive">
            <table class="table table-bordered">
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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($belum_bayar as $belum_bayar) : ?>
                        <tr>
                            <td><?= $belum_bayar->bulan_tagihan; ?></td>
                            <td><?= $belum_bayar->tahun_tagihan; ?></td>
                            <td><?= $belum_bayar->jumlah_meter; ?></td>
                            <td><?= $belum_bayar->nama_pelanggan; ?></td>
                            <td><?= $belum_bayar->tanggal_pembayaran; ?></td>
                            <td><?= $belum_bayar->bulan_bayar; ?></td>
                            <td>Rp <?= number_format($belum_bayar->biaya_admin); ?></td>
                            <td>Rp <?= number_format($belum_bayar->total_bayar); ?></td>
                            <td><?= $belum_bayar->nama_admin; ?></td>
                            <td>
                                <?php if ($belum_bayar->status_bayar == 'Verifikasi') { ?>
                                    <span class="badge bg-warning">Verifikasi</span>
                                <?php } else if ($belum_bayar->status_bayar == 'Lunas') { ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php } else { ?>
                                    <span class="badge bg-secondary">Belum Bayar</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
    <?php if (!empty($_GET['q']) && $_GET['q'] == 'verifikasi') { ?>
        <div class="table-responsive">
            <table class="table table-bordered">
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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($verifikasi as $verifikasi) : ?>
                        <tr>
                            <td><?= $verifikasi->bulan_tagihan; ?></td>
                            <td><?= $verifikasi->tahun_tagihan; ?></td>
                            <td><?= $verifikasi->jumlah_meter; ?></td>
                            <td><?= $verifikasi->nama_pelanggan; ?></td>
                            <td><?= $verifikasi->tanggal_pembayaran; ?></td>
                            <td><?= $verifikasi->bulan_bayar; ?></td>
                            <td>Rp <?= number_format($verifikasi->biaya_admin); ?></td>
                            <td>Rp <?= number_format($verifikasi->total_bayar); ?></td>
                            <td><?= $verifikasi->nama_admin; ?></td>
                            <td>
                                <?php if ($verifikasi->status_bayar == 'Verifikasi') { ?>
                                    <span class="badge bg-warning">Verifikasi</span>
                                <?php } else if ($verifikasi->status_bayar == 'Lunas') { ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php } else { ?>
                                    <span class="badge bg-secondary">Belum Bayar</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
    <?php if (!empty($_GET['q']) && $_GET['q'] == 'lunas') { ?>
        <div class="table-responsive">
            <table class="table table-bordered">
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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lunas as $lunas) : ?>
                        <tr>
                            <td><?= $lunas->bulan_tagihan; ?></td>
                            <td><?= $lunas->tahun_tagihan; ?></td>
                            <td><?= $lunas->jumlah_meter; ?></td>
                            <td><?= $lunas->nama_pelanggan; ?></td>
                            <td><?= $lunas->tanggal_pembayaran; ?></td>
                            <td><?= $lunas->bulan_bayar; ?></td>
                            <td>Rp <?= number_format($lunas->biaya_admin); ?></td>
                            <td>Rp <?= number_format($lunas->total_bayar); ?></td>
                            <td><?= $lunas->nama_admin; ?></td>
                            <td>
                                <?php if ($lunas->status_bayar == 'Verifikasi') { ?>
                                    <span class="badge bg-warning">Verifikasi</span>
                                <?php } else if ($lunas->status_bayar == 'Lunas') { ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php } else { ?>
                                    <span class="badge bg-secondary">Belum Bayar</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php } ?>

    <!-- js -->
    <script src="../public/js/jquery.min.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/all.min.js"></script>
    <script type="text/javascript" src="../public/js/jquery.dataTables.min.js"></script>
    <script src="../public/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            window.print();
        });
    </script>
</body>

</html>