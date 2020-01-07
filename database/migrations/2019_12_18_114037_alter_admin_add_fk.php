<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAdminAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin', function (Blueprint $table) {
            $table->foreign('admin_created_by', 'fk_admin_to_admin_created')
                ->references('admin_id')->on('admin');

            $table->foreign('admin_updated_by', 'fk_admin_to_admin_updated')
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
        Schema::table('admin', function (Blueprint $table) {
            //
        });
    }
}
