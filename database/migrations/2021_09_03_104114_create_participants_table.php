<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('meeting_id');
            $table->string('participant_id');
            $table->string('user_id')->unique();
            $table->string('name');
            $table->string('user_email');
            $table->dateTimeTz('join_time');
            $table->dateTimeTz('leave_time');
            $table->integer('duration');
            $table->string('registrant_id');
            $table->softDeletes();
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
        Schema::dropIfExists('participants');
    }
}
