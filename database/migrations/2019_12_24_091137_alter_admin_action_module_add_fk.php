<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAdminActionModuleAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_action_module', function (Blueprint $table) {
            $table->foreign('admin_id', 'fk_admin_action_module_to_admin')
                ->references('admin_id')->on('admin');
            $table->foreign('action_module_id', 'fk_admin_action_module_to_action_module')
                ->references('action_module_id')->on('action_module');
            $table->foreign('admin_action_module_created_by', 'fk_admin_action_module_to_admin_created')
                ->references('admin_id')->on('admin');
            $table->foreign('admin_action_module_updated_by', 'fk_admin_action_module_to_admin_updated')
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
        Schema::table('admin_action_module', function (Blueprint $table) {
            //
        });
    }
}
