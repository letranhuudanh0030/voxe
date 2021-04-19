<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('footer')->nullable();
            $table->text('contact_page')->nullable();
            $table->text('support')->nullable();
            $table->string('email_name')->nullable();
            $table->string('email_rece')->nullable();
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
        Schema::dropIfExists('config_contacts');
    }
}
