<?php
require_once '../core/functions.php';
checkDirBlock();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-3">
    <div class="container">
        <a class="navbar-brand">PPOB Listrik</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if ($_SESSION['role'] == 'Pelanggan') { ?>
                    <li class="navbar-item">
                        <a href="../dashboard/index.php" class="nav-link">Dashboard</a>
                    </li>
                    <div class="navbar-item">
                        <a href="../tagihan/index.php" class="nav-link">Tagihan</a>
                    </div>
                    <div class="navbar-item">
                        <a href="../pembayaran/index.php" class="nav-link">Pembayaran</a>
                    </div>
                <?php } elseif ($_SESSION['role'] == 'Bank') { ?>
                    <li class="navbar-item">
                        <a href="../dashboard/index.php" class="nav-link">Dashboard</a>
                    </li>
                    <div class="navbar-item">
                        <a href="../pembayaran/index.php" class="nav-link">Pembayaran</a>
                    </div>
                    <div class="navbar-item">
                        <a href="" class="nav-link">Laporan</a>
                    </div>
                <?php } else { ?>
                    <li class="navbar-item">
                        <a href="../dashboard/index.php" class="nav-link">Dashboard</a>
                    </li>
                    <li class="navbar-item">
                        <a href="../admin/index.php" class="nav-link">Admin</a>
                    </li>
                    <div class="navbar-item">
                        <a href="../level/index.php" class="nav-link">Level</a>
                    </div>
                    <div class="navbar-item">
                        <a href="../pelanggan/index.php" class="nav-link">Pelanggan</a>
                    </div>
                    <div class="navbar-item">
                        <a href="../tarif/index.php" class="nav-link">Tarif</a>
                    </div>
                    <div class="navbar-item">
                        <a href="../penggunaan/index.php" class="nav-link">Penggunaan</a>
                    </div>
                    <div class="navbar-item">
                        <a href="../tagihan/index.php" class="nav-link">Tagihan</a>
                    </div>
                    <div class="navbar-item">
                        <a href="../pembayaran/index.php" class="nav-link">Pembayaran</a>
                    </div>
                    <div class="navbar-item">
                        <a href="../laporan/index.php" class="nav-link">Laporan</a>
                    </div>
                <?php } ?>
            </ul>
            <a href="../logout.php" class="btn btn-sm btn-danger ms-auto"><i class="fas fa-arrow-right-from-bracket"></i> Logout</a>
        </div>
    </div>
</nav>