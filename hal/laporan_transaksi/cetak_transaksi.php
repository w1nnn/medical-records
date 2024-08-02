<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
    exit;
} else {
    include "../../koneksi/koneksi.php";
?>
    <style>
        body {
            visibility: hidden;
        }

        .card-body {
            visibility: visible;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .header img {
            margin: 0 50px;
        }

        .header h3 {
            margin: 0;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        .company-info {
            text-align: center;
            margin: 10px 0;
            font-size: 14px;
            color: #666;
        }

        .company-info .address {
            margin: 5px 0;
        }

        hr {
            border: 1px solid #e0e0e0;
            margin: 20px 0;
        }
    </style>
    <div class="card-body p-0">
        <div class="header">
            <img src="../assets/img/logo.png" alt="logo" class="img-fluid" width="100" height="100">
            <h3 class="text-center mb-4">Laporan Transaksi</h3>
            <img src="../assets/img/toraja.png" alt="logo" class="img-fluid" width="80" height="100">
        </div>
        <div class="company-info">
            <p>Nama Perusahaan</p>
            <p class="address">Alamat: Kondodewata, Mappak, Kabupaten Tana Toraja, Sulawesi Selatan</p>
            <p>Kode Pos: 91873</p>
        </div>
        <hr>
        <?php
        if (isset($_POST['tahun'])) {
            $tahun = $_POST['tahun'];

            $stmt = $conn->prepare("SELECT * FROM tb_kwitansi WHERE YEAR(STR_TO_DATE(tanggal, '%Y-%m-%d %H:%i:%s')) = ?");
            $stmt->bind_param('s', $tahun);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo '<table class="table table-hover table-striped">';
                echo '<thead class="table-light">';
                echo '<tr>';
                echo '<th class="text-center"><i class="fas fa-th"></i></th>';
                echo '<th>Kode Pasien</th>';
                echo '<th>Nama Pasien</th>';
                echo '<th>No Rekam Medis</th>';
                echo '<th>Order Id</th>';
                echo '<th>Bayar</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $no++ . '</td>';
                    echo '<td>' . $row['kode_pasien'] . '</td>';
                    echo '<td>' . $row['nama_pasien'] . '</td>';
                    echo '<td>' . $row['no_rekam_medis'] . '</td>';
                    echo '<td>' . $row['order_id'] . '</td>';
                    echo '<td>' . $row['harga'] . '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            }
        }
        if (isset($_POST['bulan'])) {
            $bulan = $_POST['bulan'];
            $bulang = date('m', strtotime($bulan));

            $stmt = $conn->prepare("SELECT * FROM tb_kwitansi WHERE MONTH(STR_TO_DATE(tanggal, '%Y-%m-%d %H:%i:%s')) = ?");
            $stmt->bind_param('s', $bulang);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo '<table class="table table-hover table-striped">';
                echo '<thead class="table-light">';
                echo '<tr>';
                echo '<th class="text-center"><i class="fas fa-th"></i></th>';
                echo '<th>Kode Pasien</th>';
                echo '<th>Nama Pasien</th>';
                echo '<th>No Rekam Medis</th>';
                echo '<th>Order Id</th>';
                echo '<th>Bayar</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $no++ . '</td>';
                    echo '<td>' . $row['kode_pasien'] . '</td>';
                    echo '<td>' . $row['nama_pasien'] . '</td>';
                    echo '<td>' . $row['no_rekam_medis'] . '</td>';
                    echo '<td>' . $row['order_id'] . '</td>';
                    echo '<td>' . $row['harga'] . '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            }
        }
        if (isset($_POST['tanggal'])) {
            $tanggal = $_POST['tanggal'];
            $tanggall = date('d', strtotime($tanggal));

            $stmt = $conn->prepare("SELECT * FROM tb_kwitansi WHERE DAY(STR_TO_DATE(tanggal, '%Y-%m-%d %H:%i:%s')) = ?");
            $stmt->bind_param('s', $tanggall);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo '<table class="table table-hover table-striped">';
                echo '<thead class="table-light">';
                echo '<tr>';
                echo '<th class="text-center"><i class="fas fa-th"></i></th>';
                echo '<th>Kode Pasien</th>';
                echo '<th>Nama Pasien</th>';
                echo '<th>No Rekam Medis</th>';
                echo '<th>Order Id</th>';
                echo '<th>Bayar</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $no++ . '</td>';
                    echo '<td>' . $row['kode_pasien'] . '</td>';
                    echo '<td>' . $row['nama_pasien'] . '</td>';
                    echo '<td>' . $row['no_rekam_medis'] . '</td>';
                    echo '<td>' . $row['order_id'] . '</td>';
                    echo '<td>' . $row['harga'] . '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            }
        }
        ?>
    </div>
    <script>
        window.print();
        window.onafterprint = function() {
            window.location.href = "?page=laporan-kunjungan";
        }
    </script>
<?php
}
?>