<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('role_id')->default(1);
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade');
            $table->string('login',100);
            $table->string('avatar')->default('avatar-defoult.jpg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_id');
            $table->dropForeign(['role_id']);
            $table->dropColumn('avatar');
        });
    }
}
