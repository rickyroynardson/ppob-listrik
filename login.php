<?php
require_once './core/init.php';
require_once './core/functions.php';

if (isset($_POST['login'])) {
    authenticate();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPOB Listrik | Login</title>
    <!-- icon -->
    <link rel="icon" href="./public/images/logo.png">
    <!-- css -->
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
</head>

<body style="background: url('./public/images/background.jpg'); background-size: cover;">
    <div class="card col-md-3 shadow position-absolute top-50 start-50 translate-middle border-5 rounded">
        <div class="card-body">
            <h4 class="mb-3">Login</h4>
            <form action="" method="POST">
                <div class="mb-2">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="mb-2">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <select class="form-select" name="role" required>
                        <option value="pelanggan">Pelanggan</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success float-end" name="login">Login</button>
            </form>
        </div>
    </div>

    <!-- js -->
    <script src="./public/js/bootstrap.bundle.min.js"></script>
</body>

</html>