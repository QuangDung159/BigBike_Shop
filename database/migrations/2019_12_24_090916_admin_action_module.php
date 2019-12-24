<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminActionModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_action_module', function (Blueprint $table) {
            $table->increments('admin_action_module_id');
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('action_module_id');
            $table->unsignedInteger('admin_action_module_created_at');
            $table->unsignedInteger('admin_action_module_created_by');
            $table->unsignedInteger('admin_action_module_updated_at');
            $table->unsignedInteger('admin_action_module_updated_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_action_module');
    }
}
