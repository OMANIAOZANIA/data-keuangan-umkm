<?php 
include '../config/db.php';

$id = $_POST['id'];
$tanggal = $_POST['tanggal'];
$nominal = $_POST['nominal'];
$keterangan = $_POST['keterangan'];

$query = "UPDATE hutang SET hutang_tanggal = ?, hutang_nominal = ?, hutang_keterangan = ? WHERE hutang_id = ?";
$stmt = mysqli_prepare($koneksi, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sisi", $tanggal, $nominal, $keterangan, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: hutang.php");
exit;
?>