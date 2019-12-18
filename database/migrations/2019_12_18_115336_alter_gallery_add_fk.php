<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGalleryAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gallery', function (Blueprint $table) {
            $table->foreign('product_id', 'fk_gallery_to_product')
                ->references('product_id')->on('product');

            $table->foreign('gallery_created_by', 'fk_gallery_to_admin_created')
                ->references('admin_id')->on('admin');

            $table->foreign('gallery_updated_by', 'fk_gallery_to_admin_updated')
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
        Schema::table('gallery', function (Blueprint $table) {
            //
        });
    }
}
