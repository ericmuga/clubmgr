<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableZoomUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->integer('type')->nullable();
            $table->string('pmi')->nullable();
            $table->string('dept')->nullable();
            $table->dateTimeTz('last_login_time')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('status');
            $table->string('role_id');
            //$table->string('pic_url')->nullable();
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
        Schema::dropIfExists('zoom_users');
    }
}
