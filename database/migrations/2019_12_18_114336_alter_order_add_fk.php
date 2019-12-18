<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrderAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->foreign('shipping_status_id', 'fk_order_to_shipping_status')
                ->references('shipping_status_id')->on('shipping_status');

            $table->foreign('user_id', 'fk_order_to_user')
                ->references('user_id')->on('user');

            $table->foreign('order_updated_by', 'fk_order_to_admin')
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
        Schema::table('order', function (Blueprint $table) {
            //
        });
    }
}
