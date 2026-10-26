<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\Article;
use App\Models\Category;
use App\Models\ContactSetting;
use App\Models\Gallery;
use App\Models\Official;
use App\Models\User;
use App\Models\VillageProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Pengguna Default (Admin dan Kepala Desa)
        $admin = User::create([
            'name' => 'Administrator Desa',
            'username' => 'admin',
            'email' => 'admin@tautpah.desa.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        $kades = User::create([
            'name' => 'Kepala Desa Tautpah',
            'username' => 'kades',
            'email' => 'kades@tautpah.desa.id',
            'password' => Hash::make('kades123'),
            'role' => 'kepala_desa',
        ]);

        // 2. Kategori Berita & Pengumuman
        $katPemerintahan = Category::create(['name' => 'Pemerintahan', 'slug' => 'pemerintahan']);
        $katPembangunan = Category::create(['name' => 'Pembangunan Desa', 'slug' => 'pembangunan-desa']);
        $katSosial = Category::create(['name' => 'Kemasyarakatan & Budaya', 'slug' => 'kemasyarakatan-budaya']);
        $katPengumuman = Category::create(['name' => 'Pengumuman Resmi', 'slug' => 'pengumuman-resmi']);

        // 3. Profil Desa Tautpah
        VillageProfile::create([
            'village_name' => 'Desa Tautpah',
            'district' => 'Biboki Selatan',
            'regency' => 'Timor Tengah Utara',
            'province' => 'Nusa Tenggara Timur',
            'about' => '[DATA CONTOH] Desa Tautpah berlokasi di Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara, Provinsi Nusa Tenggara Timur. Website ini merupakan sarana komunikasi resmi dan pusat keterbukaan informasi publik bagi seluruh warga serta pemangku kepentingan.',
            'history' => "[DATA CONTOH - Menunggu penetapan naskah resmi]\n\nDesa Tautpah memiliki sejarah dan kebudayaan yang mengakar kuat pada kearifan lokal masyarakat Timor Tengah Utara. Informasi sejarah lengkap desa akan diperbarui secara resmi melalui dokumen monografi desa oleh pemerintah desa.",
            'vision' => 'Terwujudnya Desa Tautpah yang Maju, Mandiri, Sejahtera, dan Berbudaya dengan Semangat Gotong Royong.',
            'mission' => "1. Mewujudkan tata kelola pemerintahan desa yang bersih, transparan, akuntabel, dan responsif terhadap kebutuhan masyarakat.\n2. Meningkatkan pembangunan infrastruktur dasar desa dan fasilitas umum yang berkualitas.\n3. Mengembangkan potensi ekonomi desa melalui sektor pertanian, peternakan, dan usaha mikro lokal.\n4. Memperkuat kerukunan warga, pelestarian adat istiadat, dan nilai-nilai kearifan lokal Biboki Selatan.",
            'leader_name' => '[DATA CONTOH] Kepala Desa Tautpah',
            'welcome_message' => 'Salam damai dan sejahtera untuk seluruh masyarakat Desa Tautpah serta pengunjung sekalian. Selamat datang di portal resmi Website Informasi Desa Tautpah. Kami berkomitmen untuk terus meningkatkan pelayanan masyarakat, transparansi pembangunan, dan keterbukaan informasi publik.',
            'leader_photo' => null,
        ]);

        // 4. Struktur Pemerintahan & Perangkat Desa (Contoh)
        $officials = [
            ['name' => '[DATA CONTOH] Bapak Kepala Desa', 'position' => 'Kepala Desa', 'order' => 1],
            ['name' => '[DATA CONTOH] Ibu Sekretaris Desa', 'position' => 'Sekretaris Desa', 'order' => 2],
            ['name' => '[DATA CONTOH] Kaur Keuangan', 'position' => 'Kaur Keuangan', 'order' => 3],
            ['name' => '[DATA CONTOH] Kaur Perencanaan & Umum', 'position' => 'Kaur Perencanaan & Umum', 'order' => 4],
            ['name' => '[DATA CONTOH] Kasi Pemerintahan', 'position' => 'Kasi Pemerintahan', 'order' => 5],
            ['name' => '[DATA CONTOH] Kasi Kesejahteraan & Pelayanan', 'position' => 'Kasi Kesejahteraan & Pelayanan', 'order' => 6],
        ];

        foreach ($officials as $item) {
            Official::create([
                'name' => $item['name'],
                'position' => $item['position'],
                'order' => $item['order'],
                'status' => 'active',
            ]);
        }

        // 5. Informasi Kontak & Jam Pelayanan
        ContactSetting::create([
            'address' => 'Kantor Desa Tautpah, Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara, Nusa Tenggara Timur (85612)',
            'phone' => '0812-3456-7890 (Contoh Kontak Kantor)',
            'email' => 'kantor@tautpah.desa.id',
            'service_hours' => 'Senin - Jumat: 08.00 - 15.00 WITA (Sabtu, Minggu & Hari Libur Nasional Tutup)',
            'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126284.1485671158!2d124.58000000000001!3d-9.450000000000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c56a00000000000%3A0x0!2sBiboki%20Selatan%2C%20Timor%20Tengah%20Utara!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',
        ]);

        // 6. Data Contoh Berita & Pengumuman
        Article::create([
            'user_id' => $admin->id,
            'category_id' => $katPemerintahan->id,
            'type' => 'berita',
            'title' => 'Musyawarah Perencanaan Pembangunan Desa (Musrenbangdes) Tautpah Tahun Anggaran Berjalan',
            'slug' => Str::slug('Musyawarah Perencanaan Pembangunan Desa Musrenbangdes Tautpah'),
            'summary' => 'Pemerintah Desa Tautpah bersama BPD dan tokoh masyarakat menyelenggarakan Musrenbangdes guna menyepakati prioritas pembangunan desa.',
            'content' => "<p><strong>Desa Tautpah</strong> - Pemerintah Desa Tautpah telah sukses menyelenggarakan forum Musyawarah Perencanaan Pembangunan Desa (Musrenbangdes) bertempat di balai kantor desa. Kegiatan ini dihadiri langsung oleh jajaran perangkat desa, Badan Permusyawaratan Desa (BPD), perwakilan tokoh adat, kader kesehatan, serta perwakilan kelompok pemuda.</p><p>Musrenbangdes ini bertujuan untuk menampung aspirasi masyarakat dari tiap dusun serta menyusun prioritas penggunaan dana desa agar tepat sasaran, terutama pada perbaikan sanitasi, ketahanan pangan, dan akses jalan desa.</p><p><em>(Catatan: Artikel ini merupakan data contoh uji sistem website).</em></p>",
            'status' => 'published',
            'views_count' => 124,
            'published_at' => now()->subDays(3),
        ]);

        Article::create([
            'user_id' => $admin->id,
            'category_id' => $katPembangunan->id,
            'type' => 'berita',
            'title' => 'Warga Bersama Pemerintah Desa Melakukan Gotong Royong Perawatan Sarana Air Bersih',
            'slug' => Str::slug('Warga Bersama Pemerintah Desa Gotong Royong Sarana Air Bersih'),
            'summary' => 'Kegiatan gotong royong pembersihan dan perbaikan pipa saluran air bersih untuk menjamin ketersediaan air minum masyarakat desa.',
            'content' => "<p>Warga Desa Tautpah menggelar aksi gotong royong pembersihan bak penampungan air dan pengecekan jaringan pipa distribusi air bersih ke pemukiman masyarakat. Kegiatan gotong royong ini mencerminkan semangat kebersamaan dan kekeluargaan yang masih sangat kental di Desa Tautpah, Biboki Selatan.</p><p>Dengan perawatan berkala ini, pasokan air bersih diharapkan tetap terjaga dan lancar bagi seluruh keluarga di lingkungan desa.</p><p><em>(Catatan: Artikel ini merupakan data contoh uji sistem website).</em></p>",
            'status' => 'published',
            'views_count' => 98,
            'published_at' => now()->subDays(5),
        ]);

        Article::create([
            'user_id' => $admin->id,
            'category_id' => $katPengumuman->id,
            'type' => 'pengumuman',
            'title' => 'Pengumuman Jadwal Pelayanan Administrasi Kependudukan dan Surat Keterangan Desa',
            'slug' => Str::slug('Pengumuman Jadwal Pelayanan Administrasi Kependudukan Desa'),
            'summary' => 'Informasi jam pelayanan pengurusan administrasi warga seperti surat pengantar, keterangan domisili, dan berkas kependudukan di kantor desa.',
            'content' => "<p>Diberitahukan kepada seluruh warga Desa Tautpah bahwa pelayanan administrasi umum, surat keterangan usaha, surat keterangan domisili, dan pengantar KTP/KK dilayani setiap hari kerja:</p><ul><li><strong>Hari:</strong> Senin s.d. Jumat</li><li><strong>Waktu:</strong> Pukul 08.00 s.d. 15.00 WITA</li><li><strong>Tempat:</strong> Kantor Desa Tautpah</li></ul><p>Warga diimbau membawa dokumen pendukung lengkap seperti Fotokopi KK dan KTP saat mengajukan permohonan surat keterangan.</p>",
            'status' => 'published',
            'views_count' => 215,
            'published_at' => now()->subDays(1),
        ]);

        // 7. Data Contoh Galeri Foto & Video
        Gallery::create([
            'title' => 'Dokumentasi Forum Musyawarah Bersama Tokoh Adat dan Perangkat Desa',
            'type' => 'foto',
            'caption' => 'Suasana musyawarah kekeluargaan di Desa Tautpah, Kecamatan Biboki Selatan.',
            'file_path' => null,
        ]);

        Gallery::create([
            'title' => 'Kegiatan Gotong Royong Perbaikan Akses Lingkungan Dusun',
            'type' => 'foto',
            'caption' => 'Semangat kebersamaan warga bergotong royong membersihkan jalan desa.',
            'file_path' => null,
        ]);

        Gallery::create([
            'title' => 'Video Profil dan Pesona Alam Timor Tengah Utara',
            'type' => 'video',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'caption' => 'Tautan video dokumentasi ragam pesona dan tradisi masyarakat di kawasan Timor.',
        ]);

        // 8. Log Aktivitas Awal
        ActivityLog::create([
            'user_id' => $admin->id,
            'user_name' => $admin->name,
            'action' => 'INISIALISASI',
            'module' => 'Sistem',
            'description' => 'Sistem website informasi Desa Tautpah berhasil diinisialisasi dengan data awal.',
            'ip_address' => '127.0.0.1',
        ]);
    }
}
