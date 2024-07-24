<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen');
          window.location = '../../index.php'</script>";
    exit;
}

include "../../koneksi/koneksi.php";

function getCurrentDate()
{
    date_default_timezone_set('Asia/Jakarta');
    return date("Y-m-d", mktime(date("m"), date("d"), date("Y")));
}

// Ini Yang diapakai
$dataRekmed = [];
$jenisLayanan = mysqli_query($conn, "SELECT * FROM tb_kunjungan WHERE jenis_layanan = 'bpjs'");
while ($row = mysqli_fetch_assoc($jenisLayanan)) {
    $rekamMedis = mysqli_query($conn, "SELECT no_rekmed, kode_pasien, diagnosa, keterangan FROM tb_rekmed WHERE kode_pasien = '" . $row['kode_pasien'] . "'");
    while ($rekamMedisRow = mysqli_fetch_assoc($rekamMedis)) {
        $dataRekmed[] = [
            'no_rekmed' => $rekamMedisRow['no_rekmed'],
            'kode_pasien' => $rekamMedisRow['kode_pasien'],
            'diagnosa' => $rekamMedisRow['diagnosa'],
            'keterangan' => $rekamMedisRow['keterangan']
        ];
    }
}
?>

<form action="?page=bpjs&act=simpan" method="POST">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="alert" style="background-color: #8BC6EC;background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
                        <b>Form</b> Tambah Data Pasien
                    </div>
                    <div class="form-group">
                        <label>No Kartu</label>
                        <input name="no_kartu" id="no_kartu" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>NIK</label>
                        <input name="nik" id="nik" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>No. Rekam Medis</label>
                        <select class="form-control" name="no_rekmed" id="no_rekmed">
                            <option>Choose</option>
                            <?php foreach ($dataRekmed as $rekmed) : ?>
                                <option value="<?= $rekmed['no_rekmed'] ?>" data-kode-pasien="<?= $rekmed['kode_pasien'] ?>" data-diagnosa="<?= $rekmed['diagnosa'] ?>" data-keterangan="<?= $rekmed['keterangan'] ?>"><?= $rekmed['no_rekmed'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="no_rekmed" id="no_rekmed_input" type="hidden" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kode Pasien</label>
                        <input name="kode_pasien" id="kode_pasien_input" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <input name="nama_pasien" id="nama_pasien" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input name="alamat" id="alamat" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>No. Telp</label>
                        <input name="telpon" id="telpon" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" id="email" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Diagnosa</label>
                        <input name="diagnosa" id="diagnosa" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input name="keterangan" id="keterangan" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>No Resep</label>
                        <input type="text" name="no_resep" id="resep" class="form-control" readonly></input>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button name="simpan" type="submit" class="btn btn-primary mr-1">Simpan</button>
                    <a href="?page=bpjs" class="btn btn-sm btn-warning" type="reset">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('no_rekmed').addEventListener('change', async function() {
        const selectedOption = this.options[this.selectedIndex];
        const noRekmed = selectedOption.value;
        const kodePasien = selectedOption.getAttribute('data-kode-pasien');
        const diagnosa = selectedOption.getAttribute('data-diagnosa');
        const keterangan = selectedOption.getAttribute('data-keterangan');

        document.getElementById('no_rekmed_input').value = noRekmed;
        document.getElementById('kode_pasien_input').value = kodePasien;
        document.getElementById('diagnosa').value = diagnosa;
        document.getElementById('keterangan').value = keterangan;

        try {
            const resepResponse = await fetch('../hal/bpjs/fetch_resep.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    no_rekmed: noRekmed
                })
            });

            const resepData = await resepResponse.json();
            console.log(resepData);
            if (resepData.resep) {
                document.getElementById('resep').value = resepData.resep.join(', ');
            } else if (resepData.error) {
                console.error('Error:', resepData.error);
            }

            const pasienResponse = await fetch('../hal/bpjs/fetch_pasien.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    kode_pasien: kodePasien
                })
            });

            const pasienData = await pasienResponse.json();
            console.log(pasienData);
            if (pasienData.nama_pasien) {
                document.getElementById('nama_pasien').value = pasienData.nama_pasien;
                document.getElementById('telpon').value = pasienData.telpon;
                document.getElementById('email').value = pasienData.email;
                document.getElementById('alamat').value = pasienData.alamat;
            } else if (pasienData.error) {
                console.error('Error:', pasienData.error);
            }
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    });
</script>