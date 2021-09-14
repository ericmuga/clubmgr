<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrants', function (Blueprint $table) {
            $table->id();
            $table->string("registrant_id")->nullable();
            $table->string('meeting_id')
                  ->foreign()
                  ->references('meeting_id')
                  ->on('meetings')
                  ->onDelete('cascade');
            $table->string('uuid')->nullable();
            $table->string('occurrence_id')->nullable();
            $table->string('email');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('category')->nullable();
            $table->string('club_name')->nullable();
            $table->string('invited_by')->nullable();
            $table->string('classification')->nullable();
            $table->dateTimeTz('create_time')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['meeting_id','email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrants');
    }
}
