<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveMemberPhoneFromMakeUpEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('make_up_events', function (Blueprint $table) {
            $table->dropColumn('member_phone');
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
            $table->string('member_phone');
        });
    }
}
