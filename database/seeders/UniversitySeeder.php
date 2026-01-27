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

        // 2. Real Data: 20 Universities from Floor Plan
        $universities = [
            [
                'name' => 'Agung Putra University',
                'description' => 'Universitas Agung Putra adalah perguruan tinggi swasta yang berkomitmen menghasilkan lulusan berkualitas dan siap bersaing.',
                'booth_number' => 1,
                'website' => 'https://unagungputra.ac.id',
            ],
            [
                'name' => 'Agung Putra University (II)',
                'description' => 'Stand kedua Universitas Agung Putra dengan layanan informasi program studi unggulan.',
                'booth_number' => 2,
                'website' => 'https://unagungputra.ac.id',
            ],
            [
                'name' => 'STMIK Bina Patria',
                'description' => 'STMIK Bina Patria fokus pada pendidikan teknologi informasi dan komputer terkini.',
                'booth_number' => 3,
                'website' => 'https://stmikbinapatria.ac.id',
            ],
            [
                'name' => 'Universitas Negeri Yogyakarta',
                'description' => 'UNY adalah universitas negeri terkemuka di Yogyakarta dengan program pendidikan unggulan.',
                'booth_number' => 4,
                'website' => 'https://uny.ac.id',
            ],
            [
                'name' => 'STMIK Tunas Bangsa',
                'description' => 'STMIK Tunas Bangsa menghasilkan tenaga ahli IT yang profesional dan berdaya saing tinggi.',
                'booth_number' => 5,
                'website' => 'https://stmik-tunasba.ac.id',
            ],
            [
                'name' => 'Poltekkes Karya Husada',
                'description' => 'Politeknik Kesehatan Karya Husada mencetak tenaga kesehatan profesional dan berkompeten.',
                'booth_number' => 6,
                'website' => 'https://poltekkeskaryahusada.ac.id',
            ],
            [
                'name' => 'UIN Walisongo',
                'description' => 'UIN Walisongo adalah perguruan tinggi Islam negeri terkemuka di Jawa Tengah.',
                'booth_number' => 7,
                'website' => 'https://walisongo.ac.id',
            ],
            [
                'name' => 'Universitas Sanata Dharma',
                'description' => 'Universitas Sanata Dharma adalah universitas Katolik dengan nilai humanisme yang kuat.',
                'booth_number' => 8,
                'website' => 'https://usd.ac.id',
            ],
            [
                'name' => 'Universitas Diponegoro',
                'description' => 'Universitas Diponegoro (UNDIP) adalah perguruan tinggi negeri di Semarang yang unggul dalam riset dan inovasi.',
                'booth_number' => 9,
                'website' => 'https://www.undip.ac.id',
            ],
            [
                'name' => 'Unissula',
                'description' => 'Universitas Islam Sultan Agung adalah universitas Islam terkemuka dengan program studi yang komprehensif.',
                'booth_number' => 10,
                'website' => 'https://unissula.ac.id',
            ],
            [
                'name' => 'Unsoed',
                'description' => 'Universitas Jenderal Soedirman adalah universitas negeri yang berkembang pesat di Purwokerto.',
                'booth_number' => 11,
                'website' => 'https://unsoed.ac.id',
            ],
            [
                'name' => 'UNS',
                'description' => 'Universitas Sebelas Maret adalah universitas negeri terkemuka di Solo dengan reputasi akademik yang tinggi.',
                'booth_number' => 12,
                'website' => 'https://uns.ac.id',
            ],
            [
                'name' => 'Universitas Brawijaya',
                'description' => 'Universitas Brawijaya adalah perguruan tinggi negeri di Malang yang unggul dengan visi World Class Entrepreneurial University.',
                'booth_number' => 13,
                'website' => 'https://ub.ac.id',
            ],
            [
                'name' => 'UPN Veteran Yogyakarta',
                'description' => 'UPN Veteran Yogyakarta adalah universitas negeri dengan karakter bela negara yang kuat.',
                'booth_number' => 14,
                'website' => 'https://upnyk.ac.id',
            ],
            [
                'name' => 'Polbangtan Yoma',
                'description' => 'Politeknik Pembangunan Pertanian Yogyakarta-Magelang mencetak tenaga ahli pertanian yang profesional.',
                'booth_number' => 15,
                'website' => 'https://polbangtan-yoma.ac.id',
            ],
            [
                'name' => 'Universitas Negeri Semarang',
                'description' => 'UNNES adalah universitas konservasi yang berkomitmen pada pendidikan berkualitas dan peduli lingkungan.',
                'booth_number' => 16,
                'website' => 'https://unnes.ac.id',
            ],
            [
                'name' => 'Sibermu',
                'description' => 'Sibermu adalah institusi pendidikan dengan fokus pada teknologi dan kewirausahaan digital.',
                'booth_number' => 17,
                'website' => 'https://sibermu.ac.id',
            ],
            [
                'name' => 'AMN Cilacap',
                'description' => 'Akademi Maritim Nusantara Cilacap adalah institusi pendidikan maritim terkemuka di Indonesia.',
                'booth_number' => 18,
                'website' => 'https://amn.ac.id',
            ],
            [
                'name' => 'Kamadiksa',
                'description' => 'Kamadiksa adalah lembaga pendidikan yang fokus pada pengembangan sumber daya manusia berkualitas.',
                'booth_number' => 19,
                'website' => 'https://kamadiksa.ac.id',
            ],
            [
                'name' => 'Institut Teknologi Bandung',
                'description' => 'Institut Teknologi Bandung (ITB) adalah sekolah tinggi teknik pertama di Indonesia yang berfokus pada inovasi dan teknologi.',
                'booth_number' => 20,
                'website' => 'https://www.itb.ac.id',
            ],
        ];

        foreach ($universities as $uni) {
            $slug = Str::slug($uni['name']);
            
            University::create([
                'name' => $uni['name'],
                'slug' => $slug,
                'description' => $uni['description'],
                'map_booth_id' => (string) $uni['booth_number'],
                'website_url' => $uni['website'],
                'logo_path' => "images/universities/{$slug}.png",
                'is_favorite' => false,
            ]);
        }
    }
}
