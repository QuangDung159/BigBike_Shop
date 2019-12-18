<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name');
            $table->mediumText('product_desc');
            $table->longText('product_content');
            $table->unsignedInteger('brand_category_id');
            $table->float('product_price');
            $table->float('product_promotion_price');
            $table->integer('product_stock');
            $table->float('product_rate');
            $table->unsignedInteger('product_created_at');
            $table->unsignedInteger('product_updated_at')->nullable();
            $table->unsignedInteger('product_created_by');
            $table->unsignedInteger('product_updated_by')->nullable();
            $table->tinyInteger('product_status')->default(1);
            $table->tinyInteger('product_is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
