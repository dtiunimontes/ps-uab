<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration{
    public function up(){
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('cursos');
    }
}
