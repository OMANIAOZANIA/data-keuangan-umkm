<?php
include 'header.php';
include '../config/db.php';
?>

<div class="content-wrapper">

<section class="content-header">
    <h1>
    Bank
    <small>Data bank</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Bank</li>
    </ol>
</section>

<section class="content">
    <div class="row">
    <section class="col-lg-12">
        <div class="box box-info">

        <div class="box-header">
            <h3 class="box-title">Data Akun Bank</h3>
        </div>

        <div class="box-body">
            <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                <tr>
                    <th width="1%">No</th>
                    <th>Nama Bank</th>
                    <th>Pemilik Rekening</th>
                    <th>Nomor Rekening</th>
                    <th>Saldo</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;

                $stmt = $koneksi->prepare("SELECT * FROM bank");
                $stmt->execute();
                $result = $stmt->get_result();

                while($d = $result->fetch_assoc()){
                    echo "<tr>
                            <td>{$no}</td>
                            <td>" . htmlspecialchars($d['bank_nama']) . "</td>
                            <td>" . htmlspecialchars($d['bank_pemilik']) . "</td>
                            <td>" . htmlspecialchars($d['bank_nomor']) . "</td>
                            <td>Rp. " . number_format($d['bank_saldo']) . " ,-</td>
                        </tr>";
                    $no++;
                }

                $stmt->close();
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