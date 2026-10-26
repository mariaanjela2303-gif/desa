# Website Informasi Desa Tautpah

**Lokasi:** Desa Tautpah, Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara, Nusa Tenggara Timur (NTT)  
**Versi:** 1.0  
**Framework & Teknologi:** Laravel, PHP 8.3, Blade, Bootstrap 5, SQLite / MySQL  
**Lingkungan Pengembangan:** Laravel Herd / Local Server  

---

## 1. Tentang Aplikasi

Website Informasi Resmi Desa Tautpah dibangun sebagai media informasi publik, transparansi pembangunan desa, dan sarana publikasi kegiatan kemasyarakatan. Website ini dirancang modern dan responsif menggunakan skema warna hijau dan putih khas pemerintahan desa yang bersih dan bersahabat.

### Hak Akses Pengguna:
1. **Masyarakat / Pengunjung (Publik - Tanpa Login)**:
   - Melihat Beranda, profil desa, sejarah, serta visi & misi.
   - Melihat struktur pemerintahan & perangkat desa.
   - Membaca berita dan pengumuman dengan pencarian kata kunci dan filter kategori.
   - Melihat galeri dokumentasi foto kegiatan dan tautan video resmi.
   - Melihat alamat kantor desa, jam pelayanan, kontak, dan peta interaktif (Google Maps embed).
2. **Administrator Desa (Admin)**:
   - Login menggunakan username atau email.
   - Dashboard statistik dan ringkasan konten.
   - CRUD Berita dan Pengumuman (kategori, status draft/terbit, gambar sampul).
   - CRUD Kategori Berita.
   - CRUD Galeri (unggah foto kegiatan & sematan video YouTube).
   - Pengelolaan Profil Desa, Sejarah Resmi, Visi, Misi, dan Sambutan Kepala Desa.
   - Pengelolaan Struktur Organisasi dan Aparatur Perangkat Desa.
   - Pengelolaan Alamat, Jam Kerja Pelayanan, Telepon, Email, dan Peta Google Maps.
   - Audit Trail: Riwayat aktivitas dan log perubahan data oleh admin.
3. **Kepala Desa (Pemantauan / Read-Only)**:
   - Login dengan akun khusus kepala desa.
   - Panel monitoring eksekutif: melihat jumlah konten, total galeri, dan total kunjungan website.
   - Melihat daftar seluruh konten yang dipublikasikan (Read-Only).
   - Melihat dokumentasi foto dan video yang ditampilkan (Read-Only).
   - Memantau riwayat aktivitas admin (Audit Trail).
   - Melihat statistik kunjungan halaman website (Page Views sederhana).
   - *Catatan:* Kepala desa tidak memiliki akses mengubah atau menghapus data sesuai PRD Versi 1.0.

---

## 2. Kredensial Akun Awal (Pengujian)

Akun dibuat langsung melalui seeder database:

| Peran | Username | Email | Password | Hak Akses |
|---|---|---|---|---|
| **Admin Desa** | `admin` | `admin@tautpah.desa.id` | `admin123` | Kelola Konten Lengkap (CRUD) |
| **Kepala Desa** | `kades` | `kades@tautpah.desa.id` | `kades123` | Monitoring & Pemantauan (Read-Only) |

---

## 3. Persyaratan Sistem

- PHP >= 8.2 (dengan ekstensi `pdo`, `mbstring`, `openssl`, `fileinfo`, `gd`, `zip`)
- Composer >= 2.0
- MySQL >= 8.0 atau SQLite 3
- Laravel Herd atau web server lokal (Apache/Nginx/XAMPP)

---

## 4. Panduan Menjalankan Aplikasi di Lokal

### Opsi A: Menggunakan Laravel Herd
Jika Anda menggunakan **Laravel Herd**:
1. Proyek ini telah ditautkan di direktori `C:\Users\<User>\Herd\desa`.
2. Buka browser dan akses:
   ```
   http://desa.test
   ```

### Opsi B: Menggunakan Terminal / `php artisan serve`
1. Buka terminal pada folder proyek:
   ```bash
   cd desa
   ```
2. Jalankan server lokal Laravel:
   ```bash
   php artisan serve
   ```
3. Buka browser pada alamat:
   ```
   http://127.0.0.1:8000
   ```

---

## 5. Konfigurasi Database

Secara default, aplikasi menggunakan database **SQLite** (`database/database.sqlite`) sehingga langsung dapat berjalan tanpa setup server database terpisah.

Jika ingin beralih ke **MySQL** (misalnya melalui XAMPP atau MySQL server lokal):
1. Buat database baru di MySQL, misalnya `db_desa_tautpah`.
2. Buka file `.env`, sesuaikan baris berikut:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_desa_tautpah
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate:fresh --seed
   ```
4. Pastikan symlink storage terhubung:
   ```bash
   php artisan storage:link
   ```

---

## 6. Panduan Mengganti Data Contoh ([DATA CONTOH])

Untuk membedakan data pengujian dengan data resmi, data awal diberi penanda `[DATA CONTOH]`:
1. Login ke panel Admin di `/login` dengan akun admin (`admin` / `admin123`).
2. Masuk ke menu **Profil, Sejarah & Visi Misi** untuk memperbarui naskah sejarah resmi dan sambutan Kepala Desa yang telah diverifikasi.
3. Masuk ke menu **Struktur Pemerintahan** untuk memperbarui nama-nama aparatur desa dan mengunggah foto formal perangkat desa.
4. Masuk ke menu **Kontak & Peta Kantor** untuk memperbarui nomor telepon resmi dan menyematkan link embed Google Maps kantor desa.
5. Masuk ke menu **Berita & Pengumuman** untuk menerbitkan berita dan pengumuman resmi terbaru.

---

## 7. Menjalankan Pengujian Otomatis (Testing)

Aplikasi dilengkapi dengan rangkaian automated feature tests untuk menguji seluruh halaman publik, otentikasi peran (Admin vs Kepala Desa), pembatasan akses middleware, dan pencatatan aktivitas:

```bash
php artisan test
```

---

## 8. Hak Cipta & Lisensi

Dibuat untuk Pemerintah Desa Tautpah, Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara, Nusa Tenggara Timur.
Lisensi kode terbuka di bawah [MIT License](LICENSE).
