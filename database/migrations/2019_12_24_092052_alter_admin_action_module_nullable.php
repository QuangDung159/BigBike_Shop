<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAdminActionModuleNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_action_module', function (Blueprint $table) {
            $table->unsignedInteger('admin_action_module_updated_at')->nullable()->change();
            $table->unsignedInteger('admin_action_module_updated_by')->nullable()->change();
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
