<?php
session_start();
include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($koneksi, "SELECT * FROM user WHERE user_username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($data = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $data['user_password'])) {
            session_regenerate_id(true); // cegah session fixation

            $_SESSION['id'] = $data['user_id'];
            $_SESSION['nama'] = $data['user_nama'];
            $_SESSION['username'] = $data['user_username'];
            $_SESSION['level'] = $data['user_level'];

            if ($data['user_level'] === "administrator") {
                $_SESSION['status'] = "administrator_loggedin";
                header("Location: admin/");
                exit;
            } elseif ($data['user_level'] === "manajemen") {
                $_SESSION['status'] = "manajemen_loggedin";
                header("Location: manajemen/");
                exit;
            }
        }
    }

    header("Location: index.php?alert=gagal");
    exit;
}
?>