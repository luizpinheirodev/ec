<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDependenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('atividade_id1')->unsigned();
            $table->integer('atividade_id2')->unsigned();
            //$table->char('is_deleted', 1)->default('N');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('dependencias', function (Blueprint $table) {
            $table->foreign('atividade_id1')->references('id')->on('atividades');
            $table->foreign('atividade_id2')->references('id')->on('atividades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dependencias');
    }
}
