-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2024 at 01:12 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rekam_medis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluar`
--

CREATE TABLE `tb_keluar` (
  `no_keluar` varchar(15) NOT NULL,
  `kode_pegawai` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluar_detail`
--

CREATE TABLE `tb_keluar_detail` (
  `auto` int NOT NULL,
  `no_keluar` varchar(15) NOT NULL,
  `kode_obat` varchar(15) NOT NULL,
  `nama_obat` varchar(35) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kunjungan`
--

CREATE TABLE `tb_kunjungan` (
  `jenis_layanan` varchar(255) NOT NULL,
  `no_reg` varchar(15) NOT NULL,
  `tgl_reg` date NOT NULL,
  `unit_tujuan` varchar(25) NOT NULL,
  `kode_pasien` varchar(15) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kunjungan`
--

INSERT INTO `tb_kunjungan` (`jenis_layanan`, `no_reg`, `tgl_reg`, `unit_tujuan`, `kode_pasien`, `nama_pasien`, `jenis_kelamin`, `alamat`) VALUES
('umum', 'REG-001', '2023-06-10', 'Poli Umum', 'PSN0001', 'Erwin', 'Laki-Laki', 'Makassar'),
('bpjs', 'REG-002', '2024-07-10', 'IGD', 'PSN0002', 'Fitriani', 'Perempuan', 'Makassar'),
('bpjs', 'REG-003', '2024-07-10', 'Poli Gigi', 'PSN0004', 'Cancuji nakke', 'Laki Laki', 'Petani Tambang'),
('umum', 'REG-004', '2024-02-18', 'Poli Umum', 'PSN0003', 'Muh Supri', 'Laki-Laki', 'Bone');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kwitansi`
--

CREATE TABLE `tb_kwitansi` (
  `id_kwitansi` int NOT NULL,
  `kode_pasien` varchar(15) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_rekam_medis` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `diagnosa` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `no_resep` varchar(255) NOT NULL,
  `order_id` varchar(50) NOT NULL DEFAULT '-',
  `harga` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `sts` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kwitansi`
--

INSERT INTO `tb_kwitansi` (`id_kwitansi`, `kode_pasien`, `nama_pasien`, `telepon`, `email`, `no_rekam_medis`, `diagnosa`, `keterangan`, `no_resep`, `order_id`, `harga`, `sts`) VALUES
(2, 'PSN0004', 'Cancuji', '081354546330', 'cancu@gmail.com', 'RM-0004', 'Kalasi', 'Kurangi Kuttunya', 'RSP-0001', '-', '0', '-'),
(3, 'PSN0001', 'Erwin', '081354546330', 'erwin@handayani.ac.id', 'RM-0001', 'Demam', 'Istirahat Dibutuhkan', 'RSP-0001, RSP-0002', '-', '0', '-'),
(4, 'PSN0003', 'Muh Supri', '081567542232', 'supryasiz@gmail.com', 'RM-0003', 'Mekke', 'Stop ngoding dulu bang', 'RSP-0003, RSP-0001', '-', '0', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `username` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `foto` varchar(20) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`username`, `password`, `nama`, `foto`, `level`) VALUES
('admin', 'admin', 'Arniati Tari', 'admin.jpg', 'admin'),
('kepus', 'kepus', 'Kepala Puskesmas', 'foto.png', 'kepus');

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id` int NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `detail_produk` varchar(255) NOT NULL,
  `bentuk` varchar(255) NOT NULL,
  `zat_aktif` varchar(255) NOT NULL,
  `nie` varchar(255) NOT NULL,
  `kfa` varchar(255) NOT NULL,
  `manufaktur` varchar(255) NOT NULL,
  `tipe_farmasi` varchar(255) NOT NULL,
  `harga` int NOT NULL DEFAULT '0',
  `stok` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`id`, `nama_produk`, `detail_produk`, `bentuk`, `zat_aktif`, `nie`, `kfa`, `manufaktur`, `tipe_farmasi`, `harga`, `stok`) VALUES
(1, 'INZANA', 'Acetylsalicylic Acid 80 mg Tablet Kunyah (INZANA)', 'Tablet Kunyah', 'Aspirin', 'DBL7813003663A1', '93004162', 'KONIMEX', 'medicine', 18500, 0),
(2, 'BACTESYN', 'Ampicillin 500 mg / Sulbactam 250 mg Serbuk Injeksi (BACTESYN)', 'Serbuk Injeksi', 'AMPICILLIN', 'DKL9411620244A1', '93001321', 'BERNOFARM', 'medicine', 0, 0),
(3, 'Ampicillin', 'Ampicillin Trihydrate 500 mg Tablet (HOLI PHARMA)', 'Tablet', 'AMPICILLIN', 'GKL1017110904A1', '93001850', 'MEPROFARM', 'medicine', 12000, 700),
(4, 'BROADAPEN', 'Ampicillin Trihydrate 125 mg/5 mL Sirup Kering (BROADAPEN)', 'Sirup Kering', 'AMPICILLIN', 'DKL0823411538A1', '93003422', 'SAMPHARINDO PERDANA', 'medicine', 0, 0),
(5, 'BODREXIN DEMAM FORTE', 'Paracetamol 250 mg/5 mL Suspensi (BODREXIN)', 'Suspensi', 'Paracetamol', 'DBL1422723233A2', '93009895', 'TEMPO SCAN PACIFIC Tbk', 'medicine', 0, 0),
(6, 'BODREXIN DEMAM RASA JERUK', 'Paracetamol 160 mg/5 mL Sirup (60 mL, BODREXIN DEMAM RASA JERUK, BOTOL PLASTIK, JERUK)', 'Sirup', 'Paracetamol', 'DBL9322707337A1', '93013342', 'TEMPO SCAN PACIFIC Tbk', 'medicine', 0, 0),
(7, 'BODREXIN DEMAM (RASA JERUK)', 'Paracetamol 100 mg/mL Drops (BODREXIN DEMAM (RASA JERUK))', 'Tetes Oral (Oral Drops)', 'Paracetamol', 'DBL1322722336A1', '93013618', 'TEMPO SCAN PACIFIC Tbk', 'medicine', 82000, 60),
(8, 'MENIVAX ACYW', 'Vaksin Meningococcal Polysaccharide 50 ug Serbuk Injeksi (MENIVAX ACYW)', 'Serbuk Injeksi', 'Meningococcal Group A Polysaccharide', 'DKI1442300144A1', '93001278', 'BEIJING ZHIFEI LVZHU BIOPHARMACEUTICAL CO., LTD', 'vaccine', 0, 0),
(9, 'PENTABIO', 'Vaksin DTP - HB - Hib Injeksi (1, PENTABIO)', 'Suspensi Injeksi', 'Haemophilus Influenzae B (Ross Strain) Capsular Polysaccharide Meningococcal Protein Conjugate Vaccine', 'DKL1302906943A1', '93001282', 'BIO FARMA', 'vaccine', 0, 0),
(10, 'STAMARIL PASTEUR', 'Vaksin Yellow Fever 1000 IU 0,5 mL (1, STAMARIL PASTEUR)', 'Serbuk Injeksi', 'Yellow Fever Virus Strain 17D-204 Live Antigen', 'DKI1059702744A1', '93001560', 'SANOFI PASTEUR', 'vaccine', 0, 0),
(11, 'PNEUMOSIL', 'Vaksin Streptococcus pneumoniae 10-valen 0.5 mL (5)', 'Suspensi Injeksi', 'Streptococcus Pneumoniae Serotype 1 Capsular Antigen Diphtheria Crm197 Protein Conjugate Vaccine', 'DKI2240300543A1', '93001620', 'SERUM INSTITUTE OF INDIA PVT. LTD.', 'vaccine', 0, 0),
(12, 'ROTATEQ', 'Vaksin Rotavirus Pentavalent Larutan Oral (1, ROTATEQ)', 'Larutan', 'Human-Bovine Reassortant Rotavirus Strain G1 Vaccine', 'DKI1063601935A1', '93001653', 'MERCK SHARP & DOHME CORP.', 'vaccine', 0, 0),
(13, 'CHIRORAB', 'Vaksin Rabies Inactivated rabies virus (flury lep) NLT 2,5 IU/mL Injeksi (CHIRORAB)', 'Serbuk Injeksi', 'Rabies Virus Vaccine Flury-Lep Strain', 'DKI2239100344A1', '93003763', 'CHIRON BEHRING VACCINES PVT. LTD.', 'vaccine', 0, 0),
(14, 'VAKSIN COVID-19', 'Vaksin COVID-19, Inactivated 3 ug/0,5 mL (10)', 'Suspensi Injeksi', 'Sars-Cov-2 (Covid-19) Vaccine, Vector Non-Replicating', 'EUA2102907543A1', '93003775', 'BIOFARMA (PERSERO)', 'vaccine', 8000, 85),
(15, 'COVID-19 VACCINE ASTRAZENECA', 'Vaksin COVID-19 Recombinant Adenovirus (CHADOX1), 5x10^10 VP/0.5 mL (10, ASTRAZENECA)', 'Suspensi Injeksi', 'Sars-Cov-2 (Covid-19) Vaccine, Vector Non-Replicating', 'EUA2159800143A1', '93004035', 'UNIVERSAL FARMA, S.L.', 'vaccine', 0, 0),
(16, 'RECOMBINANT COVID-19 VACCINE', 'Vaksin COVID-19 Rekombinan, 25 ug/0.5 mL (10, INDOVAC)', 'Suspensi Injeksi', 'Sars-Cov-2 (Covid-19) Vaccine, Vector Non-Replicating', 'EUA2202908043A1', '93004052', 'BIO FARMA', 'vaccine', 0, 0),
(18, 'VITAMIN A PALMITATE', 'Retinol Palmitate 100.000 IU Kapsul Lunak (KIMIA FARMA)', 'Kapsul Lunak', 'RETINOL', 'GKL9932300102B1', '93001118', 'KIMIA FARMA TBK', 'medicine', 0, 0),
(19, 'VITAMIN A', 'Retinol Palmitate 200.000 IU Kapsul Lunak (LUCAS DJAJA)', 'Kapsul Lunak', 'RETINOL', 'GKL0813611402B1', '93002593', 'LUCAS DJAJA', 'medicine', 44000, 90),
(20, 'VITAMIN B1', 'Thiamine Hydrochloride 100 mg / mL Injeksi (10 mL, VITAMIN B1)', 'Larutan Injeksi', 'Thiamine', 'GKL9610701843A1', '93004464', 'GLOBAL MULTI PHARMALAB', 'medicine', 0, 0),
(21, 'BECOM-C', 'Vitamin B1 50 mg / Vitamin B2 25 mg / Vitamin B6 10 mg / Vitamin B12 5 mcg / Vitamin C 500 mg / Nicotinamide 100 mg / Pantothenic Acid 18.4 mg (BECOM-C)', 'Kaplet', 'ASCORBIC ACID', 'POM SD081534111', '93005518', 'SANBE FARMA', 'medicine', 0, 0),
(22, 'BECOM-ZET', 'Vitamin E 30 IU / Vitamin C 750 mg / Vitamin B1 15 mg / Vitamin B6 / Vitamin B6 20 mg / Vitamin B12 12 mcg / Folic Acid 400 mcg / Pantothenic Acid 20 mg / Zinc 15 mg / Niacin 100 mg Tablet (BECOM - ZET)', 'Tablet', 'ASCORBIC ACID', 'POM SD191555181', '93005545', 'SANBE FARMA', 'medicine', 0, 0),
(23, 'HERBESSER CD 100', 'Diltiazem Hydrochloride 100 mg Kapsul Pelepasan Lambat (HERBESSER CD 100)', 'Kapsul Pelepasan Lambat', 'Diltiazem', 'DKL1025202503A1', '93000330', 'MITSUBISHI TANABE PHARMA INDONESIA', 'medicine', 0, 0),
(24, 'HERZUMA', 'Trastuzumab 150 mg Serbuk Injeksi (HERZUMA)', 'Serbuk Injeksi', 'Trastuzumab', 'DKI1954100244A1', '93010101', 'CELLTRION, INC.', 'medicine', 0, 0),
(25, 'Stimuno Forte', 'Ekstrak Phyllanthus niruri Herba 50 mg Kapsul (STIMUNO FORTE)', 'Kapsul', 'Ekstrak Phyllanthus niruri Herba', 'FF152300641', '93021992', 'PT DEXA MEDICA', 'herbal', 0, 0),
(26, 'Ekstrak Psidium guajava Folium 240 mg / Ekstrak Curcuma domestica Rhizoma 204 mg / Ekstrak Terminalia chebula Fructus 84 mg / Ekstrak Punica granatum Pericarpium 72 mg Kapsul (DIAPET)', 'Ekstrak Psidium guajava Folium 240 mg / Ekstrak Curcuma domestica Rhizoma 204 mg / Ekstrak Terminalia chebula Fructus 84 mg / Ekstrak Punica granatum Pericarpium 72 mg Kapsul (DIAPET)', 'Kapsul', 'Ekstrak Psidium guajava Folium', 'HT192300781', '93021994', 'PT Soho Industri Pharmasi', 'herbal', 0, 0),
(27, 'Ekstrak Apium graveolens Herba 92 mg / Ekstrak Orthosiphon stamineus Folium 28 mg Kapsul (TENSIGARD)', 'Ekstrak Apium graveolens Herba 92 mg / Ekstrak Orthosiphon stamineus Folium 28 mg Kapsul (TENSIGARD)', 'Kapsul', 'Ekstrak Apium graveolens Herba', 'FF142300591', '93021995', 'PT PHAPROS Tbk', 'herbal', 0, 0),
(28, 'ANADIUM', 'Diosmin 450 mg / Hesperidin 50 mg Kaplet Salut Selaput (ANADIUM)', 'Kaplet Salut Selaput', 'Diosmin', 'TR192527101', '93022209', 'PT GUARDIAN PHARMATAMA', 'herbal', 0, 0),
(30, 'Asam Folat 400 mg Tablet (HOLI PHARMA)', 'Asam Folat 400 mg Tablet (HOLI PHARMA)', 'Tablet', 'FOLIC ACID', 'SD191553931', '93001872', 'HOLI PHARMA', 'supplement', 0, 0),
(31, 'Kalsium Laktat', 'Calcium Lactate 500 mg Tablet (HOLI PHARMA)', 'Tablet', 'Calcium Lactate', 'POM SD161548321', '93001923', 'HOLI PHARMA', 'supplement', 0, 0),
(32, 'Asam Folat', 'Folic Acid 400 mcg Tablet (HOLI PHARMA)', 'Tablet', 'FOLIC ACID', 'POM SD191553931', '93002416', 'HOLI PHARMA', 'supplement', 0, 0),
(33, 'Folic Acid', 'Folic Acid 1 mg Tablet (HOLI PHARMA)', 'Tablet', 'FOLIC ACID', 'GBL2017114710A1', '93002790', 'HOLI PHARMA', 'supplement', 0, 0),
(34, 'HOLIKALK', 'Calcium Lactate 500 mg Tablet (HOLIKALK)', 'Tablet', 'Calcium Lactate', 'POM SD 181551891', '93004948', 'HOLI PHARMA', 'supplement', 0, 0),
(35, 'LIFOLAT', 'Folic Acid 400 mcg Tablet (LIFOLAT)', 'Tablet', 'FOLIC ACID', 'DBL2017114610A1', '93005043', 'HOLI PHARMA', 'supplement', 0, 0),
(36, 'LIFOLAT FORTE', 'Folic Acid 1 mg Tablet (LIFOLAT FORTE)', 'Tablet', 'FOLIC ACID', 'GBL2017114710A1', '93005056', 'HOLI PHARMA', 'supplement', 0, 0),
(37, 'FOLAVIT', 'Folic Acid 1 mg Tablet (FOLAVIT)', 'Tablet', 'FOLIC ACID', 'DBL0422239010A1', '93005293', 'SANBE FARMA (UNIT 1)', 'supplement', 0, 0),
(38, 'BIOSANBE', 'Ferrous (II) Gluconate 250 mg / Mangan (II) Sulfate 0,2 mg / Tembaga (II) Sulfate 0,2 mg / Ascorbic Acid 50 mg / Folic Acid 1 mg / Cyanocobalamin 7,5 mcg Kapsul (BIOSANBE)', 'Kapsul', 'ASCORBIC ACID', 'POM SD191354131', '93005887', 'SANBE FARMA (UNIT 1)', 'supplement', 0, 0),
(39, 'OSTEOSAN 1000', 'Cholecalciferol 1000 IU Kapsul Lunak (OSTEOSAN 1000)', 'Kapsul Lunak', 'Colecalciferol', 'POM SD211312971', '93005971', 'SANBE FARMA (UNIT 6)', 'supplement', 0, 0),
(40, 'SANBE C 500', 'Ascorbic Acid 500 mg Tablet (SANBE C 500)', 'Tablet', 'ASCORBIC ACID', 'POM SD201544321', '93005981', 'SANBE FARMA (UNIT 1)', 'supplement', 0, 0),
(41, 'CERECOL 1000', 'Citicoline 1000 mg Tablet (CERECOL 1000)', 'Tablet', 'Citicoline', 'POM SD202581741', '93007428', 'SANBE FARMA', 'supplement', 0, 0),
(42, 'FOLIC ACID', 'Folic Acid 1 mg Tablet (MARIN LIZA FARMASI, STRIP)', 'Tablet', 'FOLIC ACID', 'GBL9514103110A2', '93007812', 'MARIN LIZA FARMASI', 'supplement', 0, 0),
(43, 'FOLIC ACID', 'Folic Acid 1 mg Tablet (BOTOL, MARIN LIZA FARMASI)', 'Tablet', 'FOLIC ACID', 'GBL9514103110A1', '93007814', 'MARIN LIZA FARMASI', 'supplement', 0, 0),
(44, 'Ascorbic Acid 500 mg Tablet (BOTOL ISI 30 KAPSUL, PT. LLOYD PHARMA INDONESIA, VITACEE 500)', 'Ascorbic Acid 500 mg Tablet (BOTOL ISI 30 KAPSUL, PT. LLOYD PHARMA INDONESIA, VITACEE 500)', 'Tablet', 'ASCORBIC ACID', 'POM SD201356411', '93010854', 'PT. LLOYD PHARMA INDONESIA', 'supplement', 0, 0),
(45, 'VITACEE 500', 'Ascorbic Acid 500 mg Tablet (BOTOL ISI 60 KAPSUL, PT. LLOYD PHARMA INDONESIA, VITACEE 500)', 'Tablet', 'ASCORBIC ACID', 'POM SD201356411', '93010867', 'PT. LLOYD PHARMA INDONESIA', 'supplement', 0, 0),
(46, 'Folic Acid 5 mg Tablet Salut Selaput (Umum)', 'Folic Acid 5 mg Tablet Salut Selaput (Umum)', 'Tablet Salut Selaput', 'FOLIC ACID', 'GKL2202508109A1', '93014356', 'DIPA PHARMALAB INTERSAINS', 'supplement', 0, 0),
(47, 'FOLIC ACID', 'Folic Acid 1 mg Tablet (MEGA LIFE SCIENCES INDONESIA)', 'Tablet', 'FOLIC ACID', 'GBL1939204410A1', '93014366', 'MEGA LIFESCIENCES INDONESIA', 'supplement', 0, 0),
(48, 'Cholecalciferol 1000 IU Kapsul Lunak (ALIVE BIOCOM-D 1000 IU, STRIP)', 'Cholecalciferol 1000 IU Kapsul Lunak (ALIVE BIOCOM-D 1000 IU, STRIP)', 'Kapsul Lunak', 'Colecalciferol', 'POM SD225013961', '93015388', 'AFIFARMA', 'supplement', 0, 0),
(49, 'Momma', 'Folic Acid 1 mg Tablet (MOMMA, STRIP)', 'Tablet', 'FOLIC ACID', 'POM SD211536331', '93015391', 'AFIFARMA', 'supplement', 0, 0),
(50, 'Folic Acid 400 mcg Tablet (ALIVE MOMMA 400)', 'Folic Acid 400 mcg Tablet (ALIVE MOMMA 400)', 'Tablet', 'FOLIC ACID', 'POM SD211571241', '93015392', 'AFIFARMA', 'supplement', 0, 0),
(51, 'Citicoline 500 mg Tablet (SEREBRON)', 'Citicoline 500 mg Tablet (SEREBRON)', 'Tablet', 'Citicoline', 'POM SD211541011', '93015394', 'AFIFARMA', 'supplement', 0, 0),
(52, 'Pyridoxine HCl 10 mg Kaplet', 'Pyridoxine Hydrochloride 10 mg Tablet (1000, AFIFARMA, BOTOL)', 'Tablet', 'Pyridoxine', 'POM SD211549161', '93015398', 'AFIFARMA', 'supplement', 0, 0),
(53, 'Vitamin B6 10 mg', 'Pyridoxine Hydrochloride 10 mg Tablet (1000, AFIFARMA, STRIP)', 'Tablet', 'Pyridoxine', 'POM SD211537991', '93015399', 'AFIFARMA', 'supplement', 0, 0),
(54, 'Vitamin B6 25 mg Tablet', 'Pyridoxine HCl 25 mg Tablet (100, AFIFARMA, DUS ISI 10 STRIP)', 'Tablet', 'Pyridoxine', 'POM SD225028681', '93015400', 'AFIFARMA', 'supplement', 0, 0),
(55, 'Pyridoxine HCl 25 mg Tablet', 'Pyridoxine HCl 25 mg Tablet (1000, AFIFARMA, BOTOL PLASTIK)', 'Tablet', 'Pyridoxine', 'POM SD225035381', '93015401', 'AFIFARMA', 'supplement', 0, 0),
(56, 'VITAMIN C 50, STRIP', 'Ascorbic Acid 50 mg Tablet (STRIP, VITAMIN C 50)', 'Tablet', 'ASCORBIC ACID', 'POM SD225012091', '93015405', 'AFIFARMA', 'supplement', 0, 0),
(57, 'VITAMIN C 50', 'Ascorbic Acid 50 mg Tablet (BOTOL, VITAMIN C 50)', 'Tablet', 'ASCORBIC ACID', 'POM SD211575391', '93015406', 'AFIFARMA', 'supplement', 0, 0),
(58, 'WHITE VITAMIN C 50', 'Ascorbic Acid 50 mg Tablet (STRIP, WHITE VITAMIN C 50)', 'Tablet', 'ASCORBIC ACID', 'POM SD225012091', '93015407', 'AFIFARMA', 'supplement', 0, 0),
(59, 'ALIVE BIOCOM-C SD', 'Ascorbic Acid 500 mg Tablet (ALIVE BIOCOM-C SD, BOTOL ISI 100, PT. AFIFARMA)', 'Tablet', 'ASCORBIC ACID', 'POM SD211394401', '93015414', 'AFIFARMA', 'supplement', 0, 0),
(60, 'ALIVE BIOCOM-C SD', 'Ascorbic Acid 500 mg Tablet (ALIVE BIOCOM-C SD, Dus, 10 Strip @ 10 Kapsul, PT. AFIFARMA)', 'Tablet', 'ASCORBIC ACID', 'POM SD211382731', '93015415', 'AFIFARMA', 'supplement', 0, 0),
(61, 'Vitamin B 1 100', 'Thiamine Mononitrat 100 mg Tablet (AFIFARMA, Dus, 10 Strip @ 10 Tablet)', 'Tablet', 'Thiamine Mononitrate', 'POM SD211534311', '93015452', 'AFIFARMA', 'supplement', 0, 0),
(62, 'VITAFOL', 'Folic Acid 5 mg Tablet Salut Selaput (VITAFOL)', 'Tablet Salut Selaput', 'FOLIC ACID', 'DKL2002507009A1', '93015749', 'DIPA PHARMALAB INTERSAINS', 'supplement', 0, 0),
(63, 'ALIVE BIOCOM-D 1000 IU', 'Cholecalciferol 1000 IU Kapsul Lunak (ALIVE BIOCOM-D 1000 IU, PT. AFIFARMA, STRIP)', 'Kapsul Lunak', 'Colecalciferol', 'POM SD 225013981', '93019262', 'AFIFARMA', 'supplement', 0, 0),
(64, 'ALIVE BIOCOM-D 1000 IU', 'Cholecalciferol 1000 IU Kapsul Lunak (ALIVE BIOCOM-D 1000 IU, BOTOL, PT. AFIFARMA)', 'Kapsul Lunak', 'Colecalciferol', 'POM SD 225013961', '93019263', 'AFIFARMA', 'supplement', 0, 0),
(65, 'ALIVE BIOCOM-C SD', 'Ascorbic Acid 500 mg Tablet (ALIVE BIOCOM-C SD, BOTOL ISI 30 KAPSUL, PT. AFIFARMA)', 'Tablet', 'ASCORBIC ACID', 'POM SD211394401', '93019290', 'AFIFARMA', 'supplement', 0, 0),
(66, 'ALIVE BIOCOM-C SD', 'Ascorbic Acid 500 mg Tablet (ALIVE BIOCOM-C SD, BOTOL ISI 60 KAPSUL, PT. AFIFARMA)', 'Tablet', 'ASCORBIC ACID', 'POM SD211382731', '93019291', 'AFIFARMA', 'supplement', 0, 0),
(67, 'ASAM FOLAT 1 MG', 'Folic Acid 1 mg Tablet (AFIFARMA, BOTOL)', 'Tablet', 'FOLIC ACID', 'POM SD211575371', '93019293', 'AFIFARMA', 'supplement', 0, 0),
(68, 'Asam Folat 1 mg', 'Folic Acid 1 mg Tablet (AFIFARMA, BLISTER)', 'Tablet', 'FOLIC ACID', 'POM SD211534141', '93019294', 'AFIFARMA', 'supplement', 0, 0),
(69, 'Asam Folat 1 mg', 'Folic Acid 1 mg Tablet (AFIFARMA, STRIP)', 'Tablet', 'FOLIC ACID', 'POM SD211571251', '93019295', 'AFIFARMA', 'supplement', 0, 0),
(70, 'Asam Folat 400 mcg', 'Folic Acid 400 mcg Tablet (AFIFARMA)', 'Tablet', 'FOLIC ACID', 'POM SD211571251', '93019296', 'AFIFARMA', 'supplement', 0, 0),
(71, 'VITAMIN B6 25 MG STRIP', 'Pyridoxine HCl 25 mg Tablet (1000, AFIFARMA, DUS ISI 10 STRIP)', 'Tablet', 'Pyridoxine', 'POM SD225028681', '93019299', 'AFIFARMA', 'supplement', 0, 0),
(72, 'Ascorbic Acid 50 mg Tablet (AFIFARMA, STRIP)', 'Ascorbic Acid 50 mg Tablet (AFIFARMA, STRIP)', 'Tablet', 'ASCORBIC ACID', 'POM SD211575381', '93019300', 'AFIFARMA', 'supplement', 0, 0),
(73, 'Vitamin C 50 mg', 'Ascorbic Acid 50 mg Tablet (AFIFARMA, BOTOL)', 'Tablet', 'ASCORBIC ACID', 'POM SD211575391', '93019301', 'AFIFARMA', 'supplement', 0, 0),
(74, 'Citicoline 500 mg Tablet', 'Citicoline 500 mg Tablet (AFIFARMA)', 'Tablet', 'Citicoline', 'POM SD235019361', '93019314', 'AFIFARMA', 'supplement', 0, 0),
(75, 'FOLIC ACID', 'Folic Acid 1 mg Tablet (PHAPROS)', 'Tablet', 'FOLIC ACID', 'GBL8919909210A1', '93020478', 'PHAPROS Tbk', 'supplement', 0, 0),
(76, 'ANEMOLAT', 'Folic Acid 1 mg Tablet (ANEMOLAT)', 'Tablet', 'FOLIC ACID', 'DBL0919927410A1', '93020480', 'PHAPROS Tbk', 'supplement', 0, 0),
(77, 'VITAMIN C PUTIH 50 MG', 'Ascorbic Acid 50 mg Tablet (MARIN LIZA FARMASI)', 'Tablet', 'ASCORBIC ACID', 'SD161548591', '93020826', 'PT MARIN LIZA FARMASI', 'supplement', 0, 0),
(78, 'RAMVIT-C', 'Ascorbic Acid 500 mg Tablet (RAMVIT-C)', 'Tablet', 'ASCORBIC ACID', 'SD201535651', '93020827', 'PT RAMA EMERALD MULTI SUKSES', 'supplement', 0, 0),
(79, 'ASAM FOLAT', 'Folic Acid 1 mg Tablet (NOVAPHARIN)', 'Tablet', 'FOLIC ACID', 'SD181553691', '93020828', 'PT NOVAPHARIN', 'supplement', 0, 0),
(80, 'CAMIVIT D3 1000IU', 'Cholecalciferol 1000 IU Kapsul Lunak (CAMIVIT D3)', 'Kapsul Lunak', 'Colecalciferol', 'SD201305691', '93020869', 'PT LUCAS DJAJA', 'supplement', 0, 0),
(81, 'CITICOLINE 500 MG', 'Citicoline 500 mg Tablet (INFION)', 'Tablet', 'Citicoline', 'POM SD121543261', '93020905', 'BERNOFARM', 'supplement', 0, 0),
(82, 'YES C 500 MG', 'Ascorbic Acid 500 mg Tablet (YES C)', 'Tablet', 'ASCORBIC ACID', 'SD201565211', '93020910', 'BERNOFARM', 'supplement', 0, 0),
(83, 'VITAZINC', 'Ascorbic Acid 500 mg / Zinc Picolinate 10 mg Tablet Hisap (VITAZINC)', 'Tablet Hisap', 'ASCORBIC ACID', 'POM SD201568021', '93021918', 'PT. LLOYD PHARMA INDONESIA', 'supplement', 0, 0),
(84, 'GETVIT C', 'Ascorbic Acid 500 mg Tablet (GETVIT C)', 'Tablet', 'ASCORBIC ACID', 'SD201551011', '93022003', 'MAHAKAM BETA FARMA', 'supplement', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_obt`
--

CREATE TABLE `tb_obt` (
  `kode_obat` varchar(15) NOT NULL,
  `nama_obat` varchar(35) NOT NULL,
  `jenis` varchar(25) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `jumlah` int NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_obt`
--

INSERT INTO `tb_obt` (`kode_obat`, `nama_obat`, `jenis`, `satuan`, `jumlah`, `harga`) VALUES
('OBT-0001', 'Panadol', 'GENERIK', 'TABLET', 200, 6500),
('OBT-0002', 'Bodrex', 'GENERIK', 'TABLET', 167, 5500),
('OBT-0003', 'paramex', 'GENERIK', 'TABLET', 215, 10000),
('OBT-0004', 'ANTALGIN', 'GENERIK', 'TABLET', 180, 12000),
('OBT-0005', 'FLUSTAMOL', 'GENERIK', 'TABLET', 240, 50000),
('OBT-0006', 'AMOXSISILIN', 'GENERIK', 'TABLET', 250, 7500),
('OBT-0007', 'MIRASIK', 'GENERIK', 'TABLET', 147, 6000),
('OBT-0008', 'ALPARA', 'GENERIK', 'TABLET', 447, 5600),
('OBT-0009', 'ALBAENZAZOLE', 'GENERIK', 'TABLET', 300, 12000),
('OBT-0010', 'DANAZOL', 'GENERIK', 'TABLET', 500, 13000),
('OBT-0011', 'CETRIZIN', 'GENERIK', 'TABLET', 115, 18000),
('OBT-0012', 'SEFADROKSIL', 'GENERIK', 'TABLET', 270, 8000),
('OBT-0013', 'METIL PREDNISOLON', 'GENERIK', 'TABLET', 650, 9700),
('OBT-0014', 'AMBROKSOL', 'GENERIK', 'TABLET', 220, 6000),
('OBT-0015', 'AMINOPHILIN', 'GENERIK', 'SPREI', 100, 70000),
('OBT-0016', 'INSULIN', 'GENERIK', 'TABLET', 197, 20000),
('OBT-0017', 'HIDROKORTISON', 'GENERIK', 'TABLET', 100, 30000),
('OBT-0018', 'BETAMETASON', 'GENERIK', 'TABLET', 200, 50000),
('OBT-0019', 'OKSITOSIN', 'GENERIK', 'TABLET', 150, 15000),
('OBT-0020', 'NEOSTIGMIN', 'GENERIK', 'TABLET', 200, 25000),
('OBT-0021', 'BISAKODIL', 'GENERIK', 'TABLET', 500, 30000),
('OBT-0022', 'DOMPERIDON', 'GENERIK', 'TABLET', 100, 20000),
('OBT-0023', 'TERAZOSIN', 'GENERIK', 'TABLET', 200, 15000),
('OBT-0024', 'DIGOKSIN', 'GENERIK', 'TABLET', 300, 20000),
('OBT-0025', 'SINVASTATIN', 'GENERIK', 'TABLET', 100, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id` int NOT NULL,
  `order_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id`, `order_id`) VALUES
(1, 'ORDER-1720277804');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `kode_pasien` varchar(15) NOT NULL,
  `nama_pasien` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `pekerjaan` varchar(35) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`kode_pasien`, `nama_pasien`, `tanggal_lahir`, `jenis_kelamin`, `pekerjaan`, `alamat`, `telpon`, `email`) VALUES
('PSN0001', 'Erwin', '2002-03-05', 'Laki-Laki', 'Web Developer', 'Makassar', '081354546330', 'erwin@handayani.ac.id'),
('PSN0002', 'Fitriani', '2001-07-06', 'Perempuan', 'Mahasiswa', 'Makassar', '081256457767', 'fitriani89@gmail.com'),
('PSN0003', 'Muh Supri', '2001-01-10', 'Laki-Laki', 'Web Developer', 'Bone', '081567542232', 'supryasiz@gmail.com'),
('PSN0004', 'Cancuji', '2000-04-17', 'Laki Laki', 'Jepot', 'Petani', '081354546330', 'cancu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `kode_pegawai` varchar(15) NOT NULL,
  `nama_pegawai` varchar(35) NOT NULL,
  `nama_bagian` varchar(15) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telpon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`kode_pegawai`, `nama_pegawai`, `nama_bagian`, `tanggal_lahir`, `alamat`, `telpon`) VALUES
('PGW0001', 'Yahya Hamida', 'Apotik', '1988-09-13', 'Jl. Rambutan, No.5', '081276374849'),
('PGW0002', 'Halim Kusuma', 'Tata Usaha', '1990-05-12', 'Pekanbaru', '082388992119');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekmed`
--

CREATE TABLE `tb_rekmed` (
  `no_rekmed` varchar(15) NOT NULL,
  `kode_pasien` varchar(15) NOT NULL,
  `id_unitmedis` varchar(15) NOT NULL,
  `diagnosa` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rekmed`
--

INSERT INTO `tb_rekmed` (`no_rekmed`, `kode_pasien`, `id_unitmedis`, `diagnosa`, `keterangan`, `tanggal`) VALUES
('RM-0001', 'PSN0001', 'DOK0001', 'Demam', 'Istirahat Dibutuhkan', '2024-05-05'),
('RM-0002', 'PSN0002', 'DOK0001', 'Joli Joli', 'Obat Dibutuhakan', '2024-05-03'),
('RM-0003', 'PSN0003', 'DOK0002', 'Mekke', 'Stop ngoding dulu bang', '2024-07-16'),
('RM-0004', 'PSN0004', 'DOK0001', 'Kalasi', 'Kurangi Kuttunya', '2024-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_resep`
--

CREATE TABLE `tb_resep` (
  `id` int NOT NULL,
  `no_resep` varchar(255) NOT NULL,
  `no_rekmed` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_resep`
--

INSERT INTO `tb_resep` (`id`, `no_resep`, `no_rekmed`, `tanggal`) VALUES
(1, 'RSP-0001', 'RM-0001', '2024-07-22'),
(2, 'RSP-0002', 'RM-0001', '2024-07-22'),
(3, 'RSP-0001', 'RM-0004', '2024-07-22'),
(4, 'RSP-0003', 'RM-0003', '2024-07-22'),
(5, 'RSP-0001', 'RM-0003', '2024-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_resep_detail`
--

CREATE TABLE `tb_resep_detail` (
  `id` int NOT NULL,
  `no_resep` varchar(255) NOT NULL,
  `kode_obat` varchar(255) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `jumlah` int NOT NULL,
  `aturan_pakai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_resep_detail`
--

INSERT INTO `tb_resep_detail` (`id`, `no_resep`, `kode_obat`, `nama_obat`, `jumlah`, `aturan_pakai`) VALUES
(1, 'RSP-0001', '93001850', 'Ampicillin Trihydrate 500 mg Tablet (HOLI PHARMA)', 3, '2 x Tahun'),
(2, 'RSP-0002', '93003775', 'Vaksin COVID-19, Inactivated 3 ug/0,5 mL (10)', 5, '2 x Tahun'),
(3, 'RSP-0003', '93002593', 'Retinol Palmitate 200.000 IU Kapsul Lunak (LUCAS DJAJA)', 10, '3 x Sehari');

-- --------------------------------------------------------

--
-- Table structure for table `tb_unitmedis`
--

CREATE TABLE `tb_unitmedis` (
  `id_unitmedis` varchar(15) NOT NULL,
  `nama_unitmedis` varchar(35) NOT NULL,
  `spesialis` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telpon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_unitmedis`
--

INSERT INTO `tb_unitmedis` (`id_unitmedis`, `nama_unitmedis`, `spesialis`, `alamat`, `telpon`) VALUES
('DOK0001', 'Farhat Abbass', 'Dokter Kulit dan Kelamin', 'Jl. Tamrin Bertumpuk, No. 007', '081276374849'),
('DOK0002', 'Ballloga', 'Dokter Gigi dan Mulut', 'Sinjai', '081354546330');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_keluar`
--
ALTER TABLE `tb_keluar`
  ADD PRIMARY KEY (`no_keluar`);

--
-- Indexes for table `tb_keluar_detail`
--
ALTER TABLE `tb_keluar_detail`
  ADD PRIMARY KEY (`auto`);

--
-- Indexes for table `tb_kunjungan`
--
ALTER TABLE `tb_kunjungan`
  ADD PRIMARY KEY (`no_reg`);

--
-- Indexes for table `tb_kwitansi`
--
ALTER TABLE `tb_kwitansi`
  ADD PRIMARY KEY (`id_kwitansi`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`kode_pasien`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`kode_pegawai`);

--
-- Indexes for table `tb_rekmed`
--
ALTER TABLE `tb_rekmed`
  ADD PRIMARY KEY (`no_rekmed`);

--
-- Indexes for table `tb_resep`
--
ALTER TABLE `tb_resep`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_resep_detail`
--
ALTER TABLE `tb_resep_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_unitmedis`
--
ALTER TABLE `tb_unitmedis`
  ADD PRIMARY KEY (`id_unitmedis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kwitansi`
--
ALTER TABLE `tb_kwitansi`
  MODIFY `id_kwitansi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_resep`
--
ALTER TABLE `tb_resep`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_resep_detail`
--
ALTER TABLE `tb_resep_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
