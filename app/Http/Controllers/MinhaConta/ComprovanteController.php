<?php

namespace App\Http\Controllers\MinhaConta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inscricao;
use Illuminate\Support\Facades\Auth;
use PDF;

class ComprovanteController extends Controller{
    public function pdf() {
        //$inscricao = Inscricoes::where('usuarios_id',Auth::id())->where('status',1);
        $inscricao = Inscricao::where('usuario_id', Auth::id())//->with('usuario', 'polo')
        ->where('status', '!=', '0')
        // DB::table('inscricoes')//->where('status',1)
        ->join('usuarios', 'usuarios.id', '=', 'inscricao.usuario_id')
        ->join('cursos', 'cursos.id', '=', 'inscricao.polo_curso_id')
        ->join('polos as polo', 'polo.id', '=', 'inscricao.polo_id')
        ->join('polos as local_prova', 'local_prova.id', '=', 'inscricao.local_prova')
        ->select(
            'inscricao.id as id_inscricao',
            'usuarios.nome as nome_completo',
            'usuarios.cpf as cpf',
            'cursos.nome as curso',
            'polo.nome as cidade',
            'local_prova.nome as local',
            'inscricao.created_at as data_inscricao',
            'usuarios.id as usuario_id',
            'inscricao.status as status')
            ->first();
        //return $inscricao;
        //var_dump($inscricao);
        //return view('minhaconta.comprovante', compact('inscricao'));
        $pdf = PDF::loadView('minhaconta.comprovante', compact('inscricao'));
        return $pdf->stream();
        //return view('minhaconta.inscricoes.comprovante', compact('inscricao'));
    }
}
