<?php 
include '../config/db.php';

$id       = $_POST['id'];
$nama     = $_POST['nama'];
$username = $_POST['username'];
$pwd      = $_POST['password'];
$level    = $_POST['level'];

$rand     = rand();
$allowed  = ['gif', 'png', 'jpg', 'jpeg'];
$filename = $_FILES['foto']['name'];
$ext      = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
$tmp_name = $_FILES['foto']['tmp_name'];

// upload foto function
function upload_foto($filename, $tmp_name, $rand) {
    $new_filename = $rand . '_' . $filename;
    move_uploaded_file($tmp_name, '../gambar/user/' . $new_filename);
    return $new_filename;
}

// CASE 1: update username, name & level only
if ($pwd == "" && $filename == "") {
    $query = "UPDATE user SET user_nama = ?, user_username = ?, user_level = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'sssi', $nama, $username, $level, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: user.php");
    exit();

// CASE 2: update username, name & level only + photo
} elseif ($pwd == "") {
    if (!in_array($ext, $allowed)) {
        header("Location: user.php?alert=gagal");
        exit();
    } else {
        $new_filename = upload_foto($filename, $tmp_name, $rand);
        $query = "UPDATE user SET user_nama = ?, user_username = ?, user_foto = ?, user_level = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'ssssi', $nama, $username, $new_filename, $level, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: user.php?alert=berhasil");
        exit();
    }

// CASE 3: update username, name & level only + password
} elseif ($filename == "") {
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
    $query = "UPDATE user SET user_nama = ?, user_username = ?, user_password = ?, user_level = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'ssssi', $nama, $username, $hashed_password, $level, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: user.php");
    exit();

// CASE 4: update username, name & level only + password + photo
} else {
    if (!in_array($ext, $allowed)) {
        header("Location: user.php?alert=gagal");
        exit();
    } else {
        $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
        $new_filename = upload_foto($filename, $tmp_name, $rand);
        $query = "UPDATE user SET user_nama = ?, user_username = ?, user_password = ?, user_foto = ?, user_level = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'sssssi', $nama, $username, $hashed_password, $new_filename, $level, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: user.php?alert=berhasil");
        exit();
    }
}
?>