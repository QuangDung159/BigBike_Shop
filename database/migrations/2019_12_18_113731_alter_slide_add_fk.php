<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSlideAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slide', function (Blueprint $table) {
            $table->foreign('slide_created_by', 'fk_slide_to_admin_created')
                ->references('admin_id')->on('admin');

            $table->foreign('slide_updated_by', 'fk_slide_to_admin_updated')
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
        Schema::table('slide', function (Blueprint $table) {
            //
        });
    }
}
