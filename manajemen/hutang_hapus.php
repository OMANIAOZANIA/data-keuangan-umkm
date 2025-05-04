<?php 
include '../config/db.php';

$id = $_GET['id'];

$query = "DELETE FROM hutang WHERE hutang_id = ?";
$stmt = mysqli_prepare($koneksi, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: hutang.php");
exit;
?>