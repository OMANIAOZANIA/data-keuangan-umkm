<?php 
include '../config/db.php';

$nama     = htmlspecialchars(trim($_POST['nama']));
$username = htmlspecialchars(trim($_POST['username']));
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$level    = htmlspecialchars(trim($_POST['level']));

$rand     = rand();
$allowed  = array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];

if($filename == ""){
	mysqli_query($koneksi, "INSERT INTO user VALUES (NULL, '$nama', '$username', '$password', '', '$level')");
	header("location:user.php");
} else {
	$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

	if(!in_array($ext, $allowed)) {
		header("location:user.php?alert=gagal");
	} else {
		$file_gambar = $rand . '_' . basename($filename);
		$target_path = '../gambar/user/' . $file_gambar;

		if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)) {
			mysqli_query($koneksi, "INSERT INTO user VALUES (NULL, '$nama', '$username', '$password', '$file_gambar', '$level')");
			header("location:user.php");
		} else {
			header("location:user.php?alert=gagal_upload");
		}
	}
}
?>