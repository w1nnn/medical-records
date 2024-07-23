<?php
include "../koneksi/koneksi.php";
// Obat
$dataObat = mysqli_query($conn, "SELECT * FROM tb_obat");
$jumlahObat = mysqli_num_rows($dataObat);
// Rekam Medis
$dataRekamMedis = mysqli_query($conn, "SELECT * FROM tb_rekmed");
$jumlahRekamMedis = mysqli_num_rows($dataRekamMedis);
// pasien
$dataPasien = mysqli_query($conn, "SELECT * FROM tb_pasien");
$jumlahPasien = mysqli_num_rows($dataPasien);
// unit medis
$dataUnitMedis = mysqli_query($conn, "SELECT * FROM tb_unitmedis");
$jumlahUnitMedis = mysqli_num_rows($dataUnitMedis);
// resep dokter
$dataResepDokter = mysqli_query($conn, "SELECT * FROM tb_resep");
$jumlahResepDokter = mysqli_num_rows($dataResepDokter);

// jumlah obat medis
$dataObatMedis = mysqli_query($conn, "SELECT * FROM tb_obat WHERE tipe_farmasi = 'medicine'");
$jumlahObatMedis = mysqli_num_rows($dataObatMedis);
// jumlah vaksin
$dataVaksin = mysqli_query($conn, "SELECT * FROM tb_obat WHERE tipe_farmasi = 'vaccine'");
$jumlahVaksin = mysqli_num_rows($dataVaksin);
// jumlah obat hrbal
$dataObatHerbal = mysqli_query($conn, "SELECT * FROM tb_obat WHERE tipe_farmasi = 'herbal'");
$jumlahObatHerbal = mysqli_num_rows($dataObatHerbal);
// jumlah obat suplemen
$dataObatSuplemen = mysqli_query($conn, "SELECT * FROM tb_obat WHERE tipe_farmasi = 'supplement'");
$jumlahObatSuplemen = mysqli_num_rows($dataObatSuplemen);

// Total Transaksi
$dataTransaksi = mysqli_query($conn, "SELECT * FROM tb_kwitansi WHERE sts ='Lunas'");
$dataBelumLunas = mysqli_query($conn, "SELECT * FROM tb_kwitansi WHERE sts ='Belum Lunas'");

// data pasien jenis layanan bpjs
$dataPasienBPJS = mysqli_query($conn, "SELECT * FROM tb_kunjungan WHERE jenis_layanan = 'bpjs'");
$jumlahPasienBPJS = mysqli_num_rows($dataPasienBPJS);
// data pasien jenis layanan umum
$dataPasienUmum = mysqli_query($conn, "SELECT * FROM tb_kunjungan WHERE jenis_layanan = 'umum'");
$jumlahPasienUmum = mysqli_num_rows($dataPasienUmum);

// fungsi format rupiah
function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-stats">
                <div class="card-stats-title">Data Master
                    <div class="dropdown d-inline">

                    </div>
                </div>
                <div class="card-stats-items">
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">
                            <?= $jumlahUnitMedis; ?>
                        </div>
                        <div class="card-stats-item-label">Unit Medis</div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">
                            <?= $jumlahResepDokter; ?>
                        </div>
                        <div class="card-stats-item-label">Resep</div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">
                            <?= $jumlahPasien; ?>
                        </div>
                        <div class="card-stats-item-label">Pasien</div>
                    </div>
                </div>
            </div>
            <div class="card-icon shadow-primary" style="background-color: #8EC5FC; background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%); color: #fff;">
                <i class="bi bi-person-lines-fill"></i>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Jumlah Rekam Medis</h4>
                </div>
                <div class="card-body">
                    <?= $jumlahRekamMedis; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5 col-md-5 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-stats">
                <div class="card-stats-title">Data Obat
                    <div class="dropdown d-inline">

                    </div>
                </div>
                <div class="card-stats-items">
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">
                            <?= $jumlahObatMedis; ?>
                        </div>
                        <div class="card-stats-item-label">Obat Umum</div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">
                            <?= $jumlahVaksin; ?>
                        </div>
                        <div class="card-stats-item-label">Vaksin</div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">
                            <?= $jumlahObatSuplemen; ?>
                        </div>
                        <div class="card-stats-item-label">Suplement</div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">
                            <?= $jumlahObatHerbal; ?>
                        </div>
                        <div class="card-stats-item-label">Herbal</div>
                    </div>
                </div>
            </div>
            <div class="card-icon shadow-primary" style="background-color: #FAACA8; background-image: linear-gradient(19deg, #FAACA8 0%, #DDD6F3 100%);">
                <i class="bi bi-capsule" style="color: #fff;"></i>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Jumlah Obat</h4>
                </div>
                <div class="card-body">
                    <?= $jumlahObat; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-stats">
                <div class="card-stats-title">Jenis Layanan
                    <div class="dropdown d-inline">

                    </div>
                </div>
                <div class="card-stats-items">
                    <div class="card-stats-item" style="width: 150px;">
                        <div class="card-stats-item-count">
                            <?= $jumlahPasienUmum; ?>
                        </div>
                        <div class="card-stats-item-label">Umum</div>
                    </div>
                </div>
            </div>
            <div class="card-icon shadow-primary" style="background-color: #F4D03F; background-image: linear-gradient(132deg, #F4D03F 0%, #16A085 100%);">
                <i class="bi bi-person-check-fill" style="color: #fff;"></i>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>BPJS</h4>
                </div>
                <div class="card-body">
                    <?= $jumlahPasienBPJS; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Transaksi</h4>
                <div class="card-header-action">
                    <!-- <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a> -->
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                        <tr>
                            <th>No. Kwitansi</th>
                            <th>Nama Pasien</th>
                            <th>Status</th>
                            <th>Tanggal Transaksi</th>
                        </tr>
                        <?php
                        $dataKwitansi = mysqli_query($conn, "SELECT * FROM tb_kwitansi WHERE sts = 'Lunas'");
                        while ($kwitansi = mysqli_fetch_array($dataKwitansi)) : ?>
                            <tr>
                                <td><a href="#"><?= $kwitansi['order_id']; ?></a></td>
                                <td class="font-weight-600"><?= $kwitansi['nama_pasien']; ?></td>
                                <td>
                                    <?php
                                    if ($kwitansi['sts'] == 'Lunas') {
                                        echo '<div class="badge badge-success">Lunas</div>';
                                    } else {
                                        echo '<div class="badge badge-warning">Belum Lunas</div>';
                                    }
                                    ?>
                                </td>
                                <td><?= $kwitansi['tanggal']; ?></td>

                            </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-hero">
            <div class="card-header">
                <div class="card-icon">
                    <i class="far bi bi-currency-dollar"></i>
                </div>
                <h3> <?php
                        $totalBayar = 0;
                        while ($transaksi = mysqli_fetch_array($dataTransaksi)) {
                            $totalBayar += $transaksi['harga'];
                        }
                        echo rupiah($totalBayar);
                        ?></h3>
                <div class="card-description">Jumlah Transaksi</div>
            </div>
            <div class="card-body p-0">
                <div class="tickets-list">
                    <?php
                    $tagihan = mysqli_query($conn, "SELECT * FROM tb_kwitansi WHERE sts = 'Belum Lunas'");
                    ?>
                    <?php
                    while ($tagih = mysqli_fetch_array($tagihan)) : ?>
                        <a href="#" class="ticket-item">
                            <div class="ticket-title">
                                <h4>Tagihan</h4>
                            </div>
                            <div class="ticket-info">
                                <div><?= $tagih['nama_pasien']; ?></div>
                                <div class="bullet"></div>
                                <div class="text-primary"><?= $tagih['order_id']; ?></div>
                            </div>
                        </a>
                    <?php endwhile; ?>
                    <a href="#" class="ticket-item ticket-more">
                        View All <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>