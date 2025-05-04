<?php 
include '../config/db.php';

$nama = $_POST['nama'];
$pemilik = $_POST['pemilik'];
$nomor = $_POST['nomor'];
$saldo = $_POST['saldo'];

$query = "INSERT INTO bank (bank_nama, bank_pemilik, bank_nomor, bank_saldo) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($koneksi, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'sssi', $nama, $pemilik, $nomor, $saldo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: bank.php");
exit();
?>