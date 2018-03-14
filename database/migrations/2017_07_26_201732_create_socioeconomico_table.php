<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocioeconomicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socioeconomico', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->integer('inscricao_id')->unsigned();
            $table->foreign('inscricao_id')->references('id')->on('inscricao');
            $table->string('nome_mae', 200);
            $table->string('nome_pai', 200)->nullable();
            $table->integer('questao1');
            $table->integer('questao2');
            $table->integer('questao3');
            $table->integer('questao4');
            $table->integer('questao5');
            $table->integer('questao6');
            $table->integer('questao7');
            $table->integer('questao8');
            $table->integer('questao9');
            $table->integer('questao10');
            $table->integer('questao11');
            $table->integer('questao12');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socioeconomico');
    }
}
