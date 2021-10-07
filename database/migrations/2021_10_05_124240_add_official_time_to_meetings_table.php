<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOfficialTimeToMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->dateTimeTz('official_start_time')->nullable();
            $table->dateTimeTz('official_end_time')->nullable();
            $table->integer('grading_rule_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->dropColumn('official_start_time');
            $table->dropColumn('official_end_time');
            $table->dropColumn('grading_rule_id');
        });
    }
}
