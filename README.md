# 📋 Aplikasi Antrian Sederhana
Aplikasi ini adalah sistem antrian sederhana yang memungkinkan pengguna mengambil nomor antrian, dan admin untuk melihat serta mengelola antrian. Dibangun menggunakan Laravel 12.

## 🚀 Fitur

1. Login untuk admin
2. Pengambilan nomor antrian
3. Dashboard admin untuk melihat antrian
4. Tampilan live info antrian di halaman utama

## 🛠️ Instalasi

1. Clone repositori:

```bash
git clone https://github.com/iamelse/sistem-antrian-sederhana.git
cd sistem-antrian-sederhana
```

2. Instal dependensi:

```bash
composer install
npm install && npm run dev
```

3. Konfigurasi environment:

```bash
cp .env.example .env
php artisan key:generate
```

4. Migrasi dan seed database:

```bash
php artisan migrate
```

5. Jalankan server:

```bash
php artisan serve
```

## 🔐 Login

Gunakan kredensial berikut untuk login sebagai admin:

    Email: test@example.com
    Password: password

## 🌐 Route Aplikasi

```bash
Method	          Endpoint	      Deskripsi
GET/POST	  /auth/login	      Form login dan autentikasi admin
GET	          /admin/dashboard    Halaman dashboard admin
GET	          /admin/queue	      Halaman untuk melihat dan mengelola antrian
GET	          /queue/take	      Ambil nomor antrian baru
GET	          /	              Tampilan live info antrian untuk umum
```

## 🗂️ Desain Database

Gambaran visual skema database dapat dilihat pada file schema.png yang disertakan di dalam proyek ini.

### Alasan Desain

* Sederhana & scalable: hanya menyimpan data penting dan mudah dikembangkan.
* Audit trail (queue_logs): mencatat semua aksi admin terhadap antrian.
* Field status: memberi fleksibilitas dalam mengatur berbagai kondisi antrian.

## 📝 Lisensi

Proyek ini menggunakan [MIT license](https://opensource.org/licenses/MIT).
