<?php 
include '../config/db.php';

// validasi data POST
$id         = intval($_POST['id']);
$tanggal    = $_POST['tanggal'];
$jenis      = $_POST['jenis'];
$kategori   = intval($_POST['kategori']);
$nominal    = floatval($_POST['nominal']);
$keterangan = $_POST['keterangan'];
$bank       = intval($_POST['bank']);

// get data transaksi lama
$stmt = $koneksi->prepare("SELECT * FROM transaksi WHERE transaksi_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();	
$t = $stmt->get_result()->fetch_assoc();
$stmt->close();

$bank_lama = $t['transaksi_bank'];

// get saldo bank lama
$stmt = $koneksi->prepare("SELECT * FROM bank WHERE bank_id = ?");
$stmt->bind_param("i", $bank_lama);
$stmt->execute();
$r = $stmt->get_result()->fetch_assoc();
$stmt->close();

// return saldo lama
if ($t['transaksi_jenis'] == "Pemasukan") {
    $kembalikan = $r['bank_saldo'] - $t['transaksi_nominal'];
} else {
    $kembalikan = $r['bank_saldo'] + $t['transaksi_nominal'];
}
$stmt = $koneksi->prepare("UPDATE bank SET bank_saldo = ? WHERE bank_id = ?");
$stmt->bind_param("di", $kembalikan, $bank_lama);
$stmt->execute();
$stmt->close();

// get saldo bank baru
$stmt = $koneksi->prepare("SELECT * FROM bank WHERE bank_id = ?");
$stmt->bind_param("i", $bank);
$stmt->execute();
$rr = $stmt->get_result()->fetch_assoc();
$stmt->close();

$saldo_sekarang = $rr['bank_saldo'];
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

// update transaksi
$stmt = $koneksi->prepare("UPDATE transaksi SET transaksi_tanggal=?, transaksi_jenis=?, transaksi_kategori=?, transaksi_nominal=?, transaksi_keterangan=?, transaksi_bank=? WHERE transaksi_id=?");
$stmt->bind_param("ssidsii", $tanggal, $jenis, $kategori, $nominal, $keterangan, $bank, $id);
$stmt->execute();
$stmt->close();

header("Location: transaksi.php");
exit();
?>