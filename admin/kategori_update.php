<?php 
include '../config/db.php';

$id = $_POST['id'] ?? '';
$kategori = $_POST['kategori'] ?? '';

// Update
if ($stmt = $koneksi->prepare("UPDATE kategori SET kategori = ? WHERE kategori_id = ?")) {
    $stmt->bind_param("si", $kategori, $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: kategori.php");
exit;
?>