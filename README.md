# Rekam Medis Puskesmas Kododewata

## Deskripsi
Aplikasi ini dirancang untuk memudahkan Puskesmas Kododewata dalam mengelola rekam medis pasien. Dengan fitur-fitur yang intuitif dan efisien, aplikasi ini membantu staf kesehatan dalam mencatat, mengakses, dan mengelola informasi rekam medis secara digital. Pengguna dapat dengan mudah melakukan pencarian data, memperbarui informasi, dan mengelola transaksi terkait pelayanan kesehatan.

## Fitur

### 1. Halaman Utama
Halaman utama memberikan gambaran umum tentang aplikasi. Di sini, pengguna dapat menemukan informasi penting dan navigasi ke bagian lain dari aplikasi.

- **Deskripsi Singkat**: Menjelaskan tujuan aplikasi.
- **Navigasi**: Tautan ke halaman login dan informasi lebih lanjut.

![Screenshot 2024-08-02 125742](https://github.com/user-attachments/assets/a923eda2-3a0c-4d69-8d26-11fdbb187490)

### 2. Halaman Login
Halaman login memungkinkan pengguna untuk masuk ke akun mereka.

- **Formulir Login**:
  - **Email**: Kolom untuk memasukkan alamat email.
  - **Kata Sandi**: Kolom untuk memasukkan kata sandi.
  - **Tombol Login**: Untuk mengautentikasi pengguna.
- **Tautan Pendaftaran**: Arahkan pengguna ke halaman pendaftaran jika mereka belum memiliki akun.

![Screenshot 2024-08-02 125806](https://github.com/user-attachments/assets/538e27cd-1240-434a-822d-fae2288e858f)

### 3. Dashboard
Setelah berhasil login, pengguna akan diarahkan ke dashboard mereka.

- **Ringkasan Rekam Medis**: Menampilkan total rekam medis, statistik pasien, dan aktivitas terkini.
- **Grafik**: Visualisasi data rekam medis dalam bentuk grafik.
- **Navigasi**: Tautan ke halaman transaksi dan pengaturan akun.

![Screenshot 2024-08-02 125707](https://github.com/user-attachments/assets/e8232e46-4024-44b3-b6fa-86a4e5e92ce2)

### 4. Kartu Medis
Kartu Medis berfungsi sebagai catatan terintegrasi yang menyimpan informasi penting mengenai setiap pasien. Melalui Kartu Medis, staf kesehatan dapat dengan mudah mengakses riwayat medis, diagnosa, pengobatan, dan kunjungan pasien sebelumnya.

![Screenshot 2024-08-02 131129](https://github.com/user-attachments/assets/98034e9f-1022-4a92-9090-9fafe1f7c5aa)

### 5. Halaman Transaksi
Halaman transaksi memungkinkan pengguna untuk melihat dan mengelola transaksi yang terkait dengan pelayanan kesehatan.

- **Daftar Transaksi**: Tabel yang menampilkan semua transaksi dengan informasi seperti tanggal, deskripsi, jumlah, dan kategori.
- **Tambah Transaksi**: Formulir untuk menambahkan transaksi baru.
- **Edit dan Hapus**: Opsi untuk mengedit atau menghapus transaksi yang sudah ada.

![Screenshot 2024-08-02 131356](https://github.com/user-attachments/assets/21a90923-beeb-47d5-8786-c06a006459bd)

### 6. Laporan
Laporan memberikan ringkasan dan analisis data rekam medis dan transaksi. Pengguna dapat menghasilkan laporan berdasarkan kriteria tertentu, seperti periode waktu, jenis pelayanan, dan statistik pasien. Hal ini membantu Puskesmas Kododewata dalam melakukan evaluasi kinerja dan perencanaan strategi pelayanan kesehatan yang lebih baik.

![Screenshot 2024-08-02 131859](https://github.com/user-attachments/assets/40249223-6f87-4ccc-a630-942fccf1439e)

## Teknologi yang Digunakan
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Autentikasi**: JWT (JSON Web Tokens)
  

## Instalasi

1. Clone repositori ini:
   ```bash
   git clone https://github.com/w1nnn/medical-record.git
2. Import Database:
   ```bash
   mysql -u <username> -p <database-name> < /path/to/file.sql
3. Jalankan Server:
 ```bash
 php -S localhost:8000


