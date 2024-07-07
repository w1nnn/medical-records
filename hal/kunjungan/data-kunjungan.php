<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
	exit; // Exiting to prevent further execution
} else {

	include "../../koneksi/koneksi.php";
	$result = mysqli_query($conn, "SELECT tb_kunjungan.no_reg, tb_kunjungan.tgl_reg, tb_kunjungan.unit_tujuan, tb_kunjungan.kode_pasien, tb_pasien.kode_pasien, tb_pasien.nama_pasien, tb_pasien.jenis_kelamin, tb_pasien.alamat FROM tb_kunjungan, tb_pasien WHERE tb_kunjungan.kode_pasien = tb_pasien.kode_pasien");
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
						<th>No. Reg</th>
						<th>Tgl. Reg</th>
						<th>Unit Tujuan</th>
						<th>Kode Pasien</th>
						<th>Nama Pasien</th>
						<th>Jns. Kelamin</th>
						<th>Alamat</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php while ($data = mysqli_fetch_array($result)) : ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['no_reg']; ?></td>
							<td><?php echo $data['tgl_reg']; ?></td>
							<td><?php echo $data['unit_tujuan']; ?></td>
							<td><?php echo $data['kode_pasien']; ?></td>
							<td><?php echo $data['nama_pasien']; ?></td>
							<td><?php echo $data['jenis_kelamin']; ?></td>
							<td><?php echo $data['alamat']; ?></td>
							<td>
								<a href="edit-data.php?no_reg=<?= $data['no_reg']; ?>" class="btn btn-sm bg-info">Edit</a>
								<a href="proses-hapus.php?no_reg=<?= $data['no_reg']; ?>" class="btn btn-sm bg-danger">Delete</a>
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