<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('makeup_event_id');
            $table->string('event_type');
            $table->string('event_description');
            $table->string('event_date');
            $table->string('status')->default('Pending App');
            $table->boolean('comment');
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
        Schema::dropIfExists('event_lines');
    }
}
