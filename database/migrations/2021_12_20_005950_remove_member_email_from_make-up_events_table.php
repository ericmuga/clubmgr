<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveMemberEmailFromMakeUpEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('make_up_events', function (Blueprint $table) {
            $table->dropColumn('member_email');
            $table->foreignId('member_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('make_up_events', function (Blueprint $table) {
            $table->string('member_email');
            $table->dropColumn('member_id');
        });
    }
}
