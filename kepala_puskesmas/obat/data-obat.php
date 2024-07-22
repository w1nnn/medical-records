<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
	exit; // Exiting to prevent further execution
} else {

	include "../../koneksi/koneksi.php";
	$result = mysqli_query($conn, "SELECT * FROM tb_obat ");
?>

	<div class="card-body p-0">
		<div class="table-responsive">
			<a href="?page=obat&act=tambah" class="btn btn-sm btn-primary mb-2" style="margin-right: 500px;">Add Data</a>
			<table class="table table-hover table-striped" id="table-2">
				<thead class="table-light">
					<tr>
						<th class="text-center">
							<i class="fas fa-th"></i>
						</th>
						<th>Nama Produk</th>
						<th>Detail Produk</th>
						<th>Bentuk</th>
						<th>Zat Aktif</th>
						<th>NIE</th>
						<th>Kode KFA</th>
						<th>Manufaktur</th>
						<th>Harga</th>
						<th>Stok</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php while ($data = mysqli_fetch_array($result)) : ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $data['nama_produk']; ?></td>
							<td><?= $data['detail_produk']; ?></td>
							<td><?= $data['bentuk']; ?></td>
							<td><?= $data['zat_aktif']; ?></td>
							<td><?= $data['nie']; ?></td>
							<td><?= $data['kfa']; ?></td>
							<td><?= $data['manufaktur']; ?></td>
							<td><?= $data['harga']; ?></td>
							<td><?= $data['stok']; ?></td>
							<td>
								<a href="?page=obat&act=edit&kfa=<?= $data['kfa']; ?>" class="btn btn-sm bg-info">Edit</a>
								<a href="?page=obat&act=del&kfa=<?= $data['kfa']; ?>" class="btn btn-sm bg-danger">Delete</a>
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