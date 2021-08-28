<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberTypePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_type', function (Blueprint $table) {
            $table->unsignedBigInteger('member_id')->index();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->unsignedBigInteger('type_id')->index();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->primary(['member_id', 'type_id']);
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
        Schema::dropIfExists('member_type');
    }
}
