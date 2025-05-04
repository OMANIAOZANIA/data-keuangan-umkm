<?php 
include '../config/db.php';

$tanggal = $_POST['tanggal'];
$nominal = $_POST['nominal'];
$keterangan = $_POST['keterangan'];

$query = "INSERT INTO piutang (piutang_tanggal, piutang_nominal, piutang_keterangan) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($koneksi, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sis", $tanggal, $nominal, $keterangan);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: piutang.php");
exit;
?>