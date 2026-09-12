# Sistem Manajemen Produk Sederhana

Aplikasi web sederhana untuk mengelola data produk beserta variasi
warna dan ukurannya, dibangun dengan CodeIgniter 3.

## Fitur
- List Produk
- Tambah Produk
- Detail Produk
- Edit Produk
- Hapus Produk
- Tambah/Edit Warna & Ukuran

## Teknologi
- PHP 8
- CodeIgniter 3
- MySQL
- Bootstrap 5
- JavaScript

## Cara Menjalankan
1. Salin project ke folder `htdocs` (XAMPP) atau `www` (Laragon).
2. Import `database/schema.sql` ke MySQL/phpMyAdmin.
3. Atur koneksi database di `application/config/database.php`.
4. Atur `$config['base_url']` di `application/config/config.php`.
5. Jalankan Apache & MySQL, lalu buka di browser:
   `http://localhost/nama-folder-project/`

## Struktur Data
- `products` — data produk (kode, nama, kategori, harga, status)
- `product_colors` — warna, terhubung ke produk
- `product_sizes` — ukuran & stok, terhubung ke warna

Satu produk bisa punya banyak warna, satu warna bisa punya banyak ukuran.
