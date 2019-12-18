<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProductAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->foreign('product_created_by', 'fk_product_to_admin_created')
                ->references('admin_id')->on('admin');

            $table->foreign('product_updated_by', 'fk_product_to_admin_updated')
                ->references('admin_id')->on('admin');

            $table->foreign('brand_category_id', 'fk_product_to_brand_category')
                ->references('brand_category_id')->on('brand_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            //
        });
    }
}
