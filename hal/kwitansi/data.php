<script type="text/javascript" async src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-c6-7tSgr5kcejdNu"></script>
<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
	exit; // Exiting to prevent further execution
} else {

	include "../../koneksi/koneksi.php";
	$result = mysqli_query($conn, "SELECT * FROM tb_kwitansi");
?>

	<div class="card-body p-0">
		<div class="table-responsive">
			<a href="?page=transaksi&act=add" class="btn btn-sm btn-primary mb-2" style="margin-right: 500px;">Add Data</a>
			<table class="table table-striped" id="table-2">
				<thead class="table-light">
					<tr>
						<th class="text-center">
							<i class="fas fa-th"></i>
						</th>
						<th>Kode Pasien</th>
						<th>Nama_Pasien</th>
						<th>No. Telepon</th>
						<th>Email</th>
						<th>No RM</th>
						<th>Diagnosa</th>
						<th>Keterangan</th>
						<th>No Resep</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php while ($data = mysqli_fetch_array($result)) : ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['kode_pasien']; ?></td>
							<td><?php echo $data['nama_pasien']; ?></td>
							<td><?php echo $data['telepon']; ?></td>
							<td><?php echo $data['email']; ?></td>
							<td><?php echo $data['no_rekam_medis']; ?></td>
							<td><?php echo $data['diagnosa']; ?></td>
							<td><?php echo $data['keterangan']; ?></td>
							<td><?php echo $data['no_resep']; ?></td>
							<td>
								<a href="edit-data.php?no_kwitansi=<?= $data['no_kwitansi']; ?>" class="btn btn-sm bg-info">Edit</a>
								<a onclick="return confirm('Yakin Hapus Data ??')" href="?page=transaksi&act=del&no_kwitansi=<?= $data['no_kwitansi']; ?>" class="btn btn-sm bg-danger">Delete</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>

	<div style="width: 100%" id="snap-container"></div>
	<form id="payment-form">
		<div class="form-group">
			<label for="id">ID</label>
			<input type="text" class="form-control" id="id" name="id" required />
		</div>
		<div class="form-group">
			<label for="price">Price</label>
			<input type="number" class="form-control" id="price" name="price" required />
		</div>
		<div class="form-group">
			<label for="quantity">Quantity</label>
			<input type="number" class="form-control" id="quantity" name="quantity" required />
		</div>
		<div class="form-group">
			<label for="item">Item</label>
			<input type="text" class="form-control" id="item" name="item" required />
		</div>
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" required />
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" class="form-control" id="email" name="email" required />
		</div>
		<div class="form-group">
			<label for="phone">Phone</label>
			<input type="tel" class="form-control" id="phone" name="phone" required />
		</div>
		<button type="submit" id="pay" class="btn btn-primary">Pay</button>
	</form>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const form = document.getElementById("payment-form");

			form.addEventListener("submit", async function(e) {
				e.preventDefault();
				console.log("Form submitted");

				const formData = new FormData(form);
				const data = Object.fromEntries(formData.entries());
				console.log("Form data:", data);

				try {
					const response = await fetch("../hal/kwitansi/req.php", {
						method: "POST",
						headers: {
							"Content-Type": "application/json",
						},
						body: JSON.stringify(data),
					});

					const responseText = await response.text();
					console.log("Raw response:", responseText);

					if (!response.ok) {
						throw new Error(`HTTP error! status: ${response.status}`);
					}

					const result = JSON.parse(responseText);
					console.log("Server response:", result);

					if (result.status === "success" && result.token) {
						window.snap.pay(result.token)
					} else {
						console.error("Error:", result.message);
					}
				} catch (error) {
					console.error("Fetch error:", error);
				}
			});
		});
	</script>



<?php
}
?>