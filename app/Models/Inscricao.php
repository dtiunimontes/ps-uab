<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model{
    protected $table = 'inscricao';

    protected $fillable = [
        'modalidade', 'usuario_id', 'local_prova', 'polo_curso_id', 'polo_id', 'valor', 'vencimento', 'numero_dae', 'mes_referencia',
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }

    public function polo(){
        return $this->belongsTo(Polo::class);
    }

    public function curso(){
        return $this->belongsTo(Curso::class);
    }
}
