<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model{
    protected $table = 'enderecos';

    protected $fillable = [
        'logradouro', 'numero', 'complemento', 'cidade', 'bairro', 'estado',
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }
}
