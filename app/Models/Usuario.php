<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable{
    use Notifiable;
    protected $table = 'usuarios';

    protected $fillable = [
        'nome', 'cpf', 'email', 'password', 'rg', 'org_exped', 'data_nasc','telefone', 'necessidade_especial', 'cep',
        'logradouro',
        'numero',
        'complemento',
        'cidade',
        'bairro',
        'estado',
        'formacao',
        'curso',
        'instituicao',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function endereco(){
        return $this->hasOne(Endereco::class);
    }

    public function formacao(){
        return $this->hasOne(Formacao::class);
    }

    public function inscricao(){
        return $this->hasOne(Inscricao::class);
    }
}
