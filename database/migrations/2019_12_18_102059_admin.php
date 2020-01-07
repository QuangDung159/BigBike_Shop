<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Admin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('admin_id');
            $table->string('admin_name');
            $table->string('admin_email')->unique();
            $table->string('admin_password');
            $table->tinyInteger('admin_is_root')->default(0);
            $table->unsignedInteger('admin_created_at');
            $table->unsignedInteger('admin_updated_at')->nullable();
            $table->unsignedInteger('admin_created_by');
            $table->unsignedInteger('admin_updated_by')->nullable();
            $table->tinyInteger('admin_status')->default(1);
            $table->tinyInteger('admin_is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
