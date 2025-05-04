<?php 
include '../config/db.php';

$id = $_GET['id'] ?? '';

if (!empty($id) && is_numeric($id)) {
    // Update
    if ($stmt1 = $koneksi->prepare("UPDATE transaksi SET transaksi_kategori = 1 WHERE transaksi_kategori = ?")) {
        $stmt1->bind_param("i", $id);
        $stmt1->execute();
        $stmt1->close();
    }

    // Hapus kategori
    if ($stmt2 = $koneksi->prepare("DELETE FROM kategori WHERE kategori_id = ?")) {
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt2->close();
    }
}

header("Location: kategori.php");
exit;
?>