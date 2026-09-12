Sistem Manajemen Produk

Aplikasi web sederhana untuk mengelola data produk beserta variasi warna dan ukuran menggunakan CodeIgniter 3.

Fitur
List Produk
Tambah Produk
Detail Produk
Edit Produk
Hapus Produk
Tambah/Edit Warna
Tambah/Edit Ukuran dan Stok

Teknologi
PHP 8
CodeIgniter 3
MySQL
Bootstrap 5
JavaScript

Cara Menjalankan
Clone atau download repository.
Import database/schema.sql ke MySQL/phpMyAdmin.
Atur koneksi database di application/config/database.php.
Atur base_url di application/config/config.php.
Jalankan Apache dan MySQL.
Buka project melalui browser.

Struktur Data
products — data produk
product_colors — variasi warna produk
product_sizes — ukuran dan stok produk

Relasi: Satu produk dapat memiliki banyak warna, dan satu warna dapat memiliki banyak ukuran.