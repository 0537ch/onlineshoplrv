# Laravel E-Commerce Application

Aplikasi E-Commerce berbasis Laravel 11 dengan fitur lengkap untuk pengelolaan toko online. Dilengkapi dengan panel admin menggunakan Filament dan sistem tracking pesanan untuk pelanggan.

## Fitur Utama

### Customer Side
- Autentikasi pengguna dengan Laravel Breeze
- Katalog produk dengan pencarian dan filter
- Keranjang belanja
- Checkout pesanan
- Tracking status pesanan
- Riwayat pesanan

### Admin Panel (Filament)
- Dashboard admin
- Manajemen produk
- Manajemen pesanan dengan status tracking
- Manajemen pengguna
- Role dan permission management

## Teknologi

- PHP 8.2.22
- Laravel 11.33.2
- MySQL
- Tailwind CSS
- Alpine.js
- Laravel Breeze
- Filament Admin Panel
- Spatie Laravel Permission

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

## Instalasi

1. Clone repository
```bash
git clone https://github.com/username/onlineshop.git
cd onlineshop
```

2. Install dependencies
```bash
composer install
npm install
```

3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Konfigurasi database di file .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=onlineshop
DB_USERNAME=root
DB_PASSWORD=
```

5. Migrate dan seed database
```bash
php artisan migrate --seed
```

6. Compile assets
```bash
npm run dev
```

7. Jalankan aplikasi
```bash
php artisan serve
```

## Struktur Role

1. Admin
   - Akses penuh ke panel admin
   - Manajemen produk dan pesanan
   - Manajemen pengguna

2. Customer
   - Melihat katalog produk
   - Melakukan pembelian
   - Tracking pesanan
   - Melihat riwayat pesanan

## Alur Pesanan

1. Menunggu Pembayaran (PENDING)
2. Pesanan Diproses (PROCESSING)
3. Dalam Pengiriman (SHIPPED)
4. Pesanan Diterima (DELIVERED)
5. Dibatalkan (CANCELLED)

## Akun Default

### Admin
- Email: admin@example.com
- Password: password

### Customer
- Email: customer@example.com
- Password: password

## Pengembangan

Aplikasi ini dikembangkan menggunakan:
- Laravel 11 sebagai framework backend
- Tailwind CSS untuk styling
- Alpine.js untuk interaktivitas frontend
- Filament untuk panel admin
- Spatie Laravel Permission untuk manajemen role

## Lisensi

[MIT License](LICENSE.md)

## Kontribusi

Silakan buat pull request untuk kontribusi.

## Kontak

Jika ada pertanyaan, silakan hubungi [email Anda].
