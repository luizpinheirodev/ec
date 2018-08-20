<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('texto');
            $table->integer('usuario_id')->unsigned();
            $table->integer('atividade_periodo_id')->unsigned()->nullable();
            $table->integer('resposta_id')->unsigned()->nullable();
            $table->string('anexo')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('comentarios', function (Blueprint $table) {
            $table->foreign('atividade_periodo_id')->references('id')->on('atividade__periodos');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('resposta_id')->references('id')->on('comentarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}
