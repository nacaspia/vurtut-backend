<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_logs', function (Blueprint $table) {
            $table->id();
            $table->index('cms_user_id');
            $table->foreignId('cms_user_id')->constrained('cms_users')->onDelete('cascade');
            $table->integer('subj_id')->index()->nullable();
            $table->string('subj_table',100)->nullable();
            $table->string('action',255)->nullable();
            $table->json('note')->nullable();
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
        Schema::dropIfExists('logs');
    }
}
