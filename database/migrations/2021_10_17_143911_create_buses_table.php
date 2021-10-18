<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('cartype_id');
            $table->unsignedBigInteger('route_id');
            $table->string('image')->nullable();
            $table->integer('seat')->default(0);
            $table->integer('price')->default(0);
            $table->date('date_active');
            $table->string('start_time');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('buses');
    }
}
