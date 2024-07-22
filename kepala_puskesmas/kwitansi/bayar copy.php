<script type="text/javascript" async src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-c6-7tSgr5kcejdNu"></script>

<?php
if (!isset($_POST['no_resep']) || !isset($_POST['kode_pasien'])) {
    header("Location: ?page=transaksi");
}

include "../../koneksi/koneksi.php";

$noResep = $_POST['no_resep'];
$kodePasien = $_POST['kode_pasien'];

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

<form id="payment-form">
    <div class="form-group">
        <label>Jenis Layanan</label>
        <select class="form-control" name="kode_pasien" id="kode_pasien">
            <option>Choose</option>
            <option>Umum</option>
            <option>BPJS</option>
        </select>
    </div>
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

    <button type="submit" id="pay" class="btn btn-primary btn-sm" style="width: 100%;">Konfirmasi Transaksi</button>
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
                    window.snap.pay(result.token);
                } else {
                    console.error("Error:", result.message);
                }
            } catch (error) {
                console.error("Fetch error:", error);
            }
        });
    });
</script>