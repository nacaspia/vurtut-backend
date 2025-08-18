<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->index('company_id');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->index('user_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('date');
            $table->string('full_name',255);
            $table->string('phone',13);
            $table->integer('place_count');
            $table->integer('person_count');
            $table->text('text');
            $table->text('company_text')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('reservations');
    }
}
