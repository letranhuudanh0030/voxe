<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->integer('parent_id');
            $table->string('avatar_image');
            $table->text('short_desc');
            $table->text('ad_content');
            $table->boolean('publish');
            $table->boolean('highlight');
            $table->string('meta_title')->nullable();
            $table->string('meta_keyswords')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('slug');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }
}
