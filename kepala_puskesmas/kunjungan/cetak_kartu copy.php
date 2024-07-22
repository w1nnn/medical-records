<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .card {
            visibility: visible;
            position: absolute;
            left: 0;
            top: 0;
        }

    }
</style>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-4">
                <img src="../assets/img/toraja.png" style="width: 100px;" alt="logo" class="img-fluid">
            </div>
            <div class="col-4">
                <h5 class="text-center">Kartu Pasien</h5>
            </div>
            <div class="col-4">
                <img src="../assets/img/logo.png" style="width: 100px;" alt="logo" class="img-fluid">
            </div>
        </div>
        <hr>
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table table-bordered">
                <tr>
                    <td>No. Reg</td>
                    <td>:</td>
                    <td><?= $data['no_reg']; ?></td>
                </tr>
                <tr>
                    <td>Tgl. Reg</td>
                    <td>:</td>
                    <td><?= $data['tgl_reg']; ?></td>
                </tr>
                <tr>
                    <td>Unit Tujuan</td>
                    <td>:</td>
                    <td><?= $data['unit_tujuan']; ?></td>
                </tr>
                <tr>
                    <td>Kode Pasien</td>
                    <td>:</td>
                    <td><?= $data['kode_pasien']; ?></td>
                </tr>
                <tr>
                    <td>Nama Pasien</td>
                    <td>:</td>
                    <td><?= $data['nama_pasien']; ?></td>
                </tr>
                <tr>
                    <td>Jns. Kelamin</td>
                    <td>:</td>
                    <td><?= $data['jenis_kelamin']; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= $data['alamat']; ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>