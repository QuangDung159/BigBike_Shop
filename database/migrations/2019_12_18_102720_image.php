<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Image extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image', function (Blueprint $table) {
            $table->increments('image_id');
            $table->unsignedInteger('gallery_id');
            $table->string('image_path');
            $table->unsignedInteger('image_created_at');
            $table->unsignedInteger('image_updated_at')->nullable();
            $table->unsignedInteger('image_updated_by')->nullable();
            $table->unsignedInteger('image_created_by');
            $table->tinyInteger('image_status')->default(1);
            $table->tinyInteger('image_is_delete')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image');
    }
}
