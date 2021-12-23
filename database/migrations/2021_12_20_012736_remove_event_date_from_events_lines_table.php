<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveEventDateFromEventsLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('event_lines');

        Schema::create('event_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('makeup_event_id');
            $table->string('event_type');
            $table->string('event_description');
            $table->date('event_date');
            $table->string('event_club');
            $table->string('status')->default('Pending Appoval');
            $table->string('comment');
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
        Schema::table('event_lines', function (Blueprint $table) {
            $table->string('event_date')->change();
           // $table->dropColumn('event_date');
            $table->boolean('comment')->change();
            // $table->dropColumn('comment');
           
        });
    }
}
