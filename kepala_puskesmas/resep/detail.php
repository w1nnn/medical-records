<form action="?page=resep-dokter&act=tambah" method="post">
    <?php
    include "../../koneksi/koneksi.php";
    $sqlx = "SELECT MAX(RIGHT(no_resep,4)) AS terakhir FROM tb_resep_detail";
    $hasilx = mysqli_query($conn, $sqlx);
    $datax = mysqli_fetch_array($hasilx);
    $lastIDx = $datax['terakhir'];
    $lastNoUrutx = (int) $lastIDx;
    $nextNoUrutx = $lastNoUrutx + 1;
    $nextIDx = "RSP-" . sprintf("%04s", $nextNoUrutx);
    ?>
    <label for="nomor-resep">No. Resep</label>
    <input class="form-control" id="nomor-resep" name="no_resep" type="text" value="<?php echo $nextIDx; ?>" readonly>
    <div class="form-group">
        <label for="type-farmasi">Jenis Obat</label>
        <select class="form-control" name="type_farmasi" id="type_farmasi">
            <option>Pilih ...</option>
            <option value="medicine">Umum</option>
            <option value="vaccine">Vaksin</option>
            <option value="supplement">Suplemen</option>
            <option value="herbal">Herbal</option>
        </select>
    </div>
    <div class="form-group">
        <label for="nama_obat">Nama Obat</label>
        <select name="nama_obat" id="nama_obat" class="form-control" required>
            <option value="0">-Pilih-</option>

        </select>
    </div>
    <div class="form-group">
        <label for="detail_obat">Detail Obat</label>
        <input type="text" name="detail_obat" id="detail_obat" class="form-control" readonly>
    </div>
    <div class="form-group">
        <label for="bentuk">Bentuk</label>
        <input type="text" name="bentuk" id="bentuk" class="form-control" readonly>
    </div>
    <div class="form-group">
        <label for="kode_obat">Kode KFA</label>
        <input type="text" name="kode_obat" id="kode_obat" class="form-control" readonly>
    </div>
    <div class="form-group">
        <label for="nie">No Izin Edar (NIE)</label>
        <input type="text" name="nie" id="nie" class="form-control" readonly>
    </div>

    <div class="form-group">
        <label for="stok">Sisa Stok</label>
        <input type="text" name="stok" id="stok" class="form-control" readonly>
    </div>

    <div class="form-group">
        <label for="qty">QTY</label>
        <input type="text" name="qty" id="qty" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="aturan_pakai">Aturan Pakai</label>
        <input type="text" name="aturan_pakai" id="aturan_pakai" class="form-control" required>
    </div>

    <button type="submit" name="tambah" class="btn btn-primary btn-sm">Tambah</button>
</form>
<script>
    document.getElementById('type_farmasi').addEventListener('change', async function() {
        const typeFarmasi = this.value.trim();
        const namaObatSelect = document.getElementById('nama_obat');

        if (typeFarmasi.length > 0) {
            try {
                const response = await fetch('../hal/resep/get_tipe_obat.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'type_farmasi=' + encodeURIComponent(typeFarmasi)
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                let options = '<option value="0">-Pilih-</option>';
                data.forEach(item => {
                    options += `<option value="${item.kfa}">${item.nama_produk} -- ${item.kfa} --</option>`;
                });
                namaObatSelect.innerHTML = options;

            } catch (error) {
                console.error('Error:', error);
            }
        } else {
            tableBody.innerHTML = '';
        }
    });

    document.getElementById('nama_obat').addEventListener('change', async function() {
        const namaObat = this.value.trim();
        const detailObat = document.getElementById('detail_obat');
        const bentuk = document.getElementById('bentuk');
        const kodeObat = document.getElementById('kode_obat');
        const nie = document.getElementById('nie');
        const stok = document.getElementById('stok');

        if (namaObat.length > 0) {
            try {
                const response = await fetch('../hal/resep/get_detail_obat.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'nama_obat=' + encodeURIComponent(namaObat)
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const dataByName = await response.json();
                detailObat.value = dataByName[0].detail_produk;
                bentuk.value = dataByName[0].bentuk;
                kodeObat.value = dataByName[0].kfa;
                nie.value = dataByName[0].nie;
                stok.value = dataByName[0].stok;



            } catch (error) {
                console.error('Error:', error);
            }
        } else {
            detailObat.value = '';
            bentuk.value = '';
            kodeObat.value = '';
            nie.value = '';
            jumlah.value = '';
        }
    });
</script>