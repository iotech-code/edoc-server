<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('document_id');
                $table->foreign('document_id')->references('id')->on('documents');
            // 1 => inbox
            // 2 => sentbox
            $table->unsignedTinyInteger('document_user_status');
            $table->boolean('is_read')->default(0);
            // $table->unsignedTinyInteger('type');
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
        Schema::dropIfExists('documents_users');
    }
}
