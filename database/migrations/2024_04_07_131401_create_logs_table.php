<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->integer('obj_id')->index()->nullable();
            $table->integer('subj_id')->index()->nullable();
            $table->string('subj_table',100)->nullable();
            $table->string('action',255)->nullable();
            $table->text('note')->nullable();
            $table->string('type',20)->default('company');
            $table->string('ip_address')->nullable();
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
        Schema::dropIfExists('company_logs');
    }
}
