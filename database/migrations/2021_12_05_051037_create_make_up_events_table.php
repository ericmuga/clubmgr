<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakeUpEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('make_up_events', function (Blueprint $table) {
            $table->id();
            $table->string('member_email');
            $table->sting('member_phone')->nullable();
            $table->string('grader_email')->nullable();
            $table->string('graded')->default('Pending Review');
            $table->timestamps();
        });


        Schema::dropIfExists('makeups');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('make_up_events');
    }
}
