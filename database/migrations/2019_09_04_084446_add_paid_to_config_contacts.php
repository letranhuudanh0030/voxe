<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaidToConfigContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('config_contacts', function (Blueprint $table) {
            $table->text('work_footer');
            $table->text('commit_footer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('config_contacts', function (Blueprint $table) {
            $table->dropColumn('work_footer');
            $table->dropColumn('commit_footer');
        });
    }
}
