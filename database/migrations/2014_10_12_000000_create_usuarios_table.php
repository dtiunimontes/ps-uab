<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration{
    public function up(){
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 80);
            $table->string('email', 75)->unique();
            $table->string('password');
            $table->string('cpf', 11)->unique();
            $table->string('rg', 20)->unique();
            $table->string('org_exped', 10);
            $table->date('data_nasc');
            $table->string('telefone', 11);
            $table->string('necessidade_especial', 255)->nullable();
            $table->integer('permissao')->default(1);
            $table->integer('cep');
            $table->string('logradouro', 80);
            $table->integer('numero');
			$table->string('complemento', 40)->nullable();
			$table->string('cidade', 50);
			$table->string('bairro', 30);
            $table->string('estado', 2);
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('usuarios');
    }
}
