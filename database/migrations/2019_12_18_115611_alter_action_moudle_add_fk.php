<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterActionMoudleAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_module', function (Blueprint $table) {
            $table->foreign('action_id', 'fk_action_module_to_action')
                ->references('action_id')->on('action');

            $table->foreign('module_id', 'fk_action_module_to_module')
                ->references('module_id')->on('module');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_module', function (Blueprint $table) {
            //
        });
    }
}
