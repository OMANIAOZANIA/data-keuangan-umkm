<?php
include '../config/db.php';

// PDF libary
require '../library/fpdf181/fpdf.php';

$tgl_dari = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];

// new pdf
$pdf = new FPDF('l', 'mm', 'A4');
$pdf->AddPage();

// set font
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(280, 7, 'Laporan Keuangan UMKM', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(280, 7, 'Kelompok 4 XI.8 ACCELEREIGHT', 0, 1, 'C');

// make table
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(35, 6, 'DARI TANGGAL', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);
$pdf->Cell(35, 6, date('d-m-Y', strtotime($tgl_dari)), 0, 0);
$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell(35, 6, 'SAMPAI TANGGAL', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);
$pdf->Cell(35, 6, date('d-m-Y', strtotime($tgl_sampai)), 0, 0);
$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell(35, 6, 'KATEGORI', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);

$kategori = $_GET['kategori'];
if ($kategori == "semua") {
    $kategori_select = "SEMUA KATEGORI";
} else {
    $stmt = $koneksi->prepare("SELECT * FROM kategori WHERE kategori_id = ?");
    $stmt->bind_param("s", $kategori);
    $stmt->execute();
    $result = $stmt->get_result();
    $d = $result->fetch_assoc();
    $kategori_select = $d['kategori'];
}
$pdf->Cell(35, 6, $kategori_select, 0, 0);

$pdf->Cell(10, 10, '', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 14, 'NO', 1, 0, 'C');
$pdf->Cell(35, 14, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(45, 14, 'KATEGORI', 1, 0, 'C');
$pdf->Cell(105, 14, 'KETERANGAN', 1, 0, 'C');
$pdf->Cell(82, 7, 'JENIS', 1, 0, 'C');
$pdf->Cell(1, 7, '', 0, 1);

$pdf->Cell(195, 7, '', 0, 0);
$pdf->Cell(41, 7, 'PEMASUKAN', 1, 0, 'C');
$pdf->Cell(41, 7, 'PENGELUARAN', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);

$no = 1;
$total_pemasukan = 0;
$total_pengeluaran = 0;

// get data
if ($kategori == "semua") {
    $stmt = $koneksi->prepare("SELECT * FROM transaksi, kategori WHERE kategori_id = transaksi_kategori AND DATE(transaksi_tanggal) >= ? AND DATE(transaksi_tanggal) <= ?");
    $stmt->bind_param("ss", $tgl_dari, $tgl_sampai);
} else {
    $stmt = $koneksi->prepare("SELECT * FROM transaksi, kategori WHERE kategori_id = transaksi_kategori AND kategori_id = ? AND DATE(transaksi_tanggal) >= ? AND DATE(transaksi_tanggal) <= ?");
    $stmt->bind_param("sss", $kategori, $tgl_dari, $tgl_sampai);
}

$stmt->execute();
$result = $stmt->get_result();

// show data transaksi
while ($d = $result->fetch_array()) {
    if ($d['transaksi_jenis'] == "Pemasukan") {
        $total_pemasukan += $d['transaksi_nominal'];
    } elseif ($d['transaksi_jenis'] == "Pengeluaran") {
        $total_pengeluaran += $d['transaksi_nominal'];
    }

    $pdf->Cell(10, 7, $no++, 1, 0, 'C');
    $pdf->Cell(35, 7, date('d-m-Y', strtotime($d['transaksi_tanggal'])), 1, 0, 'C');
    $pdf->Cell(45, 7, $d['kategori'], 1, 0, 'C');
    $pdf->Cell(105, 7, $d['transaksi_keterangan'], 1, 0, 'C');

    $pem = $d['transaksi_jenis'] == "Pemasukan" ? "Rp. " . number_format($d['transaksi_nominal']) . " ,-": "-";
    $peng = $d['transaksi_jenis'] == "Pengeluaran" ? "Rp. " . number_format($d['transaksi_nominal']) . " ,-": "-";

    $pdf->Cell(41, 7, $pem, 1, 0, 'C');
    $pdf->Cell(41, 7, $peng, 1, 1, 'C');

    $pdf->Cell(10, 0, '', 0, 1);
}

// show total pemasukan & pengeluaran
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 7, "TOTAL ", 1, 0, 'R');
$pdf->Cell(41, 7, "Rp. " . number_format($total_pemasukan) . " ,-", 1, 0, 'C');
$pdf->Cell(41, 7, "Rp. " . number_format($total_pengeluaran) . " ,-", 1, 1, 'C');
$pdf->Cell(10, 0, '', 0, 1);

$pdf->Cell(195, 7, "SALDO ", 1, 0, 'R');
$pdf->Cell(82, 7, "Rp. " . number_format($total_pemasukan - $total_pengeluaran) . " ,-", 1, 0, 'C');

$pdf->Cell(10, 7, '', 0, 1);

// output pdf
$pdf->Output();
?>