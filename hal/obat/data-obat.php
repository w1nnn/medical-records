<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
	exit; // Exiting to prevent further execution
} else {

	include "../../koneksi/koneksi.php";
	$result = mysqli_query($conn, "SELECT * FROM tb_obat ORDER BY kode_obat ASC");
?>

	<div class="card-body p-0">
		<div class="table-responsive">
			<a href="?page=obat&act=tambah" class="btn btn-sm btn-primary mb-2" style="margin-right: 500px;">Add Data</a>
			<table class="table table-striped" id="table-2">
				<thead class="table-light">
					<tr>
						<th class="text-center">
							<i class="fas fa-th"></i>
						</th>
						<th>Kode Obat</th>
						<th>Nama Obat</th>
						<th>Jenis</th>
						<th>Satuan</th>
						<th>Jumlah</th>
						<th>Harga</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php while ($data = mysqli_fetch_array($result)) : ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['kode_obat']; ?></td>
							<td><?php echo $data['nama_obat']; ?></td>
							<td><?php echo $data['jenis']; ?></td>
							<td><?php echo $data['satuan']; ?></td>
							<td><?php echo $data['jumlah']; ?></td>
							<td><?php echo $data['harga']; ?></td>
							<td>
								<a href="edit-data.php?kode_obat=<?= $data['kode_obat']; ?>" class="btn btn-sm bg-info">Edit</a>
								<a href="proses-hapus.php?kode_obat=<?= $data['kode_obat']; ?>" class="btn btn-sm bg-danger">Delete</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>

<?php
}
?>