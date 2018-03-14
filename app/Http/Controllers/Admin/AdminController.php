<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Facades\Datatables;
use App\Models\Inscricao;
use App\Models\Usuario;
use App\Models\Polo;
use App\Models\Curso;
use App\Models\RecursoReserva;
use DB;

class AdminController extends Controller{

    public function index(){
        return view('admin.home');
    }

    public function todos(){
        return view('admin.candidatos.ver_todos');
    }

    public function curso_polo(){
        $cursos = Curso::all();
        return view('admin.candidatos.candidato_curso_polo', compact('cursos'));
    }

    public function listar(Request $request){
        $inscricao_id = $request['inscricao'];
        $polo = Polo::find($request['polo_id']);
        $curso = Curso::find($request['curso_id']);
        if ($inscricao_id == 0) {
            $inscricao = 'Inscrições Canceladas';
        } elseif ($inscricao_id == 1) {
            $inscricao = 'Aguardando Pagamento';
        } elseif ($inscricao_id == 2) {
            $inscricao = 'Isento';
        } elseif ($inscricao_id == 3) {
            $inscricao = 'Pago';
        } elseif ($inscricao_id == 4) {
            $inscricao = 'Todas Inscrições';
        }
        return view('admin.candidatos.curso_polo', compact('curso', 'polo', 'inscricao', 'inscricao_id'));
    }

    public function ver_todos(){
        // $usuarios = Inscricao::all()->with('usuario')->get();
        $usuarios = DB::table('usuarios')
    		->join('inscricao','usuarios.id','inscricao.usuario_id')
        ->select('usuarios.nome', 'usuarios.cpf', 'usuarios.email', 'usuarios.id', 'inscricao.status', 'modalidade')
        ->where('status', '!=', 0)
    		->get();

        return Datatables::of($usuarios)
        ->addColumn('action', function ($usuario) {
            $ver = '<form class="presenca hidden-print" method="get" action="'.route("admin.candidatos.ver", $usuario->id).'" style="float:left;">'.csrf_field().'<button type="submit" class="btn blue btn-xs" style="margin-top: -1px;">Ver</button></form>';
            $editar = '<form class="presenca hidden-print" method="get" action="'.route("admin.candidatos.editar", $usuario->id).'" style="float:left;">'.csrf_field().'<button type="submit" class="btn green btn-xs" style="margin-top: -1px;">Editar</button></form>';
            // $isentar = '<form class="presenca hidden-print" method="get" action="'.route("admin.candidatos.isentar", $usuario->id).'" style="float:left;">'.csrf_field().'<button type="submit" class="btn yellow btn-xs" style="margin-top: -1px;">Isentar</button></form>';
            return '<div class="btn-group btn-group-xs btn-group-solid">'.$ver.$editar.'</div> ';
          })
        ->editColumn('status', function ($usuario) {
            if ($usuario->status == 0) {
              $label = 'Inscrição Cancelada';
            } elseif ($usuario->status == 1) {
    					$label = 'Aguardando Pagamento';
    				} elseif ($usuario->status == 2) {
    					$label = 'Isento';
    				} elseif ($usuario->status == 3) {
              $label = 'Pago';
            }
    				return $label;
          })
          ->editColumn('modalidade', function ($usuario) {
              if ($usuario->modalidade == 'afrodescendente') {
                $label = 'Afrodescendente';
              } elseif ($usuario->modalidade == 'universal') {
                $label = 'Universal';
              } elseif ($usuario->modalidade == 'escola_publica') {
                $label = 'Escola Pública';
              } elseif ($usuario->modalidade == 'deficiencia_indigena') {
                $label = 'Deficiente / Indígena';
              }
              return $label;
            })
        ->make(true);
    }

    public function ver($id){
        $usuario = Usuario::find($id);
        $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')
                    ->with('polo')->first();

        $local_prova = Polo::find($inscricao->local_prova);
        $polos = Polo::all();
        $cursos = Curso::all();
        $curso = Curso::find($inscricao->polo->curso_id);
        $ver = 1;
        return view('admin.candidatos.ver_editar', compact('usuario', 'ver', 'polos', 'local_prova', 'cursos', 'curso', 'inscricao'));
    }

    public function editar($id){
        $usuario = Usuario::find($id);
        $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')
                    ->with('polo')->first();
        $local_prova = Polo::find($inscricao->local_prova);
        $polos = Polo::all();
        $cursos = Curso::all();
        $curso = Curso::find($inscricao->polo->curso_id);
        $ver = 0;
        return view('admin.candidatos.ver_editar', compact('usuario', 'ver', 'polos', 'local_prova', 'cursos', 'curso', 'inscricao'));
    }

    public function isentar($id){
        $usuario = Usuario::find($id);
        $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')
                    ->with('polo')->first();
        $inscricao->status = 2;
        $inscricao->save();
        return redirect()->route('admin.candidatos.home');
    }

    public function salvar(Request $request){
        $usuario = Usuario::find($request['id']);

        list($dia, $mes, $ano) = explode('/', $request['data_nasc']);
        $usuario->nome = $request['nome'];
        $usuario->email = $request['email'];
        if($request['password'] != null){
            $usuario->password = bcrypt($request['password']);
        }
        $usuario->cpf = $request['cpf'];
        $usuario->rg = $request['rg'];
        $usuario->org_exped = $request['org_exped'];
        $usuario->data_nasc = $ano.'-'.$mes.'-'.$dia;
        $usuario->telefone = $request['telefone'];
        $usuario->necessidade_especial = $request['necessidade_especial'];
        $usuario->cep = $request['cep'];
        $usuario->logradouro = $request['logradouro'];
        $usuario->numero = $request['numero'];
        $usuario->complemento = $request['complemento'];
        $usuario->cidade = $request['cidade'];
        $usuario->bairro = $request['bairro'];
        $usuario->estado = $request['estado'];
        $usuario->save();

        Inscricao::where('usuario_id', $usuario->id)
        ->where('status', '!=', '0')
        ->update([
            'modalidade' => $request['modalidade'],
            'local_prova' => $request['local_prova'],
            'polo_id' => $request['polo_id'],
            'polo_curso_id' => $request['polo_curso_id'],
        ]);

        return redirect()->route('admin.home');
    }
}
