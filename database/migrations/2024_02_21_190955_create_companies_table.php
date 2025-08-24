<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->index('category_id');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->integer('parent_id')->nullable();//borani nermanof filiali
            $table->string('lang',5)->default('az');
            $table->string('image',512)->nullable();
            $table->string('full_name',255);
            $table->text('text')->nullable();
            $table->json('data')->nullable();
            $table->string('email',255)->unique();
            $table->string('phone',255)->unique();
            $table->string('password',255);
            $table->tinyInteger('status')->default(0);
            $table->string('type',10)->default('main');
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
        Schema::dropIfExists('companies');
    }
}
