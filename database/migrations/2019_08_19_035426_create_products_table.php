<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('str_id')->nullable();
            $table->decimal('price',15,2)->default(0);
            $table->decimal('dis_price',15,2)->default(0);
            $table->integer('product_category_id');
            $table->integer('brand_id');
            $table->string('avatar_image');
            $table->text('images');
            $table->text('short_desc');
            $table->text('content');
            $table->boolean('publish');
            $table->boolean('highlight');
            $table->boolean('lastest');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
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
        Schema::dropIfExists('products');
    }
}
