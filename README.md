# 💰 UangKM - Aplikasi Manajemen Keuangan UMKM

**UangKM** adalah aplikasi web berbasis PHP + MySQL yang dirancang untuk membantu UMKM (Usaha Mikro Kecil Menengah) dalam mengelola keuangan secara sederhana namun efisien. Aplikasi ini mendukung pencatatan pemasukan, pengeluaran, utang-piutang, serta menyediakan laporan yang bisa diekspor ke PDF/Excel.

---

## 🚀 Fitur Utama

- ✅ **Login Sistem** & Ganti Password
- 📂 **Manajemen Kategori Transaksi**
- 💳 **Input Transaksi Pemasukan & Pengeluaran**
- 🔁 **Manajemen Hutang dan Piutang**
- 📊 **Laporan Rincian per Rekening**
- 🏦 **Daftar Rekening Bank dan Saldo**
- 👥 **Manajemen Pengguna (Admin Only)**
- 📈 **Laporan Keuangan Lengkap (Export PDF/Excel)**

---

## 🔐 Login Default

Gunakan akun berikut untuk login pertama kali ke aplikasi:
```
Username: admin
Password: admin123
```
> ⚠️ Sangat disarankan untuk segera mengganti password setelah login pertama.

---

## ⚙️ Requirements

Sebelum menjalankan aplikasi **UangKM**, pastikan sistem kamu memiliki:

- PHP 7.0 atau lebih tinggi
- MySQL atau MariaDB
- Apache (disarankan menggunakan XAMPP/Laragon)
- Composer (jika menggunakan dependensi tambahan)
- Web browser modern (Chrome/Firefox)

---

## 🛠️ Cara Install

1. **Clone repositori:**

   ```bash
   git clone https://github.com/OMANIAOZANIA/uangkm.git
   ```
   
3. **Pindahkan ke direktori XAMPP:**

   Contoh:
   ```bash
   C:\xampp\htdocs\uangkm
   ```
   
4. **Import database:**

   - Buka `phpMyAdmin`
   - Buat database baru dengan nama `uangkm`
   - Import file `data_keuangan.sql` dari folder `database`

5. **Konfigurasi database:**

   Buka file `koneksi.php` (terletak di folder `config`), sesuaikan jika perlu:
   ```php
   $host = "localhost";
   $user = "root";
   $password = "";
   $database = "data_keuangan"; // Ubah dengan nama database kamu di phpMyAdmin
   ```
   
6. **Jalankan aplikasi di browser:**

   ```
   http://localhost/uangkm
   ```
   
---

## 📖 Manual Book

Panduan lengkap penggunaan aplikasi tersedia pada file:

📄 [`manual-book.pdf`](https://drive.google.com/file/d/1ghZMXltIMj3xvCzSvhnV3luzlV1Qtttw/view?usp=drivesdk)

Isi meliputi:
- Panduan login
- Manajemen kategori & transaksi
- Pengelolaan hutang/piutang
- Rincian per rekening
- Laporan keuangan
- Manajemen pengguna (admin)

---

## 🤝 Kontribusi

Kontribusi sangat terbuka! Kamu bisa:

- Fork repositori ini
- Lakukan perubahan/penambahan fitur
- Buat pull request

Pastikan:
- Kode bersih dan terstruktur
- Perubahan tidak merusak fitur utama
- Sertakan penjelasan yang jelas di PR

Jika menemukan bug, silakan buat [issue](https://github.com/OMANIAOZANIA/uangkm/issues).

---

© 2025 Kelompok 4 - UangKM Project<br/>
Dikembangkan oleh OmaniaOzania Group<br/>
Powered by ChillZone
