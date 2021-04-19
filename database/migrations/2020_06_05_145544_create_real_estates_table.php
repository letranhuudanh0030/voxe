<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->unsignedInteger('product_category_id');
            $table->unsignedInteger('city_code')->default(0);
            $table->unsignedInteger('district_code')->default(0);
            $table->unsignedInteger('ward_code')->default(0);
            $table->unsignedInteger('region_code')->default(0);
            $table->decimal('price', 15, 2)->default(0);
            $table->tinyInteger('currency')->default(0);
            $table->double('acreage')->default(0);
            $table->tinyInteger('unit_area')->default(0);
            $table->text('description')->nullable();
            $table->text('condition')->nullable();
            $table->string('avatar_image')->nullable();
            $table->text('images')->nullable();
            $table->text('contact')->nullable();
            $table->boolean('publish')->default(1);
            $table->boolean('highlight')->default(0);
            $table->boolean('lastest')->default(0);
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_desc')->nullable();
            $table->text('functional_subdivision')->nullable();
            $table->text('infrastructure')->nullable();
            $table->text('investment_costs')->nullable();
            $table->text('career')->nullable();
            $table->text('incentives')->nullable();
            $table->text('suport')->nullable();
            $table->string('type_spec')->nullable();
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
        Schema::dropIfExists('real_estates');
    }
}
