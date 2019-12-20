<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Constant;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 7; $i++) {
            DB::table(Constant::TABLE_SLIDE)
                ->insert(
                    [
                        [
                            'slide_path' => 'slide_' . $i . '.jpg',
                            'slide_created_at' => time(),
                            'slide_created_by' => 1,
                        ],
                    ]
                );
        }
    }
}
