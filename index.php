<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Sistem Informasi Keuangan</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="bg-primary">
<div class="container">
    <div class="login-box">
    <center>
        <br />
        <?php
        if (isset($_GET['alert'])) {
        if ($_GET['alert'] == "gagal") {
            echo "<div class='alert alert-danger'>LOGIN GAGAL! USERNAME DAN PASSWORD SALAH!</div>";
        } else if ($_GET['alert'] == "logout") {
            echo "<div class='alert alert-success'>ANDA TELAH BERHASIL LOGOUT</div>";
        } else if ($_GET['alert'] == "belum_login") {
            echo "<div class='alert alert-warning'>ANDA HARUS LOGIN UNTUK MENGAKSES DASHBOARD</div>";
        }
        }
        ?>
    </center>
    <div class="login-box-body">
        <center>
        <img src="gambar/sistem/logo.png" style="width: 300px; height: auto">
        </center>
        <p class="login-box-msg text-bold"></p>
        <form action="login.php" method="POST">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" name="username" required="required" autocomplete="off">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password" required="required" autocomplete="off">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-offset-8 col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>

                <footer style="text-align: center; margin-top: 50px;">XI.8 ACCELEREIGHT | Kelompok 4</footer>
                <footer style="text-align: center;">umkm.chillzone.my.id</footer>
            </div>
        </form>
    </div>
    </div>
</div>
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>