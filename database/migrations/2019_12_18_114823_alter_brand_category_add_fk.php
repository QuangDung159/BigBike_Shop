<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBrandCategoryAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brand_category', function (Blueprint $table) {
            $table->foreign('brand_id', 'fk_brand_category_to_brand')
                ->references('brand_id')->on('brand');

            $table->foreign('category_id', 'fk_brand_category_to_category')
                ->references('category_id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brand_category', function (Blueprint $table) {
            //
        });
    }
}
