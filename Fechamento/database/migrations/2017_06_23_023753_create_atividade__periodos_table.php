<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtividadePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividade__periodos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('periodo_id')->unsigned();
            $table->integer('atividade_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->boolean('conclusao')->default(false);
            $table->integer('concluido_user_id')->unsigned()->nullable();
            $table->dateTime('previsao')->nullable();
            //$table->char('is_deleted', 1)->default('N');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('atividade__periodos', function (Blueprint $table) {
            $table->foreign('periodo_id')->references('id')->on('periodos');
            $table->foreign('atividade_id')->references('id')->on('atividades');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('concluido_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atividade__periodos');
    }
}
