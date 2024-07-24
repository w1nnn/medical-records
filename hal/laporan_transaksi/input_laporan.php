<?php
// if (isset($_POST['tahun'])) {
//     $tahun = $_POST['tahun'];

//     $stmt = $conn->prepare("SELECT * FROM tb_kwitansi WHERE YEAR(STR_TO_DATE(tanggal, '%Y-%m-%d %H:%i:%s')) = ?");
//     $stmt->bind_param('s', $tahun);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     $dataKunjungan = $result->fetch_all(MYSQLI_ASSOC);

//     if (!empty($dataKunjungan)) {
//         foreach ($dataKunjungan as $row) {
//             var_dump($row);
//         }
//     }
// }
// if (isset($_POST['bulan'])) {
//     $bulan = $_POST['bulan'];
//     $bulang = date('m', strtotime($bulan));

//     $stmt = $conn->prepare("SELECT * FROM tb_kwitansi WHERE MONTH(STR_TO_DATE(tanggal, '%Y-%m-%d %H:%i:%s')) = ?");
//     $stmt->bind_param('s', $bulang);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     $dataKunjungan = $result->fetch_all(MYSQLI_ASSOC);

//     if (!empty($dataKunjungan)) {
//         foreach ($dataKunjungan as $row) {
//             var_dump($row);
//         }
//     }
// }
// if (isset($_POST['tanggal'])) {
//     $tanggal = $_POST['tanggal'];
//     $tanggall = date('d', strtotime($tanggal));
//     $stmt = $conn->prepare("SELECT * FROM tb_kwitansi WHERE DAY(STR_TO_DATE(tanggal, '%Y-%m-%d %H:%i:%s')) = ?");
//     $stmt->bind_param('s', $tanggall);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     $dataKunjungan = $result->fetch_all(MYSQLI_ASSOC);

//     if (!empty($dataKunjungan)) {
//         foreach ($dataKunjungan as $row) {
//             var_dump($row);
//         }
//     }
// }
?>
<form action="?page=laporan-transaksi&act=cetak" method="POST">
    <div class="card">
        <div class="card-body">
            <div class="alert" style="background-color: #8BC6EC;background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
                <b>Perhatian!</b> Pilih jenis data yang akan ditampilkan.
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Laporan Tahunan</label>
                        <select class="form-control" name="tahun">
                            <?php
                            $currentYear = date('Y');
                            $years = range(2001, $currentYear);
                            $years = array_reverse($years);
                            ?>
                            <option>Select Year</option>
                            <?php foreach ($years as $year) : ?>
                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Laporan Bulanan</label>
                        <input type="month" name="bulan" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label>Laporan /Tanggal</label>
                        <input type="date" name="tanggal" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Cetak</button>
        </div>
    </div>
</form>