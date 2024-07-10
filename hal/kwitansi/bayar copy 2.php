<script type="text/javascript" async src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-c6-7tSgr5kcejdNu"></script>

<?php

include "../../koneksi/koneksi.php";

$noResep = $_POST['no_resep'];
$kodePasien = $_POST['kode_pasien'];
$id_kwitansi = $_POST['id_kwitansi'];
$order_id = $_POST['order_id'];
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

        $queryObat = "SELECT * FROM tb_obat WHERE kode_obat = '$id'";
        $dataObat = mysqli_query($conn, $queryObat);

        if (!$dataObat) {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
            continue;
        }

        while ($obat = mysqli_fetch_assoc($dataObat)) {
            $id = $obat['kode_obat'];
            $price = $obat['harga'];
            $quantity = $row['jumlah'];
            $item = $obat['nama_obat'];

            $items[] = [
                'id' => $id,
                'price' => $price,
                'quantity' => $quantity,
                'item' => $item
            ];
        }
    }
}
?>
<input type="hidden" value="<?= $order_id; ?>">
<form id="payment-form">
    <div class="form-group">
        <label for="name">Nama Pasien</label>
        <input type="text" class="form-control" id="name" value="<?= htmlspecialchars($name) ?>" readonly>
    </div>

    <div class="form-group">
        <label for="phone">Nomor Telepon</label>
        <input type="text" class="form-control" id="phone" value="<?= htmlspecialchars($phone) ?>" readonly>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" value="<?= htmlspecialchars($email) ?>" readonly>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total = 0;
            foreach ($items as $item) :
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item['item'] ?></td>
                    <td>Rp. <?= number_format($item['price'], 0, ',', '.') ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>Rp. <?= number_format($subtotal, 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4" align="right">Total</td>
                <td>Rp. <?= number_format($total, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
    <?php foreach ($items as $item) : ?>
        <input type="hidden" name="items[]" value="<?= htmlspecialchars(json_encode($item)); ?>">
    <?php endforeach; ?>
    <?php if ($order_id == '-') : ?>
        <button type="submit" id="pay" class="btn btn-primary btn-sm" style="width: 100%;">Konfirmasi Transaksi</button>
    <?php endif; ?>
</form>
<?php if ($order_id != '-') : ?>
    <div class="card-body p-0 mt-4">
        <div class="table-responsive">
            <table class="table table-striped" id="midtransTable">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Jenis Pembayaran</th>
                        <th>Jumlah Bayar</th>
                        <th>Status Transaksi</th>
                        <th>Waktu Bayar</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody id="midtransTableBody">
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
<div class="invoice">
    <div class="invoice-print">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-title">
                    <h2>Invoice</h2>
                    <div class="invoice-number">Order #12345</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Billed To:</strong><br>
                            Ujang Maman<br>
                            1234 Main<br>
                            Apt. 4B<br>
                            Bogor Barat, Indonesia
                        </address>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <address>
                            <strong>Shipped To:</strong><br>
                            Muhamad Nauval Azhar<br>
                            1234 Main<br>
                            Apt. 4B<br>
                            Bogor Barat, Indonesia
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Payment Method:</strong><br>
                            Visa ending **** 4242<br>
                            ujang@maman.com
                        </address>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <address>
                            <strong>Order Date:</strong><br>
                            September 19, 2018<br><br>
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="section-title">Order Summary</div>
                <p class="section-lead">All items here cannot be deleted.</p>
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
                        <div class="section-title">Payment Method</div>
                        <p class="section-lead">The payment method that we provide is to make it easier for you to pay invoices.</p>
                        <div class="d-flex">
                            <div class="mr-2 bg-visa" data-width="61" data-height="38"></div>
                            <div class="mr-2 bg-jcb" data-width="61" data-height="38"></div>
                            <div class="mr-2 bg-mastercard" data-width="61" data-height="38"></div>
                            <div class="bg-paypal" data-width="61" data-height="38"></div>
                            <div class="bg-mandiri" data-width="72" data-height="38"></div>

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
            <button type="submit" id="pay" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
            <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
        </div>
        <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
    </div>
</div>

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
                                        id_kwitansi: <?= json_encode($id_kwitansi); ?>
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
                                        id_kwitansi: <?= json_encode($id_kwitansi); ?>
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
    const getTransactionStatus = async function(orderId) {
        try {
            const response = await fetch(`../hal/kwitansi/history.php?order_id=${orderId}`);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            console.log("Transaction status:", data);
            let tableBody = document.getElementById('midtransTableBody');
            let newRow = document.createElement('tr');
            console.log(data);
            newRow.innerHTML = `
                    <td>${data.order_id}</td>
                    <td>${data.payment_type}</td>
                    <td>${data.gross_amount}</td>
                    <td>${data.transaction_status}</td>
                    <td>${data.transaction_time}</td>
                    <td>${data.settlement_time}</td>
                `;
            tableBody.appendChild(newRow);
        } catch (error) {
            console.error("Fetch error:", error);
        }
    };
    getTransactionStatus(idOrder)
</script>