<?php 
include 'header.php';
include '../config/db.php';
?>

<div class="content-wrapper">
<section class="content-header">
    <h1>Pengguna <small>Edit Pengguna</small></h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
    <div class="row">
    <section class="col-lg-6 col-lg-offset-3">       
        <div class="box box-info">

        <div class="box-header">
            <h3 class="box-title">Edit Pengguna</h3>
            <a href="user.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp; Kembali</a> 
        </div>
        <div class="box-body">
            <form action="user_update.php" method="post" enctype="multipart/form-data">
            <?php 
            $id = $_GET['id'];

            $stmt = mysqli_prepare($koneksi, "SELECT * FROM user WHERE user_id = ?");
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $d = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);

            if ($d) {
            ?>

                <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($d['user_nama']) ?>" required>
                <input type="hidden" class="form-control" name="id" value="<?= $d['user_id'] ?>" required>
                </div>

                <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($d['user_username']) ?>" required>
                </div>

                <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" minlength="5" placeholder="Kosong Jika tidak ingin diganti">
                <p class="text-muted">Kosong Jika tidak ingin diganti</p>
                </div>

                <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="level" required>
                    <option value="">- Pilih Level -</option>
                    <option value="administrator" <?= $d['user_level'] == "administrator" ? "selected" : "" ?>>Administrator</option>
                    <option value="manajemen" <?= $d['user_level'] == "manajemen" ? "selected" : "" ?>>Manajemen</option>
                </select>
                </div>

                <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto">
                <p class="text-muted">Kosong Jika tidak ingin diganti</p>
                </div>

                <div class="form-group">
                <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                </div>

            <?php } else { ?>
                <div class="alert alert-danger">Pengguna tidak ditemukan.</div>
            <?php } ?>
            </form>
        </div>

        </div>
    </section>
    </div>
</section>
</div>

<?php include 'footer.php'; ?>