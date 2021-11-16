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
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->unsignedBigInteger('ticket_code')->nullable();
            $table->integer('price')->nullable();
            $table->string('note')->nullable();
            $table->string('vnp_response_code')->nullable();
            $table->string('code_vnpay')->nullable();
            $table->string('code_bank')->nullable();
            $table->dateTime('time')->nullable();
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
