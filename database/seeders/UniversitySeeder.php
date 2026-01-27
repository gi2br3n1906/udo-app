<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UniversitySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Truncate Table
        Schema::disableForeignKeyConstraints();
        University::truncate();
        Schema::enableForeignKeyConstraints();

        $universities = [
            [
                'name' => 'Universitas Indonesia',
                'description' => 'Universitas Indonesia adalah kampus modern, komprehensif, terbuka, multibudaya, dan humanis yang mencakup disiplin ilmu yang luas.',
                'booth' => 'A1',
                'website' => 'https://www.ui.ac.id',
            ],
            [
                'name' => 'Institut Teknologi Bandung',
                'description' => 'Institut Teknologi Bandung (ITB) adalah sekolah tinggi teknik pertama di Indonesia yang berfokus pada penciptaan nilai, inovasi, dan kemajuan ilmu pengetahuan.',
                'booth' => 'A2',
                'website' => 'https://www.itb.ac.id',
            ],
            [
                'name' => 'Universitas Gadjah Mada',
                'description' => 'Universitas Gadjah Mada merupakan universitas negeri kelas dunia yang berorientasi pada kepentingan bangsa berdasarkan Pancasila.',
                'booth' => 'A3',
                'website' => 'https://ugm.ac.id',
            ],
            [
                'name' => 'IPB University',
                'description' => 'IPB University adalah perguruan tinggi pertanian terkemuka di Indonesia yang mengedepankan inovasi agromaritim 4.0.',
                'booth' => 'A4',
                'website' => 'https://ipb.ac.id',
            ],
            [
                'name' => 'Universitas Airlangga',
                'description' => 'Universitas Airlangga adalah universitas terkemuka di Surabaya yang berkomitmen menghasilkan lulusan berkualitas, bermoral, dan beretika tinggi.',
                'booth' => 'B1',
                'website' => 'https://unair.ac.id',
            ],
            [
                'name' => 'Institut Teknologi Sepuluh Nopember',
                'description' => 'ITS adalah perguruan tinggi sains dan teknologi terkemuka di Indonesia yang berperan aktif dalam pembangunan nasional.',
                'booth' => 'B2',
                'website' => 'https://www.its.ac.id',
            ],
            [
                'name' => 'Universitas Diponegoro',
                'description' => 'Universitas Diponegoro (Undip) adalah perguruan tinggi negeri di Semarang yang unggul dalam riset dan inovasi.',
                'booth' => 'B3',
                'website' => 'https://www.undip.ac.id',
            ],
            [
                'name' => 'Universitas Padjadjaran',
                'description' => 'Unpad berkomitmen menjadi universitas bereputasi dunia dan berdampak pada masyarakat, berlokasi di Bandung dan Sumedang.',
                'booth' => 'B4',
                'website' => 'https://www.unpad.ac.id',
            ],
            [
                'name' => 'Universitas Brawijaya',
                'description' => 'Universitas Brawijaya adalah perguruan tinggi negeri di Malang yang unggul dengan visi menjadi World Class Entrepreneurial University.',
                'booth' => 'C1',
                'website' => 'https://ub.ac.id',
            ],
            [
                'name' => 'Binus University',
                'description' => 'Binus University adalah perguruan tinggi swasta terdepan dalam inovasi teknologi dan bisnis di Indonesia.',
                'booth' => 'C2',
                'website' => 'https://binus.ac.id',
            ],
        ];

        foreach ($universities as $uni) {
            $slug = Str::slug($uni['name']);
            
            University::create([
                'name' => $uni['name'],
                'slug' => $slug,
                'description' => $uni['description'],
                'map_booth_id' => $uni['booth'],
                'website_url' => $uni['website'],
                'logo_path' => "images/universities/{$slug}.png",
                'is_favorite' => false,
            ]);
        }
    }
}
