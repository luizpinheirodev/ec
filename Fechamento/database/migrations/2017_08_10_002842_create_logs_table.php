<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('atividade_id')->unsigned();
            $table->string('tipo')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('logs', function (Blueprint $table) {
            $table->foreign('atividade_id')->references('id')->on('atividade__periodos');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
