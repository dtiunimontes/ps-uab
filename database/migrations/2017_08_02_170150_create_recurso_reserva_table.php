<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecursoReservaTable extends Migration{

    public function up(){
        Schema::create('recurso_reserva', function (Blueprint $table){
            $table->increments('id');
            $table->text('justificativa')->nullable();
            $table->text('recurso')->nullable();
            $table->text('resposta_recurso')->nullable();
            $table->integer('status');
            $table->datetime('data_recurso')->nullable();
            $table->datetime('data_resposta_recurso')->nullable();
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->integer('autor')->unsigned()->nullable();
            $table->foreign('autor')->references('id')->on('usuarios');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('recurso_reserva');
    }
}
