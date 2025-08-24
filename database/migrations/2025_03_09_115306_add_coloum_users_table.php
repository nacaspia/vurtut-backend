<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('background_image',512)->nullable()->after('image');
            $table->integer('country_id')->nullable()->after('background_image');//Azərbaycan
            $table->integer('city_id')->nullable()->after('country_id');;//Baku
            $table->integer('sub_region_id')->nullable()->after('city_id');;//Nermanov
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
