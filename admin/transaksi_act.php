<?php 
include '../config/db.php';

// validasi data POST
$tanggal    = $_POST['tanggal'];
$jenis      = $_POST['jenis'];
$kategori   = intval($_POST['kategori']);
$nominal    = floatval($_POST['nominal']);
$keterangan = $_POST['keterangan'];
$bank       = intval($_POST['bank']);

// get saldo bank saat ini
$stmt = $koneksi->prepare("SELECT bank_saldo FROM bank WHERE bank_id = ?");
$stmt->bind_param("i", $bank);
$stmt->execute();
$result = $stmt->get_result();
$r = $result->fetch_assoc();
$stmt->close();

$saldo_sekarang = $r['bank_saldo'];
if ($jenis == "Pemasukan") {
    $total = $saldo_sekarang + $nominal;
} else {
    $total = $saldo_sekarang - $nominal;
}

// update saldo bank
$stmt = $koneksi->prepare("UPDATE bank SET bank_saldo = ? WHERE bank_id = ?");
$stmt->bind_param("di", $total, $bank);
$stmt->execute();
$stmt->close();

// insert transaksi baru
$stmt = $koneksi->prepare("INSERT INTO transaksi (transaksi_tanggal, transaksi_jenis, transaksi_kategori, transaksi_nominal, transaksi_keterangan, transaksi_bank) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssidsi", $tanggal, $jenis, $kategori, $nominal, $keterangan, $bank);
$stmt->execute();
$stmt->close();

header("Location: transaksi.php");
exit();
?>