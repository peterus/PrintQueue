<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlicerSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slicer_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('slicer_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('slicer_id')
                ->references('id')
                ->on('slicers')
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
        Schema::drop('slicer_settings');
    }
}
