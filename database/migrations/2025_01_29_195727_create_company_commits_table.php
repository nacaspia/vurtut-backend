<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyCommitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_commits', function (Blueprint $table) {
            $table->id();
            $table->index('company_id');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->index('user_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('committer_id')->nullable();
            $table->integer('committer_user_id')->nullable();
            $table->text('comment')->nullable();
            $table->string('image_comment',512)->nullable();
            $table->integer('cleanliness')->index()->default(0);
            $table->integer('comfort')->index()->default(0);
            $table->integer('staf')->index()->default(0);
            $table->integer('facilities')->index()->default(0);
            $table->integer('reads')->index()->default(0);
            $table->integer('like')->index()->default(0);
            $table->integer('share')->index()->default(0);
            $table->date('date')->nullable();
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
        Schema::dropIfExists('company_commits');
    }
}
