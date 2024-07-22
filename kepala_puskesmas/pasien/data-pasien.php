<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
	exit; // Exiting to prevent further execution
} else {

	include "../../koneksi/koneksi.php";
	$result = mysqli_query($conn, "SELECT * FROM tb_pasien ORDER BY kode_pasien ASC");
?>

	<div class="card-body p-0">
		<div class="table-responsive">
			<a href="?page=pasien&act=add" class="btn btn-sm btn-primary mb-2" style="margin-right: 500px;">Add Data</a>
			<table class="table table-hover table-striped" id="table-2">
				<thead class="table-light">
					<tr>
						<th class="text-center">
							<i class="fas fa-th"></i>
						</th>
						<th>KP</th>
						<th>Nama</th>
						<th>Tgl. Lahir</th>
						<th>Kelamin</th>
						<th>Pekerjaan</th>
						<th>Alamat</th>
						<th>No. Telp</th>
						<th>Email</th>
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
							<td><?php echo $data['tanggal_lahir']; ?></td>
							<td><?php echo $data['jenis_kelamin']; ?></td>
							<td><?php echo $data['pekerjaan']; ?></td>
							<td><?php echo $data['alamat']; ?></td>
							<td><?php echo $data['telpon']; ?></td>
							<td><?php echo $data['email']; ?></td>
							<td>
								<a href="?page=pasien&act=edit&kode_pasien=<?= $data['kode_pasien']; ?>" class="btn btn-sm bg-info">Edit</a>
								<a href="?page=pasien&act=hapus&kode_pasien=<?= $data['kode_pasien']; ?>" class="btn btn-sm bg-danger">Delete</a>
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