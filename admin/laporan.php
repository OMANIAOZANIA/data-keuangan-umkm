<?php
include 'header.php';
include '../config/db.php';
?>

<div class="content-wrapper">
<section class="content-header">
    <h1>LAPORAN <small>Data Laporan</small></h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
    <div class="row">
    <section class="col-lg-12">
        <div class="box box-info">

        <!-- Filter -->
        <div class="box-header">
            <h3 class="box-title">Filter Laporan</h3>
        </div>
        <div class="box-body">
            <form method="get" action="">
            <div class="row">
                <div class="col-md-3">
                <div class="form-group">
                    <label>Mulai Tanggal</label>
                    <input autocomplete="off" type="text" value="<?= isset($_GET['tanggal_dari']) ? $_GET['tanggal_dari'] : '' ?>" name="tanggal_dari" class="form-control datepicker2" placeholder="Mulai Tanggal" required>
                </div>
                </div>

                <div class="col-md-3">
                <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input autocomplete="off" type="text" value="<?= isset($_GET['tanggal_sampai']) ? $_GET['tanggal_sampai'] : '' ?>" name="tanggal_sampai" class="form-control datepicker2" placeholder="Sampai Tanggal" required>
                </div>
                </div>

                <div class="col-md-3">
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control" required>
                    <option value="semua">- Semua Kategori -</option>
                    <?php 
                    $kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
                    while($k = mysqli_fetch_array($kategori)){
                        $selected = (isset($_GET['kategori']) && $_GET['kategori'] == $k['kategori_id']) ? "selected" : "";
                        echo "<option value='{$k['kategori_id']}' $selected>{$k['kategori']}</option>";
                    }
                    ?>
                    </select>
                </div>
                </div>

                <div class="col-md-3">
                <div class="form-group">
                    <br/>
                    <input type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary btn-block">
                </div>
                </div>
            </div>
            </form>
        </div>
        </div>

        <!-- Laporan -->
        <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Laporan Pemasukan & Pengeluaran</h3>
        </div>
        <div class="box-body">

            <?php 
            if(isset($_GET['tanggal_sampai'], $_GET['tanggal_dari'], $_GET['kategori'])){
            $tgl_dari = $_GET['tanggal_dari'];
            $tgl_sampai = $_GET['tanggal_sampai'];
            $kategori = $_GET['kategori'];
            ?>

            <div class="row">
                <div class="col-lg-6">
                <table class="table table-bordered">
                    <tr>
                    <th width="30%">DARI TANGGAL</th><th width="1%">:</th><td><?= $tgl_dari; ?></td>
                    </tr>
                    <tr>
                    <th>SAMPAI TANGGAL</th><th>:</th><td><?= $tgl_sampai; ?></td>
                    </tr>
                    <tr>
                    <th>KATEGORI</th><th>:</th>
                    <td>
                        <?php 
                        if($kategori == "semua"){
                        echo "SEMUA KATEGORI";
                        } else {
                        $stmt = $koneksi->prepare("SELECT * FROM kategori WHERE kategori_id = ?");
                        $stmt->bind_param("i", $kategori);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $kk = $result->fetch_assoc();
                        echo $kk['kategori'] ?? 'Tidak diketahui';
                        }
                        ?>
                    </td>
                    </tr>
                </table>
                </div>
            </div>

            <a href="laporan_pdf.php?tanggal_dari=<?= $tgl_dari ?>&tanggal_sampai=<?= $tgl_sampai ?>&kategori=<?= $kategori ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
            <a href="laporan_print.php?tanggal_dari=<?= $tgl_dari ?>&tanggal_sampai=<?= $tgl_sampai ?>&kategori=<?= $kategori ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th rowspan="2" class="text-center">NO</th>
                    <th rowspan="2" class="text-center">TANGGAL</th>
                    <th rowspan="2" class="text-center">KATEGORI</th>
                    <th rowspan="2" class="text-center">KETERANGAN</th>
                    <th colspan="2" class="text-center">JENIS</th>
                    </tr>
                    <tr>
                    <th class="text-center">PEMASUKAN</th>
                    <th class="text-center">PENGELUARAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $total_pemasukan = 0;
                    $total_pengeluaran = 0;

                    if($kategori == "semua"){
                    $stmt = $koneksi->prepare("SELECT * FROM transaksi JOIN kategori ON kategori_id = transaksi_kategori WHERE date(transaksi_tanggal) >= ? AND date(transaksi_tanggal) <= ?");
                    $stmt->bind_param("ss", $tgl_dari, $tgl_sampai);
                    } else {
                    $stmt = $koneksi->prepare("SELECT * FROM transaksi JOIN kategori ON kategori_id = transaksi_kategori WHERE kategori_id = ? AND date(transaksi_tanggal) >= ? AND date(transaksi_tanggal) <= ?");
                    $stmt->bind_param("iss", $kategori, $tgl_dari, $tgl_sampai);
                    }

                    $stmt->execute();
                    $data = $stmt->get_result();

                    while($d = $data->fetch_assoc()){
                    $nominal = number_format($d['transaksi_nominal']);
                    if($d['transaksi_jenis'] == "Pemasukan"){
                        $total_pemasukan += $d['transaksi_nominal'];
                    } elseif($d['transaksi_jenis'] == "Pengeluaran"){
                        $total_pengeluaran += $d['transaksi_nominal'];
                    }
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
                        <td><?= $d['kategori']; ?></td>
                        <td><?= $d['transaksi_keterangan']; ?></td>
                        <td class="text-center"><?= $d['transaksi_jenis'] == "Pemasukan" ? "Rp. $nominal ,-": "-" ?></td>
                        <td class="text-center"><?= $d['transaksi_jenis'] == "Pengeluaran" ? "Rp. $nominal ,-": "-" ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                    <th colspan="4" class="text-right">TOTAL</th>
                    <td class="text-center text-bold text-success"><?= "Rp. " . number_format($total_pemasukan) . " ,-"; ?></td>
                    <td class="text-center text-bold text-danger"><?= "Rp. " . number_format($total_pengeluaran) . " ,-"; ?></td>
                    </tr>
                    <tr>
                    <th colspan="4" class="text-right">SALDO</th>
                    <td colspan="2" class="text-center text-bold text-white bg-primary"><?= "Rp. " . number_format($total_pemasukan - $total_pengeluaran) . " ,-"; ?></td>
                    </tr>
                </tbody>
                </table>
            </div>

            <?php } else { ?>
            <div class="alert alert-info text-center">
                Silahkan Filter Laporan Terlebih Dulu.
            </div>
            <?php } ?>

        </div>
        </div>
    </section>
    </div>
</section>
</div>

<?php include 'footer.php'; ?>