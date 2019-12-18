<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Brand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->increments('brand_id');
            $table->string('brand_name');
            $table->mediumText('brand_desc');
            $table->string('brand_logo')->default('404.png');
            $table->unsignedInteger('brand_created_at');
            $table->unsignedInteger('brand_updated_at')->nullable();
            $table->unsignedInteger('brand_created_by');
            $table->unsignedInteger('brand_updated_by')->nullable();
            $table->tinyInteger('brand_status')->default(1);
            $table->tinyInteger('brand_is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand');
    }
}
