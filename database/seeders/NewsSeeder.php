<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'title' => 'Acara Reuni Alumni 2026',
                'slug' => 'acara-reuni-alumni-2026',
                'content' => 'Kami mengumumkan bahwa akan diadakan acara reuni alumni yang spektakuler pada bulan juni mendatang. Semua alumni diundang untuk menghadiri acara ini.',
                'category' => 'Event',
                'author' => 'Admin',
                'excerpt' => 'Acara reuni alumni yang dinanti-nantikan',
                'featured_image' => null,
                'published_at' => now(),
                'status' => 'published',
                'views' => 0,
            ],
            [
                'title' => 'Program Beasiswa untuk Alumni',
                'slug' => 'program-beasiswa-untuk-alumni',
                'content' => 'Universitas membuka program beasiswa khusus bagi anak-anak alumni yang berprestasi. Silahkan hubungi bagian beasiswa untuk informasi lebih lanjut.',
                'category' => 'Beasiswa',
                'author' => 'Admin',
                'excerpt' => 'Program beasiswa untuk generasi penerus',
                'featured_image' => null,
                'published_at' => now(),
                'status' => 'published',
                'views' => 0,
            ],
            [
                'title' => 'Peluncuran Platform Alumni Digital',
                'slug' => 'peluncuran-platform-alumni-digital',
                'content' => 'Platform baru kami memudahkan alumni untuk terhubung dan berbagi informasi. Dapatkan akses eksklusif ke forum alumni dan networking events.',
                'category' => 'Teknologi',
                'author' => 'Admin',
                'excerpt' => 'Platform digital untuk mempererat hubungan alumni',
                'featured_image' => null,
                'published_at' => now(),
                'status' => 'published',
                'views' => 0,
            ],
        ];

        foreach ($news as $item) {
            News::create($item);
        }
    }
}
