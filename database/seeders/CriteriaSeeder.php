<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Criteria;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criteria = [
            [
                'name' => 'Harga',
                'code' => 'HAR',
                'type' => 'cost',
                'description' => 'Harga sewa villa per malam',
                'weight' => 1.0,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Lokasi',
                'code' => 'LOK',
                'type' => 'benefit',
                'description' => 'Lokasi strategis dan mudah diakses',
                'weight' => 1.0,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Fasilitas',
                'code' => 'FAS',
                'type' => 'benefit',
                'description' => 'Kelengkapan fasilitas villa',
                'weight' => 1.0,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Kebersihan',
                'code' => 'KEB',
                'type' => 'benefit',
                'description' => 'Tingkat kebersihan dan pemeliharaan',
                'weight' => 1.0,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Rating',
                'code' => 'RAT',
                'type' => 'benefit',
                'description' => 'Rating dari tamu sebelumnya',
                'weight' => 1.0,
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Kapasitas',
                'code' => 'KAP',
                'type' => 'benefit',
                'description' => 'Jumlah tamu yang bisa ditampung',
                'weight' => 1.0,
                'order' => 6,
                'is_active' => true,
            ]
        ];

        foreach ($criteria as $criterion) {
            Criteria::create($criterion);
        }
    }
}
