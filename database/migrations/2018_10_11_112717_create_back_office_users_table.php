<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackOfficeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('back_office_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->unique();
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->rememberToken();
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
        Schema::dropIfExists('back_office_users');
    }
}
