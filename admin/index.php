<?php
include 'header.php';
include '../config/db.php';
?>

<div class="content-wrapper">

<section class="content-header">
    <h1>Dashboard <small>Control panel</small></h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
    <div class="row">
    <?php
    $tanggal = date('Y-m-d');
    $bulan = date('m');
    $tahun = date('Y');

    $query = function($jenis, $waktu = '') use ($koneksi) {
        $sql = "SELECT SUM(transaksi_nominal) as total FROM transaksi WHERE transaksi_jenis = ?";
        $params = [$jenis];

        if ($waktu === 'tanggal') {
        $sql .= " AND transaksi_tanggal = ?";
        $params[] = date('Y-m-d');
        } elseif ($waktu === 'bulan') {
        $sql .= " AND MONTH(transaksi_tanggal) = ?";
        $params[] = date('m');
        } elseif ($waktu === 'tahun') {
        $sql .= " AND YEAR(transaksi_tanggal) = ?";
        $params[] = date('Y');
        }

        $stmt = $koneksi->prepare($sql);

        // Bind parameters dynamically
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);

        $stmt->execute();
        $result = $stmt->get_result();
        $total = $result->fetch_assoc()['total'] ?? 0;
        $stmt->close();

        return number_format($total);
    };

    $boxes = [
        ['label' => 'Pemasukan Hari Ini', 'color' => 'green', 'value' => $query('Pemasukan', 'tanggal')],
        ['label' => 'Pemasukan Bulan Ini', 'color' => 'blue', 'value' => $query('Pemasukan', 'bulan')],
        ['label' => 'Pemasukan Tahun Ini', 'color' => 'orange', 'value' => $query('Pemasukan', 'tahun')],
        ['label' => 'Seluruh Pemasukan', 'color' => 'black', 'value' => $query('Pemasukan')],
        ['label' => 'Pengeluaran Hari Ini', 'color' => 'red', 'value' => $query('pengeluaran', 'tanggal')],
        ['label' => 'Pengeluaran Bulan Ini', 'color' => 'red', 'value' => $query('pengeluaran', 'bulan')],
        ['label' => 'Pengeluaran Tahun Ini', 'color' => 'red', 'value' => $query('pengeluaran', 'tahun')],
        ['label' => 'Seluruh Pengeluaran', 'color' => 'black', 'value' => $query('pengeluaran')],
    ];

    foreach ($boxes as $box) {
        echo "<div class='col-lg-3 col-xs-6'>
                <div class='small-box bg-{$box['color']}'>
                <div class='inner'>
                    <h4 style='font-weight: bolder'>Rp. {$box['value']} ,-</h4>
                    <p>{$box['label']}</p>
                </div>
                <div class='icon'><i class='ion ion-stats-bars'></i></div>
                <a href='bank.php' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
                </div>
            </div>";
    }
    ?>
    </div>

    <div class="row">
    <section class="col-lg-8">
        <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#tab1" data-toggle="tab">Pemasukan & Pengeluaran</a></li>
            <li class="pull-left header">Grafik</li>
        </ul>
        <div class="tab-content" style="padding: 20px">
            <div class="chart tab-pane active" id="tab1">
            <h4 class="text-center">Grafik Data Pemasukan & Pengeluaran Per <b>Bulan</b></h4>
            <canvas id="grafik1" style="position: relative; height: 300px;"></canvas>
            <br><br><br>
            <h4 class="text-center">Grafik Data Pemasukan & Pengeluaran Per <b>Tahun</b></h4>
            <canvas id="grafik2" style="position: relative; height: 300px;"></canvas>
            </div>
        </div>
        </div>
    </section>

    <section class="col-lg-4">
        <div class="box box-solid bg-green-gradient">
        <div class="box-header">
            <i class="fa fa-calendar"></i>
            <h3 class="box-title">Kalender</h3>
        </div>
        <div class="box-body no-padding">
            <div id="calendar" style="width: 100%"></div>
        </div>
        </div>
    </section>
    
    </div>
</section>

</div>

<?php include 'footer.php'; ?>