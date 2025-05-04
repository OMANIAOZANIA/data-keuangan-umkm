<?php 
include '../config/db.php';
$id  = $_GET['id'];

$query = $koneksi->prepare("SELECT * FROM transaksi WHERE transaksi_id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$t = $result->fetch_assoc();
$bank_lama = $t['transaksi_bank'];

$query_bank = $koneksi->prepare("SELECT * FROM bank WHERE bank_id = ?");
$query_bank->bind_param("i", $bank_lama);
$query_bank->execute();
$result_bank = $query_bank->get_result();
$r = $result_bank->fetch_assoc();

$jenis = $t['transaksi_jenis'];
$nominal = $t['transaksi_nominal'];

// update bank saldo
if($jenis == "Pemasukan"){
    $saldo_sekarang = $r['bank_saldo'];
    $total = $saldo_sekarang - $nominal;
}elseif($jenis == "Pengeluaran"){
    $saldo_sekarang = $r['bank_saldo'];
    $total = $saldo_sekarang + $nominal;
}
$update_bank = $koneksi->prepare("UPDATE bank SET bank_saldo = ? WHERE bank_id = ?");
$update_bank->bind_param("di", $total, $bank_lama);
$update_bank->execute();

// delete
$delete_transaction = $koneksi->prepare("DELETE FROM transaksi WHERE transaksi_id = ?");
$delete_transaction->bind_param("i", $id);
$delete_transaction->execute();

header("Location: transaksi.php");
exit;
?>