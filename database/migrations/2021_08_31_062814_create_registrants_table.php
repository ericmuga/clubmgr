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
            $table->integer('meeting_id')
                  ->foreign()
                  ->references('id')
                  ->on('meetings')
                  ->onDelete('cascade');
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('category');
            $table->string('club_name');
            $table->string('invited_by');
            $table->string('classification');
            $table->dateTimeTz('create_time');
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
        Schema::dropIfExists('registrants');
    }
}
