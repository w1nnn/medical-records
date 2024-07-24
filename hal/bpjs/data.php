<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
    exit;
} else {
    include "../../koneksi/koneksi.php";
    $result = mysqli_query($conn, "SELECT * FROM bpjs");
?>
    <div class="card-body p-0">
        <div class="table-responsive">
            <a href="?page=bpjs&act=add" class="btn btn-sm btn-primary mb-2" style="margin-right: 500px;">Add Data</a>
            <table class="table table-hover table-striped" id="table-2">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">
                            <i class="fas fa-th"></i>
                        </th>
                        <th>No Kartu</th>
                        <th>NIK</th>
                        <th>Kode Pasien</th>
                        <th>No Rekam Medis</th>
                        <th>Diagnosa</th>
                        <th>No Resep</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php while ($data = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['no_kartu']; ?></td>
                            <td><?php echo $data['nik']; ?></td>
                            <td><?php echo $data['kode_pasien']; ?></td>
                            <td><?php echo $data['no_rekam_medis']; ?></td>
                            <td><?php echo $data['diagnosa']; ?></td>
                            <td><?php echo $data['no_resep']; ?></td>
                            <td>
                                <a href="?page=bpjs&act=detail&no_resep=<?= $data['no_resep']; ?>&kode_pasien=<?= $data['kode_pasien']; ?>&no_kartu=<?= $data['no_kartu']; ?>" class="btn btn-sm bg-primary text-white">Detail Transaksi</a>
                                <a onclick="return confirm('Yakin Hapus Data ??')" href="?page=bpjs&act=del&id=<?= $data['id']; ?>" class="btn btn-sm bg-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>



    <form id="detailForm" action="?page=bpjs&act=detail" method="POST" style="display: none;">
        <input type="hidden" name="no_resep" id="no_resep">
        <input type="hidden" name="kode_pasien" id="kode_pasien">
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