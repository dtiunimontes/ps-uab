<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration{
    public function up(){
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logradouro', 50);
            $table->integer('numero');
			$table->string('complemento', 40);
			$table->string('cidade', 50);
			$table->string('bairro', 30);
            $table->string('estado', 25);
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('enderecos');
    }
}
