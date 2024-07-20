<?php
session_start();

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<script>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php';</script>";
    exit;
}
?>
<style>
    @import url("https://fonts.cdnfonts.com/css/public-sans");

    * {
        box-sizing: border-box;
        font-family: inherit;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        .container,
        .container * {
            visibility: visible;
        }

        .container {
            position: absolute;
            left: 0;
            top: 0;
        }

        main {
            page-break-after: always;
        }

    }

    main {
        print-color-adjust: exact;
        -webkit-print-color-adjust: exact;
        width: 450px;
        height: 250px;
        border: 1px solid #e0e2e7;
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        padding: 16px;
        border-radius: 8px;
        background-color: #0093E9;
        background-color: #74EBD5;
        background-color: #F4D03F;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    }

    .green {
        background-image: linear-gradient(68.6deg, rgba(79, 183, 131, 1) 14.4%, rgba(254, 235, 151, 1) 92.7%);
        color: #fff;

    }

    .blue {
        background-image: linear-gradient(280.6deg, rgba(15, 2, 2, 1) 11.2%, rgba(36, 163, 190, 1) 91.1%);
        color: #fff;

    }

    .logo {
        display: flex;
        align-items: center;
        gap: 8px;
        position: absolute;
        top: 8px;
        right: 16px;
        z-index: 1;
    }

    .logo img {
        width: 32px;
        flex-shrink: 0;
    }

    .flex {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    h2 {
        font-family: "Public Sans", sans-serif;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.07px;
        margin: 0 0 8px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table td {
        padding: 2px 0;
        font-size: 12px;
    }

    table td:first-child {
        width: 150px;
        /* Lebar kolom pertama */
        font-weight: bold;
    }

    footer {
        display: flex;
        justify-content: space-between;
    }

    h4 {
        font-family: "Public Sans", sans-serif;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .5px;
    }

    .container {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        justify-content: center;

    }
</style>


<?php
include "../../koneksi/koneksi.php";
$kode_pasien = $_POST['kode_pasien'];
$query = mysqli_query($conn, "SELECT * FROM tb_kunjungan WHERE kode_pasien = '$kode_pasien'");

?>

<div class="container">
    <?php while ($data = mysqli_fetch_assoc($query)) : ?>
        <main class="green">
            <div class="logo">
                <img src="../assets/img/k1.png" alt="logo" style="width: 70px;">
            </div>
            <div class="flex">
                <h2>Puskesmas Kondodewata</h2>
                <table class="mt-3">
                    <tr>
                        <td>ID</td>
                        <td>: <?= $data['kode_pasien']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Pasien</td>
                        <td>: <?= $data['nama_pasien']; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: <?= $data['jenis_kelamin']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?= $data['alamat']; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Registrasi </td>
                        <td>: <?= $data['tgl_reg']; ?></td>
                    </tr>
                </table>
            </div>
            <footer>
                <h4><?= $data['no_reg']; ?></h4>
                <h2>
                    <img src="../assets/img/bpjs.png" alt="BPJS" style="width: 150px;">
                </h2>
            </footer>
        </main>
        <main class="blue">
            <div class="logo">
                <img src="../assets/img/k1.png" alt="logo" style="width: 70px;">
            </div>
            <div class="flex">
                <h2>Puskesmas Kondodewata</h2>
                <table class="mt-3">
                    <tr>
                        <td>ID</td>
                        <td>: <?= $data['kode_pasien']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Pasien</td>
                        <td>: <?= $data['nama_pasien']; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: <?= $data['jenis_kelamin']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?= $data['alamat']; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Registrasi </td>
                        <td>: <?= $data['tgl_reg']; ?></td>
                    </tr>
                </table>
            </div>
            <footer>
                <h4><?= $data['no_reg']; ?></h4>
                <h2>
                    <svg class="logo" style="margin-top: 200px;" width="39" height="39" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="10" cy="16" r="9" fill="#ff0000" />
                        <circle cx="22" cy="16" r="9" fill="#ffea00" />
                        <path d="M16 22.7083C17.8413 21.0603 19 18.6655 19 16C19 13.3345 17.8413 10.9397 16 9.29175C14.1587 10.9397 13 13.3345 13 16C13 18.6655 14.1587 21.0603 16 22.7083Z" fill="#ff8700" />
                    </svg>
                </h2>
            </footer>
        </main>
    <?php endwhile; ?>
</div>
<script>
    window.print();
</script>