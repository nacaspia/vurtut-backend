<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('payment_type', ['deposit', 'withdraw', 'subscription', 'other'])->nullable();
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'canceled'])->default('pending');
            $table->decimal('payment_amount', 12, 2);
            $table->timestamp('payment_date')->nullable();
            $table->string('payment_method', 100)->nullable();
            $table->string('payment_reference', 150)->nullable();
            $table->text('payment_description')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
