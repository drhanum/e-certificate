# e-Certificate

Repository untuk proyek aplikasi e-certificate, dalam rangka pemenuhan tugas akhir mata kuliah Rekayasa Perangkat Lunak.

Disusun oleh:
1. Dwi Riani Hanum - 20255520020
2. Felix Valentino - 20255520001
3. Nicholas Clementius S - 20255520002
4. Naomi Najla M R - 20255520012

## Project Links

- **Laporan**: https://docs.google.com/document/d/1h0ZPJFs6blaNEx9Sn9F17gT5nqoEOgb7i1js6EwaSJ0/edit?usp=sharing
- **PPT**: https://www.canva.com/design/DAHNTuUcuhU/ErI1dx-ntoFdQOSpdEz5AA/view
- **Protoyype (Figma)**: https://www.figma.com/proto/vkbV47peCnZ7cAHiyfpLoK/Untitled?node-id=111-3&p=f=t=1dzewTO6aiBqZVTq-1&scaling=scale-down-width&content-scaling=fixed&page-id=111%3A2&starting-point-node-id=111%3A3
- **Video Demo & Presentasi**: https://drive.google.com/file/d/16JvF3b8FGqNLu_ARZ8qRnT-70LwVXWov/view?usp=drivesdk

## Running the Project Locally

Ikuti langkah ini untuk menjalankan aplikasi di laptop:

1. Clone repository atau download ZIP, lalu masuk ke folder proyek:

```bash
git clone https://github.com/drhanum/e-certificate
cd e-certificate
```

Jika kamu menggunakan ZIP, cukup ekstrak file dan buka folder `e-certificate`.

2. Salin file lingkungan:

```bash
copy .env.example .env
```

2. Install dependency PHP dan Node:

```bash
composer install
npm install
```

3. Buat file database SQLite:

```bash
type nul > database\database.sqlite
```

4. Generate application key:

```bash
php artisan key:generate
```

5. Jalankan migrasi database:

```bash
php artisan migrate
```

6. Buat storage symlink untuk file upload:

```bash
php artisan storage:link
```

7. Build asset front-end:

```bash
npm run build
```

8. Jalankan server aplikasi:

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

9. Buka di browser:

```text
http://127.0.0.1:8000
```

> Catatan:
> - Jika menggunakan Laragon, pastikan PHP, Composer, Node.js, dan npm sudah terpasang.
> - Bila ingin menggunakan MySQL, ubah pengaturan `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di `.env` lalu buat database sebelum migrasi.
