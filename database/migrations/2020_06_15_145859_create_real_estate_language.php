<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstateLanguage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_language', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('estate_id');
            $table->unsignedInteger('language_id');
            $table->string('title')->nullable();
            $table->text('contact')->nullable();
            $table->text('description')->nullable();
            $table->text('condition')->nullable();
            $table->text('functional_subdivision')->nullable();
            $table->text('infrastructure')->nullable();
            $table->text('investment_costs')->nullable();
            $table->text('career')->nullable();
            $table->text('incentives')->nullable();
            $table->text('suport')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('slug')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->text('meta_desc')->nullable();
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
        Schema::dropIfExists('real_estate_language');
    }
}
