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
            </ul>
            <a href="../logout.php" class="btn btn-sm btn-danger ms-auto"><i class="fas fa-arrow-right-from-bracket"></i> Logout</a>
        </div>
    </div>
</nav>