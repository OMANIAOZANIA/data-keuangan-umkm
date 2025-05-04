<?php include 'header.php'; ?>
<?php include '../config/db.php'; ?>

<div class="content-wrapper">
<section class="content-header">
    <h1>Transaksi <small>Data Transaksi</small></h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
    <div class="row">
    <section class="col-lg-12">
        <div class="box box-info">
            
        <div class="box-header">
            <h3 class="box-title">Transaksi Bank BRI</h3>
            <div class="btn-group pull-right">
            <p><b>Total Saldo:</b>
                <?php
                $stmt = $koneksi->prepare("SELECT bank_saldo FROM bank WHERE bank_id = ?");
                $stmt->bind_param("i", $bank_id);
                $bank_id = 1;
                $stmt->execute();
                $stmt->bind_result($saldo);
                while ($stmt->fetch()) {
                echo "Rp. " . number_format($saldo) . " ,-";
                }
                $stmt->close();
                ?>
            </p>
            </div>
        </div>

        <div class="box-body">
            <!-- Modal Tambah Transaksi -->
            <form action="transaksi_act.php" method="post">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h4>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" name="tanggal" required class="form-control datepicker2">
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <select name="jenis" class="form-control" required>
                        <option value="">- Pilih -</option>
                        <option value="Pemasukan">Pemasukan</option>
                        <option value="Pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" required>
                        <option value="">- Pilih -</option>
                        <?php
                        $stmt = $koneksi->prepare("SELECT kategori_id, kategori FROM kategori ORDER BY kategori ASC");
                        $stmt->execute();
                        $stmt->bind_result($kategori_id, $kategori_nama);
                        while ($stmt->fetch()) {
                            echo "<option value='" . htmlspecialchars($kategori_id) . "'>" . htmlspecialchars($kategori_nama) . "</option>";
                        }
                        $stmt->close();
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" name="nominal" required class="form-control" placeholder="Masukkan Nominal ..">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Rekening Bank</label>
                        <select name="bank" class="form-control" required>
                        <option value="">- Pilih -</option>
                        <?php
                        $stmt = $koneksi->prepare("SELECT bank_id, bank_nama FROM bank");
                        $stmt->execute();
                        $stmt->bind_result($bank_id, $bank_nama);
                        while ($stmt->fetch()) {
                            echo "<option value='" . htmlspecialchars($bank_id) . "'>" . htmlspecialchars($bank_nama) . "</option>";
                        }
                        $stmt->close();
                        ?>
                        </select>
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
                    <th width="1%" rowspan="2">NO</th>
                    <th width="10%" rowspan="2" class="text-center">TANGGAL</th>
                    <th rowspan="2" class="text-center">KATEGORI</th>
                    <th colspan="2" class="text-center">JENIS</th>
                </tr>
                <tr>
                    <th class="text-center">PEMASUKAN</th>
                    <th class="text-center">PENGELUARAN</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = "
                    SELECT t.transaksi_id, t.transaksi_tanggal, t.transaksi_jenis, 
                        t.transaksi_nominal, k.kategori 
                    FROM transaksi t 
                    JOIN kategori k ON k.kategori_id = t.transaksi_kategori 
                    WHERE t.transaksi_bank = 1 
                    ORDER BY t.transaksi_id DESC
                ";
                $result = $koneksi->query($query);
                $no = 1;
                while ($d = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='text-center'>" . $no++ . "</td>";
                    echo "<td class='text-center'>" . date('d-m-Y', strtotime($d['transaksi_tanggal'])) . "</td>";
                    echo "<td>" . htmlspecialchars($d['kategori']) . "</td>";
                    echo "<td class='text-center'>" . ($d['transaksi_jenis'] == "Pemasukan" ? "Rp. " . number_format($d['transaksi_nominal']) . " ,-": "-") . "</td>";
                    echo "<td class='text-center'>" . ($d['transaksi_jenis'] == "Pengeluaran" ? "Rp. " . number_format($d['transaksi_nominal']) . " ,-": "-") . "</td>";
                    echo "</tr>";
                }
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
