<?php
session_start();

require_once 'connection.php';

$connection = new Connection();
$db = $connection->connect();

// authenticate login
function authenticate()
{
    global $db;
    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    $role = strip_tags($_POST['role']);

    if ($role === 'pelanggan') {
        $check = $db->query("SELECT * FROM pelanggan WHERE username = '$username'");
        if ($check->num_rows > 0) {
            while ($user = $check->fetch_object()) {
                if (password_verify($password, $user->password)) {
                    $_SESSION['log'] = true;
                    $_SESSION['id'] = $user->id_pelanggan;
                    $_SESSION['nama'] = $user->nama_pelanggan;
                    $_SESSION['role'] = 'Pelanggan';

                    alertRedirect('Login berhasil. Selamat datang ' . $user->nama_pelanggan, './dashboard/index.php');
                } else {
                    alertRedirect('Akun invalid, harap cek kembali!', './login.php');
                }
            }
        } else {
            alertRedirect('Akun invalid, harap cek kembali!', './login.php');
        }
    } else if ($role === 'admin') {
        $check = $db->query("SELECT * FROM admin INNER JOIN level ON admin.id_level = level.id_level WHERE username = '$username'");
        if ($check->num_rows > 0) {
            while ($user = $check->fetch_object()) {
                if (password_verify($password, $user->password)) {
                    $_SESSION['log'] = true;
                    $_SESSION['id'] = $user->id_admmin;
                    $_SESSION['nama'] = $user->nama_admin;
                    $_SESSION['role'] = $user->nama_level;

                    alertRedirect('Login berhasil. Selamat datang ' . $user->nama_admin, './dashboard/index.php');
                } else {
                    alertRedirect('Akun invalid, harap cek kembali!', './login.php');
                }
            }
        } else {
            alertRedirect('Akun invalid, harap cek kembali!', './login.php');
        }
    }
}

// logout & clear session
function logout()
{
    session_destroy();
    alertRedirect('Logout berhasil!', './login.php');
}

// query add
function queryAdd($table)
{
    global $db, $model;
    switch ($table) {
        case 'admin':
            $nama = strip_tags($_POST['nama']);
            $username = strip_tags($_POST['username']);
            $password = strip_tags($_POST['password']);
            $confirm_password = strip_tags($_POST['confirm_password']);
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $id_level = strip_tags($_POST['id_level']);

            $check = $db->query("SELECT * FROM admin WHERE username = '$username'");
            if ($check->num_rows > 0) {
                alertRedirect('Username sudah terdaftar, harap gunakan username lain!', './add.php');
            } else {
                if ($password === $confirm_password) {
                    $data = [
                        'nama_admin' => $nama,
                        'username' => $username,
                        'password' => $hash_password,
                        'id_level' => $id_level
                    ];
                    $model->create($table, $data);
                    alertRedirect('Data berhasil disimpan ke dalam database!', './add.php');
                } else {
                    alertRedirect('Konfirmasi password tidak sesuai, harap cek kembali!', './add.php');
                }
            }
            break;

        default:
            alertRedirect('Error, terdapat kesalahan pada server!', './add.php');
            break;
    }
}

// alert & redirect
function alertRedirect($alert, $redirect)
{
    echo "<script>
        alert('$alert');
        window.location.replace('$redirect');
    </script>";
}

// check log status
function checkLog()
{
    if ($_SESSION['log'] !== true) {
        header('location: ../login.php');
    }
}

// check dir block
function checkDirBlock()
{
    if (!defined('DirBlock')) {
        die('Direct access is blocked!');
    }
}
