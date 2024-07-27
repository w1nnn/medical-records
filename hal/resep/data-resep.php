<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
	exit; // Exiting to prevent further execution
} else {

	include "../../koneksi/koneksi.php";
	$result = mysqli_query($conn, "SELECT * FROM tb_resep ORDER BY no_resep ASC");
?>

	<div class="card-body p-0">
		<div class="table-responsive">
			<a href="?page=resep-dokter&act=add" class="btn btn-sm btn-primary mb-2" style="margin-right: 500px;">Add Data</a>
			<table class="table table-hover table-striped" id="table-2">
				<thead class="table-light">
					<tr>
						<th class="text-center">
							<i class="fas fa-th"></i>
						</th>
						<th style="width:130px">No. Resep</th>
						<th style="width:130px">No. Rekam Medis</th>
						<th style="width:130px">Tgl. Resep</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php while ($data = mysqli_fetch_array($result)) : ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['no_resep']; ?></td>
							<td><?php echo $data['no_rekmed']; ?></td>
							<td><?php echo $data['tanggal']; ?></td>
							<td>
								<!-- <a href="edit-data.php?no_resep=<?= $data['no_resep']; ?>" class="btn btn-sm bg-info">Edit</a> -->
								<a href="?page=resep-dokter&act=hapus&no_resep=<?= $data['no_resep']; ?>" class="btn btn-sm bg-danger">Delete</a>
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