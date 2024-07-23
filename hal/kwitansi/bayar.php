<script type="text/javascript" async src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-c6-7tSgr5kcejdNu"></script>

<?php
include "../../koneksi/koneksi.php";

$noResep = $_POST['no_resep'];
$kodePasien = $_POST['kode_pasien'];
$id_kwitansi = $_POST['id_kwitansi'];
$order_id = $_POST['order_id'];
if ($order_id == null) {
    echo "<script>window.location.href='?page=transaksi';</script>";
}
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

<input type="hidden" value="<?= $order_id; ?>">
<form id="payment-form" action="" method="POST">
    <div class="form-group">
        <input type="hidden" class="form-control" id="name" value="<?= htmlspecialchars($name) ?>" readonly>
    </div>

    <div class="form-group">
        <input type="hidden" class="form-control" id="phone" value="<?= htmlspecialchars($phone) ?>" readonly>
    </div>

    <div class="form-group">
        <input type="hidden" class="form-control" id="email" value="<?= htmlspecialchars($email) ?>" readonly>
    </div>
    <!-- <input type="text" name="ordr_id">
    <input type="text" name="status_byr"> -->


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
                                    <strong>Metode Pembayaran:</strong><br>
                                    <p id="pay-method"></p><br>
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Tanggal Pembayaran:</strong><br>
                                    <p id="order-date"></p><br><br>
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
                                <!-- <div class="mr-2 bg-visa" data-width="61" data-height="38"></div>
                                <div class="mr-2 bg-jcb" data-width="61" data-height="38"></div>
                                <div class="mr-2 bg-mastercard" data-width="61" data-height="38"></div>
                                <div class="bg-paypal" data-width="61" data-height="38"></div>
                                <img style="margin-left: 5px; margin-top: -3px;" src="../assets/img/bpjs.png" alt=""> -->
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
                <?php if ($order_id == '-') : ?>
                    <button type="submit" id="pay" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
                <?php endif; ?>
                <a href="?page=transaksi" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</a>
            </div>
            <?php if ($order_id != '-') : ?>
                <button id="print" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
            <?php endif; ?>
        </div>
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("payment-form");

        form.addEventListener("submit", async function(e) {
            e.preventDefault();

            const formData = new FormData(form);
            const data = {
                name: document.getElementById("name").value,
                phone: document.getElementById("phone").value,
                email: document.getElementById("email").value,
                items: <?php echo json_encode($items); ?>
            };

            console.log("Form data:", data);

            const jsonData = JSON.stringify(data);
            console.log("JSON data being sent:", jsonData);

            try {
                const response = await fetch("../hal/kwitansi/req.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: jsonData,
                });

                const responseText = await response.text();
                console.log("Raw response:", responseText);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const result = JSON.parse(responseText);
                console.log("Server response:", result);

                if (result.status === "success" && result.token) {
                    window.snap.pay(result.token, {
                        language: "id",
                        onSuccess: async function(result) {
                            console.log("Success:", result);

                            try {
                                const saveResponse = await fetch("../hal/kwitansi/order.php", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                    },
                                    body: JSON.stringify({
                                        order_id: result.order_id,
                                        tanggal: result.transaction_time,
                                        id_obat: <?= json_encode($idObat); ?>,
                                        harga: <?= json_encode($hargaTot); ?>,
                                        stok: <?= json_encode($stokUpdate); ?>,
                                        id_kwitansi: <?= json_encode($id_kwitansi); ?>,
                                        status: result.transaction_status === "settlement" ? "Lunas" : "Belum Lunas"
                                    })
                                });

                                if (!saveResponse.ok) {
                                    throw new Error(`HTTP error! status: ${saveResponse.status}`);
                                }

                                const saveResult = await saveResponse.json();
                                console.log("Save order_id response:", saveResult);

                                if (saveResult.status === "success") {
                                    window.location.href = "?page=transaksi";
                                } else {
                                    console.error("Error saving order_id:", saveResult.message);
                                }
                            } catch (error) {
                                console.error("Save order_id fetch error:", error);
                            }
                        },
                        onPending: async function(result) {
                            console.log("Pending:", result);

                            try {
                                const saveResponse = await fetch("../hal/kwitansi/order.php", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                    },
                                    body: JSON.stringify({
                                        order_id: result.order_id,
                                        tanggal: result.transaction_time,
                                        id_obat: <?= json_encode($idObat); ?>,
                                        harga: <?= json_encode($hargaTot); ?>,
                                        stok: <?= json_encode($stokUpdate); ?>,
                                        id_kwitansi: <?= json_encode($id_kwitansi); ?>,
                                        status: result.transaction_status === "settlement" ? "Lunas" : "Belum Lunas"
                                    })
                                });

                                if (!saveResponse.ok) {
                                    throw new Error(`HTTP error! status: ${saveResponse.status}`);
                                }

                                const saveResult = await saveResponse.json();
                                console.log("Save order_id response:", saveResult);

                                if (saveResult.status === "success") {
                                    window.location.href = "?page=transaksi";
                                } else {
                                    console.error("Error saving order_id:", saveResult.message);
                                }
                            } catch (error) {
                                console.error("Save order_id fetch error:", error);
                            }
                        },
                    });
                } else {
                    console.error("Error:", result.message);
                }
            } catch (error) {
                console.error("Fetch error:", error);
            }
        });
    });
    const idOrder = document.querySelector("input[type=hidden]").value;
    async function updateStatusBayar(order_id, status) {
        console.log('Updating status bayar:', {
            order_id,
            status
        });

        try {
            const response = await fetch("../hal/kwitansi/status_bayar.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    order_id: order_id,
                    status_bayar: status
                }),
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            console.log("Update status bayar response:", result);
        } catch (error) {
            console.error("Fetch error:", error);
        }
    }
    const getTransactionStatus = async function(orderId) {
        try {
            const response = await fetch(`../hal/kwitansi/history.php?order_id=${orderId}`);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            console.log("Transaction status:", data);
            const statusTransaksi = data.transaction_status == 'settlement' ? 'Lunas' : 'Belum Lunas';
            document.querySelector('#order_id').innerHTML = data.order_id;
            document.querySelector('#order-date').innerHTML = data.transaction_time;
            document.querySelector('#pay-method').innerHTML = `${data.payment_type} <b>${statusTransaksi}</b>`;
            await updateStatusBayar(data.order_id, statusTransaksi);
            const printElement = document.querySelector('#print');
            printElement.addEventListener('click', function(e) {
                window.print();
                e.preventDefault();
            });
        } catch (error) {
            console.error("Fetch error:", error);
        }
    };

    getTransactionStatus(idOrder);

    // window.print();
</script>