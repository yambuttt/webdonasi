<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        $admin = \App\Models\User::create([
            'name' => 'Admin Bisa Kita',
            'email' => 'admin@bisakita.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Regular Donor
        \App\Models\User::create([
            'name' => 'Donatur Baik',
            'email' => 'donatur@bisakita.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Sample Articles
        \App\Models\Article::create([
            'user_id' => $admin->id,
            'title' => 'Pentingnya Transparansi dalam Penyaluran Donasi Digital',
            'slug' => 'pentingnya-transparansi-dalam-penyaluran-donasi-digital',
            'thumbnail' => '/images/campaign_education.png',
            'content' => '<h2>Mengapa Transparansi Sangat Penting?</h2><p>Di era digital saat ini, menyalurkan bantuan kepada sesama telah menjadi jauh lebih mudah dengan adanya platform donasi online. Namun, kepercayaan donatur merupakan aset yang paling berharga. Platform yang baik harus melaporkan setiap transaksi dana secara real-time dan terbuka.</p><p>Dengan transparansi, setiap rupiah yang didonasikan dapat dilacak penyalurannya, meminimalkan risiko penyelewengan, serta membangun reputasi yang kokoh untuk jangka panjang.</p><h3>Langkah Transparansi Bisa Kita:</h3><ul><li>Laporan keuangan berkala yang diaudit oleh KAP terpercaya.</li><li>Notifikasi real-time ke WhatsApp donatur ketika dana disalurkan.</li><li>Dokumentasi foto dan video penyaluran langsung di lapangan.</li></ul>',
            'status' => 'published',
        ]);

        \App\Models\Article::create([
            'user_id' => $admin->id,
            'title' => 'Kisah Inspiratif: Pembangunan Sumur Air Bersih di Pedalaman NTT',
            'slug' => 'kisah-inspiratif-pembangunan-sumur-air-bersih-di-pedalaman-ntt',
            'thumbnail' => '/images/campaign_disaster.png',
            'content' => '<h2>Membawa Harapan Baru Lewat Air Bersih</h2><p>Selama puluhan tahun, warga desa terpencil di Nusa Tenggara Timur (NTT) harus berjalan kaki sejauh 5 kilometer setiap hari hanya untuk mendapatkan satu ember air bersih guna kebutuhan memasak dan minum.</p><p>Melalui kampanye kolaboratif para donatur Bisa Kita, hari ini sebuah sumur bor air bersih dengan teknologi sanitasi higienis telah berhasil dibangun. Sebanyak 250 kepala keluarga kini tidak lagi kesulitan air bersih.</p><p>Ini adalah bukti nyata bahwa aksi kecil yang dikumpulkan bersama-sama dapat merubah kehidupan ratusan nyawa menjadi lebih sehat dan sejahtera. Terima kasih para donatur!</p>',
            'status' => 'published',
        ]);

        // Sample Campaigns
        \App\Models\Campaign::create([
            'title' => 'Bantu Balita Gizi Buruk di Desa Pelosok Pulih Kembali',
            'slug' => 'bantu-balita-gizi-buruk-di-desa-pelosok-pulih-kembali',
            'thumbnail' => '/images/campaign_medical.png',
            'category' => 'kesehatan',
            'description' => '<h2>Bantu Tumbuh Kembang Balita Pelosok</h2><p>Puluhan balita di pelosok Nusa Tenggara Timur (NTT) mengalami kondisi gizi buruk akibat keterbatasan pangan bergizi dan sanitasi yang kurang memadai.</p><p>Melalui gerakan ini, kami ingin menyalurkan paket makanan tambahan (PMT) berupa susu formula khusus, vitamin, telur, serta penyediaan fasilitas konsultasi tumbuh kembang anak dari tim medis setempat.</p><p>Setiap bantuan Anda akan membawa kebahagiaan dan masa depan yang lebih sehat bagi generasi muda penerus bangsa.</p>',
            'target_amount' => 50000000,
            'current_amount' => 32500000,
            'donation_options' => [10000, 25000, 50000, 100000, 250000, 500000],
            'status' => 'active',
            'days_remaining' => 12,
        ]);

        \App\Models\Campaign::create([
            'title' => 'Tanggap Darurat Banjir Bandang: Salurkan Makanan & Pakaian',
            'slug' => 'tanggap-darurat-banjir-bandang-salurkan-makanan-pakaian',
            'thumbnail' => '/images/campaign_disaster.png',
            'category' => 'bencana',
            'description' => '<h2>Bantuan Cepat untuk Korban Banjir Bandang</h2><p>Banjir bandang mendadak melanda ratusan rumah warga dan memutus akses jalan serta aliran listrik utama.</p><p>Saat ini para pengungsi membutuhkan bantuan mendesak berupa makanan siap saji, air mineral, selimut, popok bayi, serta obat-obatan penunjang kesehatan dasar.</p><p>Tim relawan kami di lapangan telah mendirikan posko tanggap darurat dan siap mendistribusikan amanah dari Anda secara transparan.</p>',
            'target_amount' => 100000000,
            'current_amount' => 88200000,
            'donation_options' => [20000, 50000, 100000, 200000, 500000, 1000000],
            'status' => 'active',
            'days_remaining' => 3,
        ]);

        $c3 = \App\Models\Campaign::create([
            'title' => 'Penyediaan Paket Buku dan Alat Tulis untuk Anak Pelosok',
            'slug' => 'penyediaan-paket-buku-dan-alat-tulis-untuk-anak-pelosok',
            'thumbnail' => '/images/campaign_education.png',
            'category' => 'pendidikan',
            'description' => '<h2>Dukung Pendidikan Anak-Anak di Pulau Terluar</h2><p>Pendidikan adalah jendela dunia. Namun, anak-anak di pulau terluar sering kali tidak memiliki akses ke buku bacaan berkualitas dan alat tulis yang layak.</p><p>Kami mengajak Anda untuk bergotong-royong membagikan 1.000 paket pendidikan yang berisi buku cerita edukasi, buku tulis, pensil, tas sekolah, serta sarana belajar mandiri.</p><p>Mari bantu mereka menggapai cita-cita setinggi langit dengan perlengkapan sekolah yang layak.</p>',
            'target_amount' => 25000000,
            'current_amount' => 11250000,
            'donation_options' => [10000, 25000, 50000, 100000, 150000, 250000],
            'status' => 'active',
            'days_remaining' => 25,
        ]);

        $campaigns = \App\Models\Campaign::all();
        $c1 = $campaigns[0];
        $c2 = $campaigns[1];

        // Seed some donations
        \App\Models\Donation::create([
            'campaign_id' => $c1->id,
            'invoice_number' => 'INV-' . date('Ymd') . '-A8D2F5',
            'donor_name' => 'Faisal Rahman',
            'donor_email' => 'faisal.rahman@gmail.com',
            'nominal' => 250000,
            'unique_code' => 124,
            'total_amount' => 250124,
            'payment_method' => 'bank_nobu',
            'status' => 'pending',
            'comment' => 'Semoga lekas sembuh dan bisa beraktivitas seperti biasa kembali. Aamiin.',
        ]);

        \App\Models\Donation::create([
            'campaign_id' => $c2->id,
            'invoice_number' => 'INV-' . date('Ymd') . '-B9E8C7',
            'donor_name' => 'Anisa Maharani',
            'donor_email' => 'anisa.maharani@yahoo.com',
            'nominal' => 500000,
            'unique_code' => 672,
            'total_amount' => 500672,
            'payment_method' => 'qris',
            'status' => 'confirmed',
            'comment' => 'Semangat terus untuk seluruh adik-adik di pelosok! Pendidikan adalah kunci masa depan.',
        ]);

        \App\Models\Donation::create([
            'campaign_id' => $c3->id,
            'invoice_number' => 'INV-' . date('Ymd') . '-C3B1A2',
            'donor_name' => 'Hamba Allah',
            'donor_email' => 'hamba.allah@gmail.com',
            'nominal' => 50000,
            'unique_code' => 389,
            'total_amount' => 50389,
            'payment_method' => 'bank_nobu',
            'status' => 'pending',
            'comment' => 'Semoga sedikit bantuan ini bisa meringankan beban sesama.',
        ]);

        // Seed default payment configurations
        \App\Models\Setting::set('qris_image', '/images/qris.png');
        \App\Models\Setting::set('bank_name', 'NOBU BANK');
        \App\Models\Setting::set('bank_account_number', '1031-0988-1234');
        \App\Models\Setting::set('bank_account_name', 'Yayasan Bisa Kita');
        \App\Models\Setting::set('whatsapp_number', '6281234567890');
    }
}
