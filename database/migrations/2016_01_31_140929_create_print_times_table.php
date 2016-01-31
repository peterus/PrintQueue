<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('print_job_id')->unsigned();
            $table->integer('slicer_setting_id')->unsigned();
            $table->string('gcode');
            $table->integer('time');
            $table->integer('fillament');
            $table->timestamps();

            $table->foreign('print_job_id')
                ->references('id')
                ->on('print_jobs')
                ->onDelete('cascade');
            $table->foreign('slicer_setting_id')
                ->references('id')
                ->on('slicer_settings')
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
        Schema::drop('print_times');
    }
}
