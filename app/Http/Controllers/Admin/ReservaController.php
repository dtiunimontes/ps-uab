<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\RecursoReserva;
use App\Models\Inscricao;
use App\Models\Socioeconomico;
use Datatables;

class ReservaController extends Controller{

    // public function index(){
    //     return view('admin.reserva.home');
    // }
    //
    // public function getReserva(){
    //   $socio = Socioeconomico::join('inscricao', 'inscricao_id', '=', 'inscricao.id')
    //       ->join('usuarios', 'usuarios.id', '=', 'inscricao.usuario_id')
    //       ->select(
    //           'usuarios.nome as nome_completo',
    //           'usuarios.cpf as cpf',
    //           'inscricao.id as id_inscricao',
    //           'inscricao.modalidade as modalidade',
    //           'usuarios.id as usuario_id',
    //           'inscricao.status as status_insc',
    //           'inscricao.reserva as reserva',
    //           'socioeconomico.id as id',
    //           'socioeconomico.status as status_socio')
    //       ->where('inscricao.status', '=', '1')
    //       ->where('modalidade', '!=', 'universal')
    //       ->get();
    //   return Datatables::of($socio)
    //     ->addColumn('action', function ($socio) {
    //         $lancar = '
    //         <form class="presenca hidden-print" method="get" action="'.route("admin.reserva.lancar", $socio->id).'" style="float:left;">'.
    //             csrf_field().'
    //             <div class="radio">
    //                 <label><input type="radio" value="1" name="acao">Deferir</label><br/>
    //                 <label><input type="radio" value="2" name="acao">Indeferir</label>
    //             </div>
    //         <button type="submit" class="btn blue btn-xs" style="margin-top: -1px;">Enviar</button></form>';
    //         return $lancar;
    //       })
    //       ->editColumn('status_insc', function ($socio) {
    //           if ($socio->status_insc == 0) {
    //             $label = 'Inscrição Cancelada';
    //           } elseif ($socio->status_insc == 1) {
    //             $label = 'Aguardando Pagamento';
    //           } elseif ($socio->status_insc == 2) {
    //             $label = 'Isento';
    //           } elseif ($socio->status_insc == 3) {
    //             $label = 'Pago';
    //           }
    //           return $label;
    //         })
    //       ->editColumn('reserva', function ($socio) {
    //           if ($socio->reserva == 0) {
    //             $label = 'Não lançado';
    //           } elseif ($socio->reserva == 1) {
    //             $label = 'Deferido';
    //           } elseif ($socio->reserva == 2) {
    //             $label = 'Indeferido';
    //           }
    //           return $label;
    //         })
    //       ->editColumn('modalidade', function ($socio) {
    //           if ($socio->modalidade == 'afrodescendente') {
    //             $label = 'Afrodescendente';
    //           } elseif ($socio->modalidade == 'universal') {
    //             $label = 'Universal';
    //           } elseif ($socio->modalidade == 'escola_publica') {
    //             $label = 'Escola Pública';
    //           } elseif ($socio->modalidade == 'deficiencia_indigena') {
    //             $label = 'Deficiente / Indígena';
    //           }
    //           return $label;
    //       })
    //       ->make(true);
    // }
    //
    // public function lancar(Request $request, $id){
    //     $socio = Socioeconomico::find($id);
    //     $inscricao = Inscricao::find($socio->inscricao_id);
    //     if($request['acao'] == 1){
    //         $inscricao->reserva = 1;
    //     }else{
    //       $inscricao->reserva = 2;
    //     }
    //     $inscricao->save();
    //     return redirect()->route('admin.reserva.home');
    // }

}
