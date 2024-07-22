<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
    exit; // Exiting to prevent further execution
} else {

    include "../../koneksi/koneksi.php";
    $result = mysqli_query($conn, "SELECT * FROM tb_kunjungan");
?>

    <div class="card-body p-0">
        <div class="table-responsive">
            <a href="?page=pendaftaran-pasien&act=add" class="btn btn-sm btn-primary mb-2" style="margin-right: 500px;">Add Data</a>
            <table class="table table-hover table-striped" id="table-2">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">
                            <i class="fas fa-th"></i>
                        </th>
                        <th>Jenis Layanan</th>
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
                            <td><?php echo $data['jenis_layanan']; ?></td>
                            <td><?php echo $data['no_reg']; ?></td>
                            <td><?php echo $data['tgl_reg']; ?></td>
                            <td><?php echo $data['unit_tujuan']; ?></td>
                            <td><?php echo $data['kode_pasien']; ?></td>
                            <td><?php echo $data['nama_pasien']; ?></td>
                            <td><?php echo $data['jenis_kelamin']; ?></td>
                            <td><?php echo $data['alamat']; ?></td>
                            <td>
                                <a href="?page=pendaftaran-pasien&act=edit&no_reg=<?= $data['no_reg']; ?>" class="btn btn-sm bg-info">Edit</a>
                                <a href="?page=pendaftaran-pasien&act=hapus&no_reg=<?= $data['no_reg']; ?>" class="btn btn-sm bg-danger">Delete</a>
                                <form method="post" action="?page=pendaftaran-pasien&act=cetak">
                                    <input type="hidden" name="kode_pasien" value="<?= $data['kode_pasien']; ?>">
                                    <button type="submit" class="btn btn-sm btn-success my-1">Cetak Kartu</button>
                                </form>
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