<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen');
					window.location = '../../index.php'</script>";
} else {

?>
	<?php
	if (isset($_GET['kfa'])) {
		$kfa = $_GET['kfa'];
		$sql_select = "SELECT * FROM tb_obat WHERE kfa = '$kfa'";
		$hasil = mysqli_query($conn, $sql_select);
		$data = mysqli_fetch_assoc($hasil);
	} else {
		echo "<script>window.location='?page=obat';</script>";
		exit;
	}
	?>


	<form action="?page=obat&act=simpan" method="POST">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="alert" style="background-color: #8BC6EC;background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
							<b>Form</b> Edit Data Obat
						</div>
						<div class="form-group">
							<label>Nama Produk</label>
							<input name="nama_produk" type="text" value="<?= $data['nama_produk']; ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Detail Produk</label>
							<input name="detail produk" type="text" value="<?= $data['detail_produk']; ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Bentuk</label>
							<input name="bentuk" type="text" value="<?= $data['bentuk']; ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Nomor Izin Edar (NIE)</label>
							<input name="nie" type="text" value="<?= $data['nie']; ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Kode KFA</label>
							<input name="kfa" type="text" value="<?= $data['kfa']; ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Manufaktur</label>
							<input name="manufaktur" type="text" value="<?= $data['manufaktur']; ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Harga</label>
							<input name="harga" type="text" value="<?= $data['harga']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Stok</label>
							<input name="stok" type="text" value="<?= $data['stok']; ?>" class="form-control">
						</div>
						<div class="card-footer text-right">
							<button name="edit" type="submit" class="btn btn-primary mr-1">Simpan</button>
							<a href="?page=obat" class="btn btn-sm btn-warning" type="reset">Batal</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>

<?php
}
?>