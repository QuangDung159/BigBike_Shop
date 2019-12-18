<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')
            ->insert(
                [
                    [
                        'category_id' => 1,
                        'category_name' => 'Sport Bike',
                        'category_desc' => 'Sport bikes emphasize top speed, acceleration, braking, handling and grip on paved roads,
                        typically at the expense of comfort and fuel economy in comparison to less specialized motorcycles.',
                        'category_created_at' => time(),
                        'category_created_by' => 1
                    ],
                    [
                        'category_id' => 2,
                        'category_name' => 'Naked Bike',
                        'category_desc' => 'Naked bike are versatile, general-purpose street motorcycles. They are recognized primarily by their upright riding position, partway between the reclining rider posture of the cruisers and the forward leaning sport bikes.',
                        'category_created_at' => time(),
                        'category_created_by' => 1
                    ],
                    [
                        'category_id' => 3,
                        'category_name' => 'Classic Bike',
                        'category_desc' => '',
                        'category_created_at' => time(),
                        'category_created_by' => 1
                    ],
                    [
                        'category_id' => 4,
                        'category_name' => 'Touring Bike',
                        'category_desc' => '',
                        'category_created_at' => time(),
                        'category_created_by' => 1
                    ],
                    [
                        'category_id' => 5,
                        'category_name' => 'Adventure Bike',
                        'category_desc' => '',
                        'category_created_at' => time(),
                        'category_created_by' => 1
                    ],
                    [
                        'category_id' => 6,
                        'category_name' => 'Offroad Bike',
                        'category_desc' => '',
                        'category_created_at' => time(),
                        'category_created_by' => 1
                    ],
                ]
            );
    }
}
