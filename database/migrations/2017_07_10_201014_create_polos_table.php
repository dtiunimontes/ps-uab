<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolosTable extends Migration{
    public function up(){
        Schema::create('polos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('curso_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('cursos');            
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('polos');
    }
}
