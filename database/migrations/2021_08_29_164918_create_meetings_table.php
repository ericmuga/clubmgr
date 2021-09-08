<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique()->nullable();
            $table->string('meeting_id')->unique();
            $table->string('host_id')->nullable();
            $table->string('guest_speaker')->nullable();
            $table->string('topic');
            $table->integer('type')->nullable();
            $table->dateTimeTz('start_time');
            $table->integer('duration')->nullable();
            $table->string('timezone');
            $table->string('join_url')->nullable();
            $table->integer('meeting_type');
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
        Schema::dropIfExists('meetings');
    }
}
