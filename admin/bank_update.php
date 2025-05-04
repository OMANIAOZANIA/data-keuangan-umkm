<?php 
include '../config/db.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$pemilik = $_POST['pemilik'];
$nomor = $_POST['nomor'];
$saldo = $_POST['saldo'];

$query = "UPDATE bank SET bank_nama = ?, bank_pemilik = ?, bank_nomor = ?, bank_saldo = ? WHERE bank_id = ?";
$stmt = mysqli_prepare($koneksi, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ssssi', $nama, $pemilik, $nomor, $saldo, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: bank.php");
exit();
?>