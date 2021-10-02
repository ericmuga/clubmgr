<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordingsTable extends Migration
{
    /**
     * Run the migrations.
     *{
     */
    public function up()
    {
        Schema::create('recordings', function (Blueprint $table) {
            $table->id();
            $table->string('recording_id');
            $table->string('meeting_id');
            $table->string('instance_uuid');
            $table->string('file_type');
            $table->integer('file_size');
            $table->string('play_url')->nullable();
            $table->string('download_url')->nullable();
            $table->string('status');
            $table->string('recording_type');
            $table->dateTimeTz('recording_start');
            $table->dateTimeTz('recording_end');
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
        Schema::dropIfExists('recordings');
    }
}
