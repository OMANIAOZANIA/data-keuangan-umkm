<?php 
include '../config/db.php';

$id = $_POST['id'];
$tanggal = $_POST['tanggal'];
$nominal = $_POST['nominal'];
$keterangan = $_POST['keterangan'];

$query = "UPDATE piutang SET piutang_tanggal = ?, piutang_nominal = ?, piutang_keterangan = ? WHERE piutang_id = ?";
$stmt = mysqli_prepare($koneksi, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sisi", $tanggal, $nominal, $keterangan, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: piutang.php");
exit;
?>