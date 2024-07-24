<script type="text/javascript" async src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-c6-7tSgr5kcejdNu"></script>

<?php
include "../../koneksi/koneksi.php";

$noResep = $_GET['no_resep'];
$kodePasien = $_GET['kode_pasien'];



$queryPasien = "SELECT * FROM tb_pasien WHERE kode_pasien = '$kodePasien'";
$dataPasien = mysqli_query($conn, $queryPasien);

if (!$dataPasien) {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    exit;
}

$pasien = mysqli_fetch_assoc($dataPasien);
$name = $pasien['nama_pasien'];
$phone = $pasien['telpon'];
$email = $pasien['email'];


$resepArray = explode(",", $noResep);
$items = [];

foreach ($resepArray as $resep) {
    $dt = trim($resep);
    $query = "SELECT * FROM tb_resep_detail WHERE no_resep = '$dt'";
    $data = mysqli_query($conn, $query);

    if (!$data) {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
        continue;
    }

    while ($row = mysqli_fetch_assoc($data)) {
        $id = $row['kode_obat'];

        $queryObat = "SELECT * FROM tb_obat WHERE kfa = '$id'";
        $dataObat = mysqli_query($conn, $queryObat);

        if (!$dataObat) {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
            continue;
        }

        while ($obat = mysqli_fetch_assoc($dataObat)) {
            $id = $obat['kfa'];
            $price = $obat['harga'];
            $quantity = $row['jumlah'];
            $item = $obat['nama_produk'];
            $stok = intval($obat['stok']);
            $sisaStok = $stok - $quantity;
            $totalHarga = $price * $quantity;


            $items[] = [
                'id' => $id,
                'price' => $price,
                'quantity' => $quantity,
                'item' => $item,
                'sisaStok' => $sisaStok,
                'totalHarga' => $totalHarga
            ];
        }
    }
}
?>
<?php
$hargaTot = 0;
$idObat = [];
$stokUpdate = [];
foreach ($items as $item) {
    $idObat[] = $item['id'];
    $stokUpdate[] = $item['sisaStok'];
    $hargaTot += $item['totalHarga'];
}
?>
<?php
// var_dump($stokUpdate);
// var_dump($idObat)
?>

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .invoice-print,
        .invoice-print * {
            visibility: visible;
        }

        .invoice-print {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .invoice {
            background-color: white;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .btn,
        .float-lg-left {
            display: none !important;
        }
    }
</style>
<form action="" method="POST">
    <div class="form-group">
        <input type="hidden" class="form-control" id="name" value="<?= htmlspecialchars($name) ?>" readonly>
    </div>

    <div class="form-group">
        <input type="hidden" class="form-control" id="phone" value="<?= htmlspecialchars($phone) ?>" readonly>
    </div>

    <div class="form-group">
        <input type="hidden" class="form-control" id="email" value="<?= htmlspecialchars($email) ?>" readonly>
    </div>



    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h2>
                            <img src="../assets/img/logo.png" style="width: 50px;" alt="Gambar.png">
                            Puskesmas Kondodewata
                        </h2>
                        <p style="margin-top: -30px; margin-left: 60px; font-style: italic; font-weight: bold;">Tana Toraja</p>
                        <?php if ($order_id != '-') : ?>
                            <div id="order_id" class="invoice-number"></div>
                        <?php endif; ?>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <address>
                                <strong>Tagihan Kepada:</strong><br>
                                <?= htmlspecialchars($name) ?><br>
                                <?= htmlspecialchars($phone) ?><br>
                                <?= htmlspecialchars($email) ?><br>
                            </address>
                        </div>
                    </div>
                    <?php if ($order_id != '-') : ?>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>No Kartu:</strong><br>
                                    <p id="pay-method"><?= $_GET['no_kartu']; ?></p><br>
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Tanggal Pembayaran:</strong><br>
                                    <p id="order-date">
                                        <!-- tanggal sekaran -->
                                        <?= date('d F Y') ?>
                                    </p><br><br>
                                </address>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="section-title">Rincian Pesanan</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-md">
                            <tr>
                                <th data-width="40">#</th>
                                <th>Item</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-right">Totals</th>
                            </tr>
                            <?php
                            $no = 1;
                            $total = 0;
                            foreach ($items as $item) :
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            ?>
                                <tr>
                                    <td data-width="40"><?= $no++ ?></td>
                                    <td><?= $item['item'] ?></td>
                                    <td class="text-center">Rp. <?= number_format($item['price'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?= $item['quantity'] ?></td>
                                    <td class="text-right">Rp. <?= number_format($subtotal, 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-8">
                            <!-- <div class="section-title">Jenis Metode Pemabayaran</div> -->
                            <div class="d-flex">
                                <img style="margin-left: 5px; margin-top: -3px;" src="../assets/img/bpjs.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <hr class="mt-2 mb-2">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Total</div>
                                <div class="invoice-detail-value invoice-detail-value-lg">Rp. <?= number_format($total, 0, ',', '.') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="text-md-right">
            <div class="float-lg-left mb-lg-0 mb-3">
                <?php
                $cek = mysqli_query($conn, "SELECT * FROM bpjs WHERE kode_pasien = '$kodePasien'");
                $cekData = mysqli_fetch_assoc($cek);
                if ($cekData['tanggal'] == '-') {
                    echo "<button type='submit' id='pay' class='btn btn-primary btn-icon icon-left'><i class='fas fa-credit-card'></i> Konfirmasi</button>";
                }
                // <button type="submit" id="pay" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Konfirmasi</button>
                ?>
                <a href="?page=bpjs" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</a>
            </div>
            <?php if ($order_id != '-') : ?>
                <button id="print" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
            <?php endif; ?>
        </div>
    </div>
</form>
<script>
    document.querySelector('#pay').addEventListener('click', async (e) => {
        e.preventDefault();

        const stokUpdate = <?= json_encode($stokUpdate) ?>;
        const kodePasien = <?= json_encode($kodePasien) ?>;
        const totalBayar = <?= json_encode($hargaTot) ?>;

        const data = {
            kodePasien,
            totalBayar,
            stokUpdate
        };

        try {
            const response = await fetch('../hal/bpjs/update_stok.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    kode_pasien: data.kodePasien,
                    total_bayar: data.totalBayar,
                    stok_update: data.stokUpdate,
                    id_obat: <?= json_encode($idObat) ?>
                })
            });

            const result = await response.json();

            if (result.status === 'success') {
                alert('Data berhasil disimpan');
                window.location.href = '?page=bpjs';
            } else {
                alert('Gagal menyimpan data');
            }
        } catch (error) {
            console.error(error);
            alert('Data berhasil disimpan');
            window.location.href = '?page=bpjs';
        }
    });
    document.querySelector('#print').addEventListener('click', () => {
        window.print();
    });
</script>