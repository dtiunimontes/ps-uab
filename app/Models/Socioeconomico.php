<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socioeconomico extends Model {

    protected $table = 'socioeconomico';

    protected $fillable = [
        'usuario_id', 'inscricao_id', 'nome_mae', 'nome_pai', 'questao1', 'questao2', 'questao3', 'questao4', 'questao5', 'questao6', 'questao7', 'questao8', 'questao9', 'questao10', 'questao11', 'questao12'
    ];

    public function usuarios(){
        return $this->hasMany(Usuario::class, 'id', 'usuario_id');
    }

}
