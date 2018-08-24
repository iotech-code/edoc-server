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
            $table->string('code');
            $table->string('from');
            $table->string('date');
            $table->string('title');
            $table->string('receive_code');
            $table->string('receive_date');
            $table->string('receive_achives');
            $table->string('refer')->default(null);
            $table->string('keywords');
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedInteger('cabinet_id');
            $table->timestamp('read_at')->default(null);
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
