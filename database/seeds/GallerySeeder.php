<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listProduct = DB::table('product')
            ->get();

        foreach ($listProduct as $key => $product) {
            DB::table('gallery')
                ->insert(
                    [
                        'product_id' => $product->product_id,
                        'gallery_created_at' => time(),
                        'gallery_created_by' => 1,
                        'gallery_name' => $product->product_name
                    ]
                );
        }
    }
}
