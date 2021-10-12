<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMinimumGradableMembersToSetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setup', function (Blueprint $table) {
            $table->integer('minimum_gradable_members')->default(10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setup', function (Blueprint $table) {
         $table->dropColumn('minimum_gradable_members');
        });
    }
}
