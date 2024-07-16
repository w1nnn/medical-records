<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
	exit;
} else {
	include "../../koneksi/koneksi.php";
	$result = mysqli_query($conn, "SELECT * FROM tb_kwitansi");
?>
	<div class="card-body p-0">
		<div class="table-responsive">
			<a href="?page=transaksi&act=add" class="btn btn-sm btn-primary mb-2" style="margin-right: 500px;">Add Data</a>
			<table class="table table-hover table-striped" id="table-2">
				<thead class="table-light">
					<tr>
						<th class="text-center">
							<i class="fas fa-th"></i>
						</th>
						<th>Kode Pasien</th>
						<th>No Rekam Medis</th>
						<th>Diagnosa</th>
						<th>No Resep</th>
						<th>Order ID</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php while ($data = mysqli_fetch_array($result)) : ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['kode_pasien']; ?></td>
							<td><?php echo $data['no_rekam_medis']; ?></td>
							<td><?php echo $data['diagnosa']; ?></td>
							<td><?php echo $data['no_resep']; ?></td>
							<td><?php echo $data['order_id']; ?></td>
							<td>
								<button class="btn btn-sm bg-primary text-white" onclick="submitForm('<?= $data['no_resep']; ?>', '<?= $data['kode_pasien']; ?>' , '<?= $data['id_kwitansi']; ?>', '<?= $data['order_id']; ?>')">Detail Transaksi</button>
								<a onclick="return confirm('Yakin Hapus Data ??')" href="?page=transaksi&act=del&id_kwitansi=<?= $data['id_kwitansi']; ?>" class="btn btn-sm bg-danger">Delete</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>



	<form id="detailForm" action="?page=transaksi&act=pay" method="POST" style="display: none;">
		<input type="hidden" name="no_resep" id="no_resep">
		<input type="hidden" name="kode_pasien" id="kode_pasien">
		<input type="hidden" name="id_kwitansi" id="id_kwitansi">
		<input type="hidden" name="order_id" id="order_id">
	</form>

	<script>
		function submitForm(noResep, kodePasien, idKwitansi, orderID) {
			document.getElementById('no_resep').value = noResep;
			document.getElementById('kode_pasien').value = kodePasien;
			document.getElementById('id_kwitansi').value = idKwitansi;
			document.getElementById('order_id').value = orderID;
			document.getElementById('detailForm').submit();
		}
	</script>

<?php
}
?>