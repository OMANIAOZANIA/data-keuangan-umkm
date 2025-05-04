<?php 
include '../config/db.php';

$id = $_GET['id'];
$bank_default = 1; // default bank

// update transaksi ke default bank
$query_update = "UPDATE transaksi SET transaksi_bank = ? WHERE transaksi_bank = ?"; 
$stmt_update = mysqli_prepare($koneksi, $query_update);

if ($stmt_update) {
    mysqli_stmt_bind_param($stmt_update, 'ii', $bank_default, $id);
    mysqli_stmt_execute($stmt_update);
    mysqli_stmt_close($stmt_update);
}

// delete
$query_delete = "DELETE FROM bank WHERE bank_id = ?";
$stmt_delete = mysqli_prepare($koneksi, $query_delete);

if ($stmt_delete) {
    mysqli_stmt_bind_param($stmt_delete, 'i', $id);
    mysqli_stmt_execute($stmt_delete);
    mysqli_stmt_close($stmt_delete);
}

header("Location: bank.php");
exit();
?>