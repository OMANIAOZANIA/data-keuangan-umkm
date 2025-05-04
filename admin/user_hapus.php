<?php 
include '../config/db.php';

$id = $_GET['id'];

// get user
$query = "SELECT user_foto FROM user WHERE user_id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$d = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// delete user photo
if (!empty($d['user_foto'])) {
    $foto_path = "../gambar/user/" . $d['user_foto'];
    if (file_exists($foto_path)) {
        unlink($foto_path);
    }
}

// delete user
$query_delete = "DELETE FROM user WHERE user_id = ?";
$stmt_delete = mysqli_prepare($koneksi, $query_delete);
mysqli_stmt_bind_param($stmt_delete, 'i', $id);
mysqli_stmt_execute($stmt_delete);
mysqli_stmt_close($stmt_delete);

header("Location: user.php");
exit();
?>