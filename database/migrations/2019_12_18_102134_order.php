<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('order_id');
            $table->unsignedInteger('shipping_status_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('order_created_at');
            $table->unsignedInteger('order_updated_at')->nullable();
            $table->unsignedInteger('order_updated_by')->nullable();
            $table->tinyInteger('order_status')->default(1);
            $table->tinyInteger('order_is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
