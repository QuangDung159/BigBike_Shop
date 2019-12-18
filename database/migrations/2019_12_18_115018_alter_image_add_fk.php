<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterImageAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image', function (Blueprint $table) {
            $table->foreign('gallery_id', 'fk_image_to_gallery')
                ->references('gallery_id')->on('gallery');

            $table->foreign('image_created_by', 'fk_image_to_admin_created')
                ->references('admin_id')->on('admin');

            $table->foreign('image_updated_by', 'fk_image_to_admin_updated')
                ->references('admin_id')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image', function (Blueprint $table) {
            //
        });
    }
}
