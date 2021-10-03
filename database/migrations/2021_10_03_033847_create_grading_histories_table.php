<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradingHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grading_histories', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->dateTime('from');
            $table->dateTime('to');
            $table->string('meeting_id');
            $table->string('category');
            $table->string('grading_rule_id');
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
        Schema::dropIfExists('grading_histories');
    }
}
