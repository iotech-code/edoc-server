<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('type_id');
            $table->string('code');
            // $table->string('from');
            // $table->string('heading')->nullable();
            $table->date('date');
            $table->string('title');
            $table->string('receive_code');
            $table->date('receive_date');
            $table->unsignedInteger('approved_user_id')
                ->nullable();
            $table->unsignedInteger('reply_type_id')
                ->nullable();
            $table->unsignedInteger('send_to_cabinet_id');
            $table->string('keywords');
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedInteger('cabinet_id');
            $table->unsignedInteger('folder_id');

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
        Schema::dropIfExists('documents');
    }
}
