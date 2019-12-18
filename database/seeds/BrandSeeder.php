<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brand')
            ->insert(
                [
                    [
                        'brand_id' => 1,
                        'brand_name' => 'Yamaha',
                        'brand_created_at' => time(),
                        'brand_desc' => '',
                        'brand_created_by' => 1
                    ],
                    [
                        'brand_id' => 2,
                        'brand_name' => 'Honda',
                        'brand_created_at' => time(),
                        'brand_desc' => '',
                        'brand_created_by' => 1
                    ],
                    [
                        'brand_id' => 3,
                        'brand_name' => 'Suzuki',
                        'brand_created_at' => time(),
                        'brand_desc' => '',
                        'brand_created_by' => 1
                    ],
                    [
                        'brand_id' => 4,
                        'brand_name' => 'Kawasaki',
                        'brand_created_at' => time(),
                        'brand_desc' => '',
                        'brand_created_by' => 1
                    ],
                    [
                        'brand_id' => 5,
                        'brand_name' => 'BMW',
                        'brand_created_at' => time(),
                        'brand_desc' => '',
                        'brand_created_by' => 1
                    ],
                    [
                        'brand_id' => 6,
                        'brand_name' => 'Ducati',
                        'brand_created_at' => time(),
                        'brand_desc' => '',
                        'brand_created_by' => 1
                    ],
                    [
                        'brand_id' => 7,
                        'brand_name' => 'Aprillia',
                        'brand_created_at' => time(),
                        'brand_desc' => '',
                        'brand_created_by' => 1
                    ],
                    [
                        'brand_id' => 8,
                        'brand_name' => 'KTM',
                        'brand_created_at' => time(),
                        'brand_desc' => '',
                        'brand_created_by' => 1
                    ],
                    [
                        'brand_id' => 9,
                        'brand_name' => 'MV Agusta',
                        'brand_created_at' => time(),
                        'brand_desc' => '',
                        'brand_created_by' => 1
                    ],
                    [
                        'brand_id' => 10,
                        'brand_name' => 'Triumph',
                        'brand_created_at' => time(),
                        'brand_desc' => '',
                        'brand_created_by' => 1
                    ],
                ]
            );
    }
}
