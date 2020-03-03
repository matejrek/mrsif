<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasurmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('value');
            $table->unsignedBigInteger('tracker_id');

            $table->timestamps();

            $table->foreign('tracker_id')
                ->references('id')
                ->on('trackers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measurments');
    }
}
