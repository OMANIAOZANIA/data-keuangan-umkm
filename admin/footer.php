<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 0.2a (revised by omaniaozania)
    </div>
    <strong>Copyright Kelompok 4 | XI.8 ACCELEREIGHT &copy; 2024-2025</strong> - Laporan Keuangan UMKM
</footer>
</div>

<!-- AdminLTE and Bower -->
<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>$.widget.bridge('uibutton', $.ui.button);</script>
<script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../assets/bower_components/raphael/raphael.min.js"></script>
<script src="../assets/bower_components/morris.js/morris.min.js"></script>
<script src="../assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="../assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="../assets/bower_components/moment/min/moment.min.js"></script>
<script src="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="../assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="../assets/dist/js/adminlte.min.js"></script>
<script src="../assets/dist/js/pages/dashboard.js"></script>
<script src="../assets/dist/js/demo.js"></script>
<script src="../assets/bower_components/ckeditor/ckeditor.js"></script>
<script src="../assets/bower_components/chart.js/Chart.min.js"></script>

<!-- Initialize -->
<script>
    $(document).ready(function() {
        $('#table-datatable').DataTable({
            paging: true,
            lengthChange: false,
            searching: true,
            ordering: false,
            info: true,
            autoWidth: true,
            pageLength: 50
        });
    });

    $('#datepicker').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
    }).datepicker("setDate", new Date());

    $('.datepicker2').datepicker({
        autoclose: true,
        format: 'yyyy/mm/dd',
    });
</script>

<!-- Barchart (Dashboard) -->
<script>
    var randomScalingFactor = function() { return Math.round(Math.random() * 100) };

    var barChartData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
        datasets: [{
            label: 'Pemasukan',
            fillColor: "rgba(51, 240, 113, 0.61)",
            strokeColor: "rgba(11, 246, 88, 0.61)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [
            <?php
            for($bulan=1; $bulan<=12; $bulan++){
                $thn_ini = date('Y');
                $pemasukan = mysqli_query($koneksi, "SELECT SUM(transaksi_nominal) AS total_pemasukan FROM transaksi WHERE transaksi_jenis='Pemasukan' AND MONTH(transaksi_tanggal)='$bulan' AND YEAR(transaksi_tanggal)='$thn_ini'");
                $pem = mysqli_fetch_assoc($pemasukan);
                $total = $pem['total_pemasukan'];
                echo $total ? $total . "," : "0,";
            }
            ?>
            ]
        },
        {
            label: 'Pengeluaran',
            fillColor: "rgba(255, 51, 51, 0.8)",
            strokeColor: "rgba(248, 5, 5, 0.8)",
            highlightFill: "rgba(151,187,205,0.75)",
            highlightStroke: "rgba(151,187,205,1)",
            data: [
            <?php
            for($bulan=1; $bulan<=12; $bulan++){
                $thn_ini = date('Y');
                $pengeluaran = mysqli_query($koneksi, "SELECT SUM(transaksi_nominal) AS total_pengeluaran FROM transaksi WHERE transaksi_jenis='Pengeluaran' AND MONTH(transaksi_tanggal)='$bulan' AND YEAR(transaksi_tanggal)='$thn_ini'");
                $peng = mysqli_fetch_assoc($pengeluaran);
                $total = $peng['total_pengeluaran'];
                echo $total ? $total . "," : "0,";
            }
            ?>
            ]
        }
        ]
    };

    var barChartData2 = {
        labels: [
        <?php
        $tahun = mysqli_query($koneksi, "SELECT DISTINCT YEAR(transaksi_tanggal) AS tahun FROM transaksi ORDER BY YEAR(transaksi_tanggal) ASC");
        while($t = mysqli_fetch_array($tahun)) {
            echo '"' . $t['tahun'] . '",';
        }
        ?>
        ],
        datasets: [{
            label: 'Pemasukan',
            fillColor: "rgba(51, 240, 113, 0.61)",
            strokeColor: "rgba(11, 246, 88, 0.61)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [
            <?php
            $tahun = mysqli_query($koneksi, "SELECT DISTINCT YEAR(transaksi_tanggal) AS tahun FROM transaksi ORDER BY YEAR(transaksi_tanggal) ASC");
            while($t = mysqli_fetch_array($tahun)) {
                $thn = $t['tahun'];
                $pemasukan = mysqli_query($koneksi, "SELECT SUM(transaksi_nominal) AS total_pemasukan FROM transaksi WHERE transaksi_jenis='Pemasukan' AND YEAR(transaksi_tanggal)='$thn'");
                $pem = mysqli_fetch_assoc($pemasukan);
                $total = $pem['total_pemasukan'];
                echo $total ? $total . "," : "0,";
            }
            ?>
            ]
        },
        {
            label: 'Pengeluaran',
            fillColor: "rgba(255, 51, 51, 0.8)",
            strokeColor: "rgba(248, 5, 5, 0.8)",
            highlightFill: "rgba(151,187,205,0.75)",
            highlightStroke: "rgba(254, 29, 29, 0)",
            data: [
            <?php
            $tahun = mysqli_query($koneksi, "SELECT DISTINCT YEAR(transaksi_tanggal) AS tahun FROM transaksi ORDER BY YEAR(transaksi_tanggal) ASC");
            while($t = mysqli_fetch_array($tahun)) {
                $thn = $t['tahun'];
                $pemasukan = mysqli_query($koneksi, "SELECT SUM(transaksi_nominal) AS total_pengeluaran FROM transaksi WHERE transaksi_jenis='Pengeluaran' AND YEAR(transaksi_tanggal)='$thn'");
                $pem = mysqli_fetch_assoc($pemasukan);
                $total = $pem['total_pengeluaran'];
                echo $total ? $total . "," : "0,";
            }
            ?>
            ]
        }
        ]
    };

    window.onload = function() {
        var ctx1 = document.getElementById("grafik1").getContext("2d");
        window.myBar = new Chart(ctx1).Bar(barChartData, {
            responsive: true,
            animation: true,
            barValueSpacing: 5,
            barDatasetSpacing: 1,
            tooltipFillColor: "rgba(0,0,0,0.8)",
            multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
        });

        var ctx2 = document.getElementById("grafik2").getContext("2d");
        window.myBar = new Chart(ctx2).Bar(barChartData2, {
            responsive: true,
            animation: true,
            barValueSpacing: 5,
            barDatasetSpacing: 1,
            tooltipFillColor: "rgba(0,0,0,0.8)",
            multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
        });
    };
</script>

</body>
</html>