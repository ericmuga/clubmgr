<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAffiliationMemberPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliation_member', function (Blueprint $table) {
            $table->unsignedBigInteger('affiliation_id')->index();
            $table->foreign('affiliation_id')->references('id')->on('affiliations')->onDelete('cascade');
            $table->unsignedBigInteger('member_id')->index();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->primary(['affiliation_id', 'member_id']);
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
        Schema::dropIfExists('affiliation_member');
    }
}
