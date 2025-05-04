<?php
include 'header.php';
include '../config/db.php';
?>

<div class="content-wrapper">
<section class="content-header">
    <h1>Kategori<small>Data kategori</small></h1>
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
        </div>

        <div class="box-body">
            <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                <tr>
                    <th width="1%">No</th>
                    <th>Nama</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;

                $query = $koneksi->prepare("SELECT * FROM kategori ORDER BY kategori ASC");
                $query->execute();
                $result = $query->get_result();

                while ($d = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>" . htmlspecialchars($d['kategori']) . "</td>
                        </tr>";
                    $no++;
                }

                $query->close();
                ?>
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