<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('lang',5)->default('az');
            $table->string('image',512)->nullable();
            $table->string('full_name',255);
            $table->text('bio')->nullable();
            $table->json('data')->nullable();
            $table->string('email',255)->unique();
            $table->string('phone',255)->unique();
            $table->string('password',255);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('users');
    }
}
