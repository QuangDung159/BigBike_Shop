<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listGallery = DB::table('gallery')
            ->get();

        foreach ($listGallery as $key => $gallery) {
            for ($count = 1; $count <= 3; $count++) {
                $str = '_' . $count . '.jpg';
                DB::table('image')
                    ->insert(
                        [
                            [
                                'gallery_id' => $gallery->gallery_id,
                                'image_path' => $gallery->gallery_name . $str,
                                'image_created_at' => time(),
                                'image_created_by' => 1,
                            ],
                        ]
                    );
            }
        }
    }
}
