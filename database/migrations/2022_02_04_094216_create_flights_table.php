<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->enum('type', ["PASSENGER", "FREIGHT"]);
            $table->time('arrival_time');
            $table->time('departure_time');
            $table->unsignedInteger('departure_id')->nullable();
            $table->unsignedInteger('destination_id')->nullable();
            $table->unsignedInteger('airline_id')->nullable();
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
        Schema::dropIfExists('flights');
    }
}
