# 🏥 Portal Kredensial RSUD dr. Mohamad Soewandhie

Portal digital untuk manajemen kredensial dan asesmen kompetensi perawat di RSUD dr. Mohamad Soewandhie Surabaya. Sistem ini mencakup pengisian formulir asesi (APL-01), asesmen mandiri, hingga penilaian oleh asesor.

## 🚀 Fitur Utama
- **Dashboard Asesi**: Pantau status pengajuan dan riwayat kredensial.
- **Formulir Digital (7 Step)**: Pengisian data pribadi, kompetensi (Form 1), pelatihan, IKI, hingga inform consent.
- **Auto-fill Data**: Sinkronisasi data otomatis antar step untuk mempercepat pengisian.
- **Tabel Interaktif**: Input data pelatihan dan riwayat IKI secara dinamis.
- **Penilaian Asesor**: Interface khusus asesor untuk memverifikasi unit kompetensi.
- **Export Excel**: Menghasilkan file `.xlsx` sesuai format standar rumah sakit.

---

## 🛠️ Persiapan Lingkungan
Sebelum menginstal, pastikan Anda sudah menginstal:
- **PHP** (v8.1 atau lebih baru)
- **Composer** (Dependency Manager untuk PHP)
- **SQLite** (Driver default database)

---

## 📦 Langkah Instalasi

1. **Salin Project**
   Buka folder project di terminal atau CMD.

2. **Instal Dependencies**
   Jalankan perintah berikut untuk mengunduh library yang dibutuhkan:
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   *Jika di Windows CMD:* `copy .env.example .env`

4. **Generate App Key**
   Buat kunci keamanan aplikasi:
   ```bash
   php artisan key:generate
   ```

5. **Migrasi Database**
   Buat tabel-tabel yang diperlukan (pastikan file `database/database.sqlite` sudah ada, atau buat file kosong dengan nama tersebut):
   ```bash
   php artisan migrate
   ```

---

## 🖥️ Cara Menjalankan

1. **Jalankan Server Lokal**
   ```bash
   php artisan serve
   ```
2. **Akses Aplikasi**
   Buka browser dan buka alamat: `http://127.0.0.1:8000`

---

## 👤 Akun Default (Opsional)
Anda bisa membuat user melalui halaman **Register** di aplikasi. Secara default, user yang mendaftar akan memiliki role `user` (Asesi). Untuk menjadi `admin`, Anda perlu mengubah role di tabel `users` secara manual atau melalui seeder.

---

## 📁 Struktur File Penting
- `resources/views/index.blade.php`: Halaman utama formulir asesi.
- `resources/views/dashboard.blade.php`: Dashboard untuk asesi.
- `app/Http/Controllers/KredensialController.php`: Logika utama pengajuan & export Excel.
- `storage/app/templates/`: Tempat menyimpan template Excel `.xlsx`.

---
*Dikembangkan dengan ❤️ untuk RSUD dr. Mohamad Soewandhie Surabaya.*