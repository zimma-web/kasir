# Aplikasi Kasir (Point of Sale System)

Aplikasi Kasir adalah sistem point of sale (POS) berbasis web yang dibangun menggunakan Laravel framework. Sistem ini memungkinkan pengelolaan penjualan, inventori, dan pelanggan secara efisien.

## Fitur Utama

- 🔐 Multi-level User Authentication (Admin & Petugas)
  - Login dengan username/email
  - Password dengan fitur show/hide
- 📦 Manajemen Produk
  - Tambah, edit, hapus produk
  - Upload gambar produk
  - Tracking stok
- 👥 Manajemen Pelanggan
- 🛒 Sistem Keranjang & Checkout
- 💰 Manajemen Penjualan
  - Pencatatan transaksi
  - Riwayat penjualan
  - Export laporan penjualan
- 📊 Dashboard dengan ringkasan bisnis
- 👤 Manajemen Profil Pengguna

## Teknologi

- Laravel 10.x
- PHP 8.1+
- MySQL/MariaDB
- Tailwind CSS
- JavaScript/jQuery
- Vite (Build tool)

## Persyaratan Sistem

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Web Server (Apache/Nginx)
- Extension PHP yang dibutuhkan:
  - BCMath
  - Ctype
  - JSON
  - Mbstring
  - OpenSSL
  - PDO
  - Tokenizer
  - XML

## Instalasi

1. Clone repository
   ```bash
   git clone https://github.com/zimma-web/kasir-aplikasi.git
   cd kasir-aplikasi
   ```

2. Install dependensi PHP
   ```bash
   composer install
   ```

3. Install dependensi Node.js
   ```bash
   npm install
   ```

4. Salin file environment
   ```bash
   cp .env.example .env
   ```

5. Generate application key
   ```bash
   php artisan key:generate
   ```

6. Konfigurasi database di file .env
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=zimam_kasir
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Jalankan migrasi dan seeder
   ```bash
   php artisan migrate --seed
   ```

8. Build assets
   ```bash
   npm run build
   ```

9. Jalankan aplikasi
   ```bash
   php artisan serve
   ```

10. Akses aplikasi di browser
    ```
    http://localhost:8000
    ```

## Akun Default

```
Admin:
Email: admin@gmail.com
Password: admin

Petugas:
Email: kasir@gmail.com
Password: 
```

## Struktur Database

- users - Menyimpan data pengguna
- produk - Katalog produk
- pelanggan - Data pelanggan
- penjualan - Transaksi penjualan
- detail_penjualan - Detail item yang dijual

## Lisensi

[MIT License](LICENSE.md)

## Kontribusi

Silakan buat issue atau pull request untuk kontribusi.

## Support

Jika Anda menemukan bug atau memiliki saran, silakan buat issue di repository ini.
