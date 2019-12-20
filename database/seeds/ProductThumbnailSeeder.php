<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Constant;

class ProductThumbnailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listProduct = DB::table(Constant::TABLE_PRODUCT)
            ->select(
                [
                    Constant::TABLE_PRODUCT . '.product_id',
                    Constant::TABLE_PRODUCT . '.product_name'
                ]
            )
            ->get();

        foreach ($listProduct as $key => $product) {
            DB::table(Constant::TABLE_PRODUCT)
                ->where(
                    Constant::TABLE_PRODUCT . '.product_id',
                    '=',
                    $product->product_id
                )
                ->update(
                    [
                        'product_thumbnail' => $product->product_name . '_1.jpg'
                    ]
                );
        }
    }
}
