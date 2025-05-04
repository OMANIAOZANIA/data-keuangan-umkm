<?php 
include '../config/db.php';

$tanggal = $_POST['tanggal'];
$nominal = $_POST['nominal'];
$keterangan = $_POST['keterangan'];

$query = "INSERT INTO hutang (hutang_tanggal, hutang_nominal, hutang_keterangan) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($koneksi, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sis", $tanggal, $nominal, $keterangan);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: hutang.php");
exit;
?>