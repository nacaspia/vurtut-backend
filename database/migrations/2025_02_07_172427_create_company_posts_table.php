<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_posts', function (Blueprint $table) {
            $table->id();
            $table->index('company_id');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('title',255)->nullable();
            $table->string('image',512);
            $table->integer('reads')->index()->default(0);
            $table->integer('like')->index()->default(0);
            $table->integer('share')->index()->default(0);
            $table->tinyInteger('status')->index()->default(0);
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
        Schema::dropIfExists('company_posts');
    }
}
