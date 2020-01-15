<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('tracker_id');
            $table->double('gps_longitude');
            $table->double('gps_latitude');
            $table->timestamp('time_received')->default(Carbon::now());
            $table->boolean('is_found')->default(false);
            $table->timestamps();

            $table->foreign('tracker_id')->references('id')->on('trackers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
