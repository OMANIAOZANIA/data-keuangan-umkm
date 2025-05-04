<?php
include 'header.php';
include '../config/db.php';
?>

<div class="content-wrapper">

<section class="content-header">
    <h1>Kategori <small>Data kategori</small></h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Kategori</li>
    </ol>
</section>

<section class="content">
    <div class="row">

    <section class="col-lg-12">
        <div class="box box-info">

        <div class="box-header">
            <h3 class="box-title">Kategori Transaksi Keuangan</h3>
            <div class="btn-group pull-right">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalTambah">
                <i class="fa fa-plus"></i> &nbsp;Tambah Kategori
            </button>
            </div>
        </div>

        <div class="box-body">
            <!-- Modal Tambah -->
            <form action="kategori_act.php" method="post">
            <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="kategori" required class="form-control" placeholder="Nama Kategori ..">
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                </div>
            </div>
            </form>

            <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                <tr>
                    <th width="1%">NO</th>
                    <th>NAMA</th>
                    <th width="10%">OPSI</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                $stmt = $koneksi->prepare("SELECT kategori_id, kategori FROM kategori ORDER BY kategori ASC");
                $stmt->execute();
                $result = $stmt->get_result();
                while($d = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($d['kategori']) ?></td>
                    <td>
                    <?php if ($d['kategori_id'] != 1): ?>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editKategori<?= $d['kategori_id'] ?>">
                        <i class="fa fa-cog"></i>
                        </button>

                        <!-- Hapus Button -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusKategori<?= $d['kategori_id'] ?>">
                        <i class="fa fa-trash"></i>
                        </button>

                        <!-- Modal Edit -->
                        <form action="kategori_update.php" method="post">
                        <div class="modal fade" id="editKategori<?= $d['kategori_id'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title">Edit Kategori</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Kategori</label>
                                    <input type="hidden" name="id" value="<?= $d['kategori_id'] ?>">
                                    <input type="text" name="kategori" required class="form-control" value="<?= htmlspecialchars($d['kategori']) ?>">
                                </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        </form>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapusKategori<?= $d['kategori_id'] ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Peringatan!</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Yakin ingin menghapus data ini?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <a href="kategori_hapus.php?id=<?= $d['kategori_id'] ?>" class="btn btn-primary">Hapus</a>
                            </div>
                            </div>
                        </div>
                        </div>
                    <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; $stmt->close(); ?>
                </tbody>
            </table>
            </div>
        </div>
        
        </div>
    </section>

    </div>
</section>

</div>

<?php include 'footer.php'; ?>