<?php
include '../config/db.php';
session_start();

if (!isset($_SESSION['id']) || !isset($_POST['password'])) {
  header("Location: gantipassword.php");
  exit;
}

$id = $_SESSION['id'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = mysqli_prepare($koneksi, "UPDATE user SET user_password = ? WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "si", $password, $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: gantipassword.php?alert=sukses");
exit;
?>