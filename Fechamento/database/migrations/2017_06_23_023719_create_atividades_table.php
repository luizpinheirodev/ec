<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('float')->nullable();
            $table->time('float_hora')->nullable();
            $table->integer('duracao')->nullable();
            $table->integer('usuario_id')->unsigned()->nullable();
            $table->integer('gerencia_id')->unsigned()->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            //$table->char('is_deleted', 1)->default('N');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('atividades', function (Blueprint $table) {
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('gerencia_id')->references('id')->on('gerencias');
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atividades');
    }
}
