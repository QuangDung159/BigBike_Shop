<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Gallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->increments('gallery_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('gallery_created_at');
            $table->unsignedInteger('gallery_updated_at')->nullable();
            $table->unsignedInteger('gallery_created_by');
            $table->unsignedInteger('gallery_updated_by')->nullable();
            $table->tinyInteger('gallery_status')->default(1);
            $table->tinyInteger('gallery_is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery');
    }
}
