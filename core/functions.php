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
                    $_SESSION['id'] = $user->id_admin;
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

        case 'pelanggan':
            $nama = strip_tags($_POST['nama']);
            $alamat = strip_tags($_POST['alamat']);
            $username = strip_tags($_POST['username']);
            $password = strip_tags($_POST['password']);
            $confirm_password = strip_tags($_POST['confirm_password']);
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $nomor_kwh = strip_tags($_POST['nomor_kwh']);
            $id_tarif = strip_tags($_POST['id_tarif']);

            $check = $db->query("SELECT * FROM pelanggan WHERE username = '$username'");
            if ($check->num_rows > 0) {
                alertRedirect('Username sudah terdaftar, harap gunakan username lain!', './add.php');
            } else {
                if ($password === $confirm_password) {
                    $data = [
                        'nama_pelanggan' => $nama,
                        'alamat' => $alamat,
                        'username' => $username,
                        'password' => $hash_password,
                        'nomor_kwh' => $nomor_kwh,
                        'id_tarif' => $id_tarif
                    ];
                    $model->create($table, $data);
                    alertRedirect('Data berhasil disimpan ke dalam database!', './add.php');
                } else {
                    alertRedirect('Konfirmasi password tidak sesuai, harap cek kembali!', './add.php');
                }
            }
            break;

        case 'tarif':
            $daya = strip_tags($_POST['daya']);
            $tarifperkwh = strip_tags($_POST['tarifperkwh']);

            $data = [
                'daya' => $daya,
                'tarifperkwh' => $tarifperkwh
            ];
            $model->create($table, $data);
            alertRedirect('Data berhasil ditambahkan ke dalam database!', './add.php');
            break;

        case 'penggunaan':
            $id_pelanggan = strip_tags($_POST['id_pelanggan']);
            $bulan = strip_tags($_POST['bulan']);
            $tahun = strip_tags($_POST['tahun']);
            $meter_awal = strip_tags($_POST['meter_awal']);
            $meter_akhir = strip_tags($_POST['meter_akhir']);

            $data = [
                'id_pelanggan' => $id_pelanggan,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'meter_awal' => $meter_awal,
                'meter_akhir' => $meter_akhir
            ];
            $model->create($table, $data);
            alertRedirect('Data berhasil ditambahkan ke dalam database!', './add.php');
            break;

        case 'tagihan':
            $id_penggunaan = strip_tags($_POST['id_penggunaan']);
            $status = strip_tags($_POST['status']);
            $check = $db->query("SELECT * FROM penggunaan INNER JOIN pelanggan ON penggunaan.id_pelanggan = pelanggan.id_pelanggan WHERE id_penggunaan = '$id_penggunaan'");
            while ($row = $check->fetch_object()) {
                $id_pelanggan = $row->id_pelanggan;
                $bulan = $row->bulan;
                $tahun = $row->tahun;
                $jumlah_meter = $row->meter_akhir - $row->meter_awal;
            }

            $data = [
                'id_penggunaan' => $id_penggunaan,
                'id_pelanggan' => $id_pelanggan,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'jumlah_meter' => $jumlah_meter,
                'status' => $status
            ];
            $model->create($table, $data);
            alertRedirect('Data berhasil ditambahkan ke dalam database!', './add.php');
            break;

        case 'pembayaran':
            $id_tagihan = strip_tags($_POST['id_tagihan']);
            $bulan_bayar = strip_tags($_POST['bulan_bayar']);
            $biaya_admin = strip_tags($_POST['biaya_admin']);
            $id_admin = strip_tags($_POST['id_admin']);
            $check = $db->query("SELECT * FROM tagihan INNER JOIN penggunaan ON tagihan.id_penggunaan = penggunaan.id_penggunaan INNER JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif WHERE id_tagihan = '$id_tagihan'");
            while ($row = $check->fetch_object()) {
                $id_pelanggan = $row->id_pelanggan;
                $total_bayar = ($row->jumlah_meter * $row->tarifperkwh) + $biaya_admin;
            }

            $data = [
                'id_tagihan' => $id_tagihan,
                'id_pelanggan' => $id_pelanggan,
                'bulan_bayar' => $bulan_bayar,
                'biaya_admin' => $biaya_admin,
                'total_bayar' => $total_bayar,
                'id_admin' => $id_admin
            ];
            $model->create($table, $data);
            alertRedirect('Data berhasil ditambahkan ke dalam database!', './add.php');
            break;

        default:
            alertRedirect('Error, terdapat kesalahan pada server!', './add.php');
            break;
    }
}

// query update
function queryUpdate($table)
{
    global $db, $model;
    $id = $_GET['id'];
    switch ($table) {
        case 'admin':
            $where = 'id_admin';
            $nama = strip_tags($_POST['nama']);
            $username = strip_tags($_POST['username']);
            $old_username = strip_tags($_POST['old_username']);
            $id_level = strip_tags($_POST['id_level']);

            if ($username ===  $old_username) {
                $data = [
                    'nama_admin' => $nama,
                    'username' => $username,
                    'id_level' => $id_level
                ];
                $model->update($table, $data, $where, $id);
                alertRedirect('Data berhasil diubah dari database!', './index.php');
            } else {
                $check = $db->query("SELECT * FROM admin WHERE username = '$username'");
                if ($check->num_rows > 0) {
                    alertRedirect('Username sudah terdaftar, harap gunakan username lain!', './edit.php?id=' . $id);
                } else {
                    $data = [
                        'nama_admin' => $nama,
                        'username' => $username,
                        'id_level' => $id_level
                    ];
                    $model->update($table, $data, $where, $id);
                    alertRedirect('Data berhasil diubah dari database!', './index.php');
                }
            }
            break;

        case 'admin_password':
            $table = 'admin';
            $where = 'id_admin';
            $password = strip_tags($_POST['password']);
            $confirm_password = strip_tags($_POST['confirm_password']);
            $hash_password = password_hash($password, PASSWORD_DEFAULT);

            if ($password === $confirm_password) {
                $data = [
                    'password' => $hash_password
                ];
                $model->update($table, $data, $where, $id);
                alertRedirect('Data berhasil diubah dari database!', './index.php');
            } else {
                alertRedirect('Konfirmasi password tidak sesuai, harap cek kembali!', './edit.php?id=' . $id);
            }
            break;

        case 'pelanggan':
            $where = 'id_pelanggan';
            $nama = strip_tags($_POST['nama']);
            $alamat = strip_tags($_POST['alamat']);
            $username = strip_tags($_POST['username']);
            $old_username = strip_tags($_POST['old_username']);
            $nomor_kwh = strip_tags($_POST['nomor_kwh']);
            $id_tarif = strip_tags($_POST['id_tarif']);

            if ($username === $old_username) {
                $data = [
                    'nama_pelanggan' => $nama,
                    'alamat' => $alamat,
                    'username' => $username,
                    'nomor_kwh' => $nomor_kwh,
                    'id_tarif' => $id_tarif
                ];
                $model->update($table, $data, $where, $id);
                alertRedirect('Data berhasil diubah dari database!', './index.php');
            } else {
                $check = $db->query("SELECT * FROM pelanggan WHERE username = '$username'");
                if ($check->num_rows > 0) {
                    alertRedirect('Username terlah terdaftar, harap gunakan username lain!', './edit.php?id=' . $id);
                } else {
                    $data = [
                        'nama_pelanggan' => $nama,
                        'alamat' => $alamat,
                        'username' => $username,
                        'nomor_kwh' => $nomor_kwh,
                        'id_tarif' => $id_tarif
                    ];
                    $model->update($table, $data, $where, $id);
                    alertRedirect('Data berhasil diubah dari database!', './index.php');
                }
            }
            break;

        case 'pelanggan_password':
            $table = 'pelanggan';
            $where = 'id_pelanggan';
            $password = strip_tags($_POST['password']);
            $confirm_password = strip_tags($_POST['confirm_password']);
            $hash_password = password_hash($password, PASSWORD_DEFAULT);

            if ($password === $confirm_password) {
                $data = [
                    'password' => $hash_password
                ];
                $model->update($table, $data, $where, $id);
                alertRedirect('Data berhasil diubah dari database!', './index.php');
            } else {
                alertRedirect('Konfirmasi password tidak sesuai, harap cek kembali!', './edit.php?id=' . $id);
            }
            break;

        case 'tarif':
            $where = 'id_tarif';
            $daya = strip_tags($_POST['daya']);
            $tarifperkwh = strip_tags($_POST['tarifperkwh']);

            $data = [
                'daya' => $daya,
                'tarifperkwh' => $tarifperkwh
            ];
            $model->update($table, $data, $where, $id);
            alertRedirect('Data berhasil diubah dari database!', './index.php');
            break;

        case 'penggunaan':
            $where = 'id_penggunaan';
            $id_pelanggan = strip_tags($_POST['id_pelanggan']);
            $bulan = strip_tags($_POST['bulan']);
            $tahun = strip_tags($_POST['tahun']);
            $meter_awal = strip_tags($_POST['meter_awal']);
            $meter_akhir = strip_tags($_POST['meter_akhir']);

            $data = [
                'id_pelanggan' => $id_pelanggan,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'meter_awal' => $meter_awal,
                'meter_akhir' => $meter_akhir
            ];
            $model->update($table, $data, $where, $id);
            alertRedirect('Data berhasil diubah dari database!', './index.php');
            break;

        case 'tagihan':
            $where = 'id_tagihan';
            $id_penggunaan = strip_tags($_POST['id_penggunaan']);
            $status = strip_tags($_POST['status']);
            $check = $db->query("SELECT * FROM penggunaan WHERE id_penggunaan = '$id_penggunaan'");
            while ($row = $check->fetch_object()) {
                $id_pelanggan = $row->id_pelanggan;
                $bulan = $row->bulan;
                $tahun = $row->tahun;
                $jumlah_meter = $row->meter_akhir - $row->meter_awal;
            }
            $data = [
                'id_penggunaan' => $id_penggunaan,
                'id_pelanggan' => $id_pelanggan,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'jumlah_meter' => $jumlah_meter,
                'status' => $status
            ];
            $model->update($table, $data, $where, $id);
            alertRedirect('Data berhasil diubah dari database!', './index.php');
            break;

        case 'pembayaran_status':
            $table = 'pembayaran';
            $where = 'id_pembayaran';
            $id = $_POST['id'];
            $data = [
                'tanggal_pembayaran' => date('Y-m-d'),
                'status_bayar' => 'Verifikasi'
            ];
            $model->update($table, $data, $where, $id);
            alertRedirect('Pembayaran berhasil, silahkan tunggu verifikasi admin!', './index.php');
            break;

        case 'pembayaran_verifikasi':
            $table = 'pembayaran';
            $where = 'id_pembayaran';
            $id = $_POST['id'];
            $id_tagihan = $db->query("SELECT id_tagihan FROM pembayaran WHERE id_pembayaran = '$id'");
            while ($row = $id_tagihan->fetch_object()) {
                $db->query("UPDATE tagihan SET status = 'Lunas' WHERE id_tagihan = '$row->id_tagihan'");
            }
            $data = [
                'status_bayar' => 'Lunas'
            ];
            $model->update($table, $data, $where, $id);
            alertRedirect('Pembayaran berhasil di verifikasi!', './index.php');
            break;

        default:
            alertRedirect('Error, terdapat kesalahan pada server!', './edit.php?id=' . $id);
            break;
    }
}

// query delete
function queryDelete($table)
{
    global $db, $model;
    $id = $_GET['id'];
    switch ($table) {
        case 'admin':
            $where = 'id_admin';
            $model->delete($table, $where, $id);
            alertRedirect('Data berhasil dihapus dari database!', './index.php');
            break;

        case 'pelanggan':
            $where = 'id_pelanggan';
            $model->delete($table, $where, $id);
            alertRedirect('Data berhasil dihapus dari database!', './index.php');
            break;

        case 'tarif':
            $where = 'id_tarif';
            $model->delete($table, $where, $id);
            alertRedirect('Data berhasil dihapus dari database!', './index.php');
            break;

        case 'penggunaan':
            $where = 'id_penggunaan';
            $model->delete($table, $where, $id);
            alertRedirect('Data berhasil dihapus dari database!', './index.php');
            break;

        case 'tagihan':
            $where = 'id_tagihan';
            $model->delete($table, $where, $id);
            alertRedirect('Data berhasil dihapus dari database!', './index.php');
            break;

        case 'pembayaran':
            $where = 'id_pembayaran';
            $model->delete($table, $where, $id);
            alertRedirect('Data berhasil dihapus dari database!', './index.php');
            break;

        default:
            alertRedirect('Error, terdapat kesalahan pada server!', './index.php');
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

// check role return boolean
function checkRole($role)
{
    if (in_array($_SESSION['role'], $role)) {
        return true;
    } else {
        return false;
    }
}

// check dir block
function checkDirBlock()
{
    if (!defined('DirBlock')) {
        die('Direct access is blocked!');
    }
}
