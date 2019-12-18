<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBrandCategoryCreatedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brand_category', function (Blueprint $table) {
            $table->unsignedInteger('brand_category_created_at');
            $table->unsignedInteger('brand_category_created_by');
            $table->unsignedInteger('brand_category_updated_at')->nullable();
            $table->unsignedInteger('brand_category_updated_by')->nullable();
            $table->tinyInteger('brand_category_status')->default(1);
            $table->tinyInteger('brand_category_is_deleted')->default(0);

            $table->foreign('brand_category_created_by', 'fk_brand_category_to_admin_created')
                ->references('admin_id')->on('admin');
            $table->foreign('brand_category_updated_by', 'fk_brand_category_to_admin_updated')
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
        Schema::table('brand_category', function (Blueprint $table) {
            //
        });
    }
}
