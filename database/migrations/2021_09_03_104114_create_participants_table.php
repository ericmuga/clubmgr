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
            $table->string('instance_uuid')->nullable();
            $table->string('participant_id')->nullable();
            $table->string('user_id');
            $table->string('name');
            $table->string('user_email');
            $table->dateTimeTz('join_time');
            $table->dateTimeTz('leave_time');
            $table->integer('duration');
            $table->string('registrant_id');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['meeting_id','instance_uuid','user_id']);
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
