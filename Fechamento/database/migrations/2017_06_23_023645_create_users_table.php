<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('ramal');
            $table->integer('gerencia_id')->unsigned();
            $table->integer('gerente_id')->unsigned()->nullable();
            $table->integer('nivel');
            $table->string('foto')->nullable();
            //$table->char('is_deleted', 1)->default('N');
            $table->rememberToken();
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('gerencia_id')->references('id')->on('gerencias');
            $table->foreign('gerente_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
