<?php 
include '../config/db.php';

$kategori = $_POST['kategori'] ?? '';

// Insert
if ($stmt = $koneksi->prepare("INSERT INTO kategori (kategori) VALUES (?)")) {
    $stmt->bind_param("s", $kategori);  // 's' for string
    $stmt->execute();
    $stmt->close();
}

header("Location: kategori.php");
exit;
?>