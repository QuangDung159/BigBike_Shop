<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listCategory = DB::table('category')
            ->get();
        $listBrand = DB::table('brand')
            ->get();

        foreach ($listCategory as $category) {
            foreach ($listBrand as $brand) {
                DB::table('brand_category')
                    ->insert(
                        [
                            'brand_id' => $brand->brand_id,
                            'category_id' => $category->category_id,
                            'brand_category_created_at' => time(),
                            'brand_category_created_by' => 1,
                            'brand_category_updated_by' => 1,
                        ]
                    );
            }
        }
    }
}
