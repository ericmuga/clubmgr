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
            $table->string('uuid')->unique();
            $table->string('meeting_id')->unique();
            $table->string('host_id');
            $table->string('topic');
            $table->integer('type');
            $table->dateTimeTz('start_time');
            $table->integer('duration');
            $table->string('timezone');
            $table->string('join_url');
            $table->string('meeting_type');
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
