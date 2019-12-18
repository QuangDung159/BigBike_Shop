<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Category extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('category_name');
            $table->mediumText('category_desc');
            $table->unsignedInteger('category_created_at');
            $table->unsignedInteger('category_updated_at')->nullable();
            $table->unsignedInteger('category_created_by');
            $table->unsignedInteger('category_updated_by')->nullable();
            $table->tinyInteger('category_status')->default(1);
            $table->tinyInteger('category_is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}
