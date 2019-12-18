<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Slide extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slide', function (Blueprint $table) {
            $table->increments('slide_id');
            $table->string('slide_path')->default('slide_404.jpg');
            $table->unsignedInteger('slide_created_at');
            $table->unsignedInteger('slide_updated_at')->nullable();
            $table->unsignedInteger('slide_created_by');
            $table->unsignedInteger('slide_updated_by')->nullable();
            $table->tinyInteger('slide_status')->default(1);
            $table->tinyInteger('slide_is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slide');
    }
}
