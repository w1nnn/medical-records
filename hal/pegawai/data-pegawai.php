<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
	exit; // Exiting to prevent further execution
} else {

	include "../../koneksi/koneksi.php";
	$result = mysqli_query($conn, "SELECT * FROM tb_pegawai ORDER BY kode_pegawai ASC");
?>

	<div class="card-body p-0">
		<div class="table-responsive">
			<a href="?page=pasien&act=add" class="btn btn-sm btn-primary mb-2" style="margin-right: 500px;">Add Data</a>
			<table class="table table-striped" id="table-2">
				<thead class="table-light">
					<tr>
						<th class="text-center">
							<i class="fas fa-th"></i>
						</th>
						<th>Kd. Pegawai</th>
						<th>Nama Pegawai</th>
						<th>Bagian</th>
						<th>Tgl. Lahir</th>
						<th>Alamat</th>
						<th>No. Telp</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php while ($data = mysqli_fetch_array($result)) : ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['kode_pegawai']; ?></td>
							<td><?php echo $data['nama_pegawai']; ?></td>
							<td><?php echo $data['nama_bagian']; ?></td>
							<td><?php echo $data['tanggal_lahir']; ?></td>
							<td><?php echo $data['alamat']; ?></td>
							<td><?php echo $data['telpon']; ?></td>
							<td>
								<a href="edit-data.php?kode_pegawai=<?= $data['kode_pegawai']; ?>" class="btn btn-sm bg-info">Edit</a>
								<a href="proses-hapus.php?kode_pegawai=<?= $data['kode_pegawai']; ?>" class="btn btn-sm bg-danger">Delete</a>
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