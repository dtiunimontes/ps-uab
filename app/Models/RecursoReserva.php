<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecursoReserva extends Model{
    protected $table = 'recurso_reserva';

    protected $fillable = [
        'status', 'usuario_id'
    ];

}
