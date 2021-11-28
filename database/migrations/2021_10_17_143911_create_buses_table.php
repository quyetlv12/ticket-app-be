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
            $table->string('image')->nullable();
            $table->integer('seat')->default(0);
            $table->integer('price')->default(0);
            $table->string('startPointName');
            $table->integer('startPointId');
            $table->string('endPointName');
            $table->integer('endPointId');
            $table->integer('startWard_id');
            $table->string('startWard_name');
            $table->integer('startDisrict_id');
            $table->string('startDistrict_name');
            $table->integer('endWard_id');
            $table->string('endWard_name');
            $table->integer('endDisrict_id');
            $table->string('endDistrict_name');
            $table->string('detailAddressStart ');
            $table->string('detailAddressEnd');
            $table->integer('seat_empty');
            $table->date('date_active');
            $table->string('start_time');
            $table->string('range_time');
            $table->string('end_time');
            $table->string('status')->default('ACTIVED');
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
