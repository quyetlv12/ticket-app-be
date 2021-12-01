<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_code')->unique();
            $table->unsignedBigInteger('buses_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('customer_name');
            $table->string('email');
            $table->string('phone_number');
            $table->integer('quantity')->default(1);
            $table->string('identity_card');
            $table->string('status')->default('WAITING_ACTIVE');
            $table->string('paymentMethod')->default('OFFLINE');
            $table->integer('totalPrice')->default(0);
            $table->integer('depositAmount')->nullable();
            $table->date('reservationTime')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
