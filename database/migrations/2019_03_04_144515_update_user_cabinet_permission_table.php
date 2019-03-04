<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserCabinetPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_cabinet_permission', function (Blueprint $table) {

            $table->dropForeign('user_cabinet_permission_user_id_foreign');
            $table->dropForeign('user_cabinet_permission_cabinet_id_foreign');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cabinet_id')->references('id')->on('cabinets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_cabinet_permission', function (Blueprint $table) {
            //
        });
    }
}
