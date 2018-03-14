<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Polo extends Model{

    protected $fillable = [
        'nome', 'curso_id'
    ];

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function inscricoes(){
        return $this->hasMany(Inscricao::class);
    }
}
