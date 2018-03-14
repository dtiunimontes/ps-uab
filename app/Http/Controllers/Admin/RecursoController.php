<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\RecursoReserva;
use App\Models\Inscricao;
use Datatables;

class RecursoController extends Controller{

    public function index(){
        return view('admin.recursos.home');
    }

    public function abertos(){
        return view('admin.recursos.aberto');
    }

    public function resposta($id){
        $rec = 1;
        $usuario = Usuario::find($id);
        $recurso = RecursoReserva::where('usuario_id', $usuario->id)->first();
        $inscricao = Inscricao::where('usuario_id', $usuario->id)
            ->where('status', '!=', '0')->first();
        return view('admin.recursos.analise_documento', compact('inscricao', 'usuario', 'recurso', 'rec'));
    }

    public function ver($id){
        $rec = 2;
        $usuario = Usuario::find($id);
        $recurso = RecursoReserva::where('usuario_id', $usuario->id)->first();
        $inscricao = Inscricao::where('usuario_id', $usuario->id)
            ->where('status', '!=', '0')->first();
        return view('admin.recursos.ver_editar_analise_documento', compact('inscricao', 'usuario', 'recurso', 'rec'));
    }

    public function responder(Request $request){
      $usuario = Usuario::find($request['id']);
      RecursoReserva::where('usuario_id', $usuario->id)
      ->update([
          'resposta_recurso_res' => $request['resposta_res'],
          'resposta_recurso' => $request['resposta_socio'],
          'data_resposta_recurso' => date('Y-m-d H:i')
      ]);
      $recurso = RecursoReserva::where('usuario_id', $usuario->id);
      if($request['socio']!=null && $request['acao']!=null ){
          if($request['socio'] == 'a'){
              // status 1 = recebido, 2 = deferido, 3 = indeferido
              RecursoReserva::where('usuario_id', $usuario->id)
              ->update([
                  'status_socio' => 2, // deferido
              ]);
              $inscricao = Inscricao::where('usuario_id', $usuario->id)
              ->where('status', '!=', '0')
              ->update([
                  'valor' => '00,00',
              ]);
              if($request['acao'] == 'deferido'){
                  $inscricao = Inscricao::where('usuario_id', $usuario->id)
                  ->where('status', '!=', '0')
                  ->update([
                      'reserva' => 1,
                  ]);
                  RecursoReserva::where('usuario_id', $usuario->id)
                  ->update([
                      'status_res' => 2,
                  ]);
              }elseif($request['acao'] == 'indeferido'){
                  $inscricao = Inscricao::where('usuario_id', $usuario->id)
                  ->where('status', '!=', '0')
                  ->update([
                      'reserva' => 2,
                  ]);
                  RecursoReserva::where('usuario_id', $usuario->id)
                  ->update([
                      'status_res' => 3,
                      'justificativa_res' => $request['justificativa_reserva'],
                  ]);
              }else{
                  $inscricao = Inscricao::where('usuario_id', $usuario->id)
                  ->where('status', '!=', '0')
                  ->update([
                      'reserva' => 0,
                  ]);
              }
              return redirect()->route('admin.candidatos.verificar', ['id' => $usuario->id])->with('success', "O pedido de {$usuario->nome} foi deferido com sucesso!");
          }elseif($request['socio'] == 'b'){
              // status 1 = recebido, 2 = deferido, 3 = indeferido
              RecursoReserva::where('usuario_id', $usuario->id)
              ->update([
                  'status_socio' => 2, // deferido
              ]);
              $inscricao = Inscricao::where('usuario_id', $usuario->id)
              ->where('status', '!=', '0')
              ->update([
                  'valor' => '29,00',
                  'vencimento' => '2017-11-14'
              ]);
              if($request['acao'] == 'deferido'){
                  $inscricao = Inscricao::where('usuario_id', $usuario->id)
                  ->where('status', '!=', '0')
                  ->update([
                      'reserva' => 1,
                  ]);
                  RecursoReserva::where('usuario_id', $usuario->id)
                  ->update([
                      'status_res' => 2,
                  ]);
              }elseif($request['acao'] == 'indeferido'){
                  $inscricao = Inscricao::where('usuario_id', $usuario->id)
                  ->where('status', '!=', '0')
                  ->update([
                      'reserva' => 2,
                  ]);
                  RecursoReserva::where('usuario_id', $usuario->id)
                  ->update([
                      'status_res' => 3,
                      'justificativa_res' => $request['justificativa_reserva'],
                  ]);
              }else{
                  $inscricao = Inscricao::where('usuario_id', $usuario->id)
                  ->where('status', '!=', '0')
                  ->update([
                      'reserva' => 0,
                  ]);
              }
              return redirect()->route('admin.candidatos.verificar', ['id' => $usuario->id])->with('success', "O pedido de {$usuario->nome} foi deferido com sucesso!");
          }elseif($request['socio'] == 'c'){
              // status 1 = recebido, 2 = deferido, 3 = indeferido
              RecursoReserva::where('usuario_id', $usuario->id)
              ->update([
                  'status_socio' => 2, // deferido
              ]);
              $inscricao = Inscricao::where('usuario_id', $usuario->id)
              ->where('status', '!=', '0')
              ->update([
                  'valor' => '42,00',
                  'vencimento' => '2017-11-14'
              ]);
              if($request['acao'] == 'deferido'){
                  $inscricao = Inscricao::where('usuario_id', $usuario->id)
                  ->where('status', '!=', '0')
                  ->update([
                      'reserva' => 1,
                  ]);
                  RecursoReserva::where('usuario_id', $usuario->id)
                  ->update([
                      'status_res' => 2,
                  ]);
              }elseif($request['acao'] == 'indeferido'){
                  $inscricao = Inscricao::where('usuario_id', $usuario->id)
                  ->where('status', '!=', '0')
                  ->update([
                      'reserva' => 2,
                  ]);
                  RecursoReserva::where('usuario_id', $usuario->id)
                  ->update([
                      'status_res' => 3,
                      'justificativa_res' => $request['justificativa_reserva'],
                  ]);
              }else{
                  $inscricao = Inscricao::where('usuario_id', $usuario->id)
                  ->where('status', '!=', '0')
                  ->update([
                      'reserva' => 0,
                  ]);
              }
              return redirect()->route('admin.candidatos.verificar', ['id' => $usuario->id])->with('success', "O pedido de {$usuario->nome} foi deferido com sucesso!");
          }elseif($request['socio'] == 'd'){
              // status 1 = recebido, 2 = deferido, 3 = indeferido
              RecursoReserva::where('usuario_id', $usuario->id)
              ->update([
                  'status_socio' => 3,
                  'status_res' => 3,
                  'justificativa' => $request['justificativa_socio'],
                  'justificativa_res' => $request['justificativa_reserva'],
              ]);
              $inscricao = Inscricao::where('usuario_id', $usuario->id)
              ->where('status', '!=', '0')
              ->update([
                  'valor' => '100,00',
                  'reserva' => 2,
                  'vencimento' => '2017-11-14'
              ]);
              return redirect()->route('admin.recursos.abertos', ['id' => $usuario->id])->with('success', "O pedido de {$usuario->nome} foi respondido com sucesso!");
          }
      }else{
          return redirect()->route('admin.candidatos.verificar')->with('danger', "Ouve um erro, tente novamente!");
      }
    }

    public function getAbertos(){
        $recursos = RecursoReserva::join('usuarios', 'usuario_id', 'usuarios.id')
        ->select('usuarios.id', 'status_socio', 'status_res', 'nome', 'cpf')
        ->where('data_recurso', '!=', 'NULL')
        ->whereNull('data_resposta_recurso')
        ->get();

        return Datatables::of($recursos)
        ->addColumn('action', function ($recurso) {
            $rec = '<form class="presenca hidden-print" method="post" action="'.route("admin.recursos.resposta", $recurso->id).'" style="float:left;">'.csrf_field().'<button type="submit" class="btn blue btn-xs" style="margin-top: -1px;">Responder</button></form>';
            // $editar = '<form class="presenca hidden-print" method="get" action="'.route("admin.candidatos.editar", $recurso->id).'" style="float:left;">'.csrf_field().'<button type="submit" class="btn green btn-xs" style="margin-top: -1px;">Editar</button></form>';
            // $ver = $editar = '';
            return '<div class="btn-group btn-group-xs btn-group-solid">'.$rec.'</div> ';
          })
          ->editColumn('status_socio', function ($recurso) {
              if ($recurso->status_socio == '2') {
                $label = 'Deferido';
              } elseif ($recurso->status_socio == '3') {
                $label = 'Indeferido';
              }
              return $label;
            })
          ->editColumn('status_res', function ($recurso) {
              if ($recurso->status_res == '2') {
                $label = 'Deferido';
              } elseif ($recurso->status_res == '3') {
                $label = 'Indeferido';
              }
              return $label;
            })
        ->make(true);
    }

    public function respondidos(){
        return view('admin.recursos.respondidos');
    }

    public function getRespondidos(){
      $recursos = RecursoReserva::join('usuarios', 'usuario_id', 'usuarios.id')
      ->select('usuarios.id', 'nome', 'justificativa', 'cpf')
      ->where('data_resposta_recurso', '!=', 'NULL')
      ->get();

      return Datatables::of($recursos)
      ->addColumn('action', function ($recurso) {
          $rec = '<form class="presenca hidden-print" method="post" action="'.route("admin.recursos.ver", $recurso->id).'" style="float:left;">'.csrf_field().'<button type="submit" class="btn blue btn-xs" style="margin-top: -1px;">Ver</button></form>';
          // $editar = '<form class="presenca hidden-print" method="get" action="'.route("admin.candidatos.editar", $recurso->id).'" style="float:left;">'.csrf_field().'<button type="submit" class="btn green btn-xs" style="margin-top: -1px;">Editar</button></form>';
          // $ver = $editar = '';
          return '<div class="btn-group btn-group-xs btn-group-solid">'.$rec.'</div> ';
        })
      ->make(true);
    }

    public function receber_envelope(){
        $acao = 'receber';
        $titulo = 'Recebimento de Envelope';
        return view('admin.recursos.verificar_receber_envelope', compact('acao', 'titulo'));
    }

    public function verificar_envelope(){
        $acao = 'verificar';
        $titulo = 'Verificar Envelope';
        return view('admin.recursos.verificar_receber_envelope', compact('acao', 'titulo'));
    }

    public function recebimento_envelope(Request $request){
        if($request['cpf'] != null){
            $usuario = Usuario::where('cpf', $request['cpf'])->first();
        }else{
            $usuario = Usuario::find($request['id']);
        }
        if(is_object($usuario)){
            $recurso = RecursoReserva::where('usuario_id', $usuario->id)->count();
            if($recurso == 0){
                // status 1 = recebido, 2 = deferido, 3 = indeferido
                RecursoReserva::create([
                    'usuario_id' => $usuario->id,
                    'status_socio' => 1,
                    'status_res' => 1,
                ]);
                return redirect()->route('admin.candidatos.analise_documento', ['id' => $usuario->id]);
            }else{
                return redirect()->route('admin.candidatos.analise_documento', ['id' => $usuario->id]);
            }
        }else{
            if($request['acao'] == 'receber'){
                return redirect()->route('admin.candidatos.receber')->with('danger', "O envelope do candidato não foi recebido ou ele não foi encontrado!");
            }else{
                return redirect()->route('admin.candidatos.verificar')->with('danger', "O envelope do candidato não foi recebido ou ele não foi encontrado!");
            }
        }
    }

    public function analise_documento($id){
        $usuario = Usuario::find($id);
        $recurso = RecursoReserva::where('usuario_id', $usuario->id)->first();
        if($recurso->status != 1){
        //    return redirect()->route('admin.candidatos.verificar')->with('danger', "Este recurso já foi verificado!");
        }
        $inscricao = Inscricao::where('usuario_id', $usuario->id)
            ->where('status', '!=', '0')->first();
        // if($inscricao->status == 3){
        //     return redirect()->route('admin.candidatos.verificar')->with('danger', "Este usuário efetuou o pagamento!");
        // }
        return view('admin.recursos.analise_documento', compact('inscricao', 'usuario','recurso'));
    }

    public function analise(Request $request){
        $usuario = Usuario::find($request['id']);
        $recurso = RecursoReserva::where('usuario_id', $usuario->id);
        if($request['socio']!=null && $request['acao']!=null ){
            if($request['socio'] == 'a'){
                // status 1 = recebido, 2 = deferido, 3 = indeferido
                RecursoReserva::where('usuario_id', $usuario->id)
                ->update([
                    'status_socio' => 2, // deferido
                ]);
                $inscricao = Inscricao::where('usuario_id', $usuario->id)
                ->where('status', '!=', '0')
                ->update([
                    'valor' => '00,00',
                ]);
                if($request['acao'] == 'deferido'){
                    $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')
                    ->update([
                        'reserva' => 1,
                    ]);
                    RecursoReserva::where('usuario_id', $usuario->id)
                    ->update([
                        'status_res' => 2,
                    ]);
                }elseif($request['acao'] == 'indeferido'){
                    $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')
                    ->update([
                        'reserva' => 2,
                    ]);
                    RecursoReserva::where('usuario_id', $usuario->id)
                    ->update([
                        'status_res' => 3,
                        'justificativa_res' => $request['justificativa_reserva'],
                    ]);
                }else{
                    $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')
                    ->update([
                        'reserva' => 0,
                    ]);
                }
                return redirect()->route('admin.candidatos.verificar', ['id' => $usuario->id])->with('success', "O pedido de {$usuario->nome} foi deferido com sucesso!");
            }elseif($request['socio'] == 'b'){
                // status 1 = recebido, 2 = deferido, 3 = indeferido
                RecursoReserva::where('usuario_id', $usuario->id)
                ->update([
                    'status_socio' => 2, // deferido
                ]);
                $inscricao = Inscricao::where('usuario_id', $usuario->id)
                ->where('status', '!=', '0')
                ->update([
                    'valor' => '29,00',
                    'vencimento' => '2017-11-14'
                ]);
                if($request['acao'] == 'deferido'){
                    $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')
                    ->update([
                        'reserva' => 1,
                    ]);
                    RecursoReserva::where('usuario_id', $usuario->id)
                    ->update([
                        'status_res' => 2,
                    ]);
                }elseif($request['acao'] == 'indeferido'){
                    $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')
                    ->update([
                        'reserva' => 2,
                    ]);
                    RecursoReserva::where('usuario_id', $usuario->id)
                    ->update([
                        'status_res' => 3,
                        'justificativa_res' => $request['justificativa_reserva'],
                    ]);
                }else{
                    $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')
                    ->update([
                        'reserva' => 0,
                    ]);
                }
                return redirect()->route('admin.candidatos.verificar', ['id' => $usuario->id])->with('success', "O pedido de {$usuario->nome} foi deferido com sucesso!");
            }elseif($request['socio'] == 'c'){
                // status 1 = recebido, 2 = deferido, 3 = indeferido
                RecursoReserva::where('usuario_id', $usuario->id)
                ->update([
                    'status_socio' => 2, // deferido
                ]);
                $inscricao = Inscricao::where('usuario_id', $usuario->id)
                ->where('status', '!=', '0')
                ->update([
                    'valor' => '42,00',
                    'vencimento' => '2017-11-14'
                ]);
                if($request['acao'] == 'deferido'){
                    $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')
                    ->update([
                        'reserva' => 1,
                    ]);
                    RecursoReserva::where('usuario_id', $usuario->id)
                    ->update([
                        'status_res' => 2,
                    ]);
                }elseif($request['acao'] == 'indeferido'){
                    $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')
                    ->update([
                        'reserva' => 2,
                    ]);
                    RecursoReserva::where('usuario_id', $usuario->id)
                    ->update([
                        'status_res' => 3,
                        'justificativa_res' => $request['justificativa_reserva'],
                    ]);
                }else{
                    $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')
                    ->update([
                        'reserva' => 0,
                    ]);
                }
                return redirect()->route('admin.candidatos.verificar', ['id' => $usuario->id])->with('success', "O pedido de {$usuario->nome} foi deferido com sucesso!");
            }elseif($request['socio'] == 'd'){
                // status 1 = recebido, 2 = deferido, 3 = indeferido
                RecursoReserva::where('usuario_id', $usuario->id)
                ->update([
                    'status_socio' => 3,
                    'status_res' => 3,
                    'justificativa' => $request['justificativa_socio'],
                    'justificativa_res' => $request['justificativa_reserva'],
                ]);
                $inscricao = Inscricao::where('usuario_id', $usuario->id)
                ->where('status', '!=', '0')
                ->update([
                    'valor' => '100,00',
                    'reserva' => 2,
                    'vencimento' => '2017-11-14'
                ]);
                return redirect()->route('admin.candidatos.verificar', ['id' => $usuario->id])->with('success', "O pedido de {$usuario->nome} foi indeferido com sucesso!");
            }
        }else{
            return redirect()->route('admin.candidatos.verificar')->with('danger', "Você não selecionou se a documentação foi deferida ou indeferida, tente novamente!");
        }
    }
}
