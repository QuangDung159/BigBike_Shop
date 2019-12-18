<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBrandAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brand', function (Blueprint $table) {
            $table->foreign('brand_created_by', 'fk_brand_to_admin_created')
                ->references('admin_id')->on('admin');

            $table->foreign('brand_updated_by', 'fk_brand_to_admin_updated')
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
        Schema::table('brand', function (Blueprint $table) {
            //
        });
    }
}
