<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscricaoTable extends Migration{
     public function up(){
         Schema::create('inscricao', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('usuario_id')->unsigned();
             $table->foreign('usuario_id')->references('id')->on('usuarios');
             $table->integer('local_prova')->unsigned();
             $table->foreign('local_prova')->references('id')->on('polos');
             $table->integer('polo_id')->unsigned();
             $table->foreign('polo_id')->references('id')->on('polos');
             $table->integer('polo_curso_id')->unsigned();
             $table->foreign('polo_curso_id')->references('curso_id')->on('polos');
             $table->enum('modalidade', ['universal', 'afrodescendente', 'escola_publica', 'deficiencia_indigena']);
             $table->integer('status')->default(1);
             $table->string('valor', 10);
             $table->date('vencimento')->nullable();
             $table->string('numero_dae')->nullable();
             $table->date('mes_referencia')->nullable();
             $table->string('recursos')->nullable();
             $table->timestamps();
         });
     }
     public function down(){
         Schema::dropIfExists('inscricao');
     }
}
