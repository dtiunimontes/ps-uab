<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model{
    protected $table = 'cursos';

    protected $fillable = [
        'nome',
    ];

    public function polos(){
        return $this->hasMany(Polo::class);
    }

    public function inscricoes(){
        return $this->hasMany(Inscricao::class);
    }
}
