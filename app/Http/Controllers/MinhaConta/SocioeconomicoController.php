<?php

namespace App\Http\Controllers\MinhaConta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Socioeconomico;
use App\Models\Inscricao;
use App\Models\Usuario;
use Auth;
use PDF;
use Datatables;

class SocioeconomicoController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }

    // public function index() {
    //     return view('admin.socio.home');
    // }
    //
    // public function getSocio(){
    //   $socio = Socioeconomico::join('inscricao', 'inscricao_id', '=', 'inscricao.id')
    //       ->join('usuarios', 'usuarios.id', '=', 'inscricao.usuario_id')
    //       ->select(
    //           'usuarios.nome as nome_completo',
    //           'usuarios.cpf as cpf',
    //           'inscricao.id as id_inscricao',
    //           'inscricao.modalidade as modalidade',
    //           'usuarios.id as usuario_id',
    //           'inscricao.status as status_insc',
    //           'socioeconomico.id as id',
    //           'socioeconomico.status as status_socio')
    //       ->where('inscricao.status', '=', '1')
    //       // ->where('modalidade', '!=', 'universal')
    //       ->get();
    //   return Datatables::of($socio)
    //     ->addColumn('action', function ($socio) {
    //         $lancar = '
    //         <form class="presenca hidden-print" method="get" action="'.route("admin.socioeconomico.lancar", $socio->id).'" style="float:left;">'.
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
    //       ->editColumn('status_socio', function ($socio) {
    //           if ($socio->status_socio == 0) {
    //             $label = 'Não lançado';
    //           } elseif ($socio->status_socio == 1) {
    //             $label = 'Deferido';
    //           } elseif ($socio->status_socio == 2) {
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

    public function formSocio() {
        $inscricao = Inscricao::where('usuario_id', Auth::id())
                    ->where('status', '!=', '0')->first();
        $socio = Socioeconomico::where('inscricao_id', $inscricao->id)->with('usuarios')->first();
        if ($socio == null){
            return view('minhaconta.form-socio');
        }else{
            return redirect()->route('minhaconta.home')->with('danger', 'Já foi relaizada uma inscrição para o socioeconômico.');
        }
    }

    // public function lancar(Request $request, $id){
    //     $socio = Socioeconomico::find($id);
    //     $socio->status = $request['acao'];
    //     $socio->save();
    //     $inscricao = Inscricao::find($socio->inscricao_id);
    //     if($request['acao'] == 1){
    //         $inscricao->status = 2;
    //     }else{
    //       $inscricao->status = 1;
    //     }
    //     $inscricao->save();
    //     return redirect()->route('admin.socioeconomico.home');
    // }

    public function store(Request $request){
        $inscricao = Inscricao::where('usuario_id', Auth::id())
                    ->where('status', '!=', '0')->first();
        $socio = Socioeconomico::where('inscricao_id', $inscricao->id)->with('usuarios')->first();
        if ($socio != null){
            return redirect()->route('minhaconta.home')->with('danger', 'Já foi relaizada uma inscrição para o socioeconômico.');
        }
        $this->validate($request, [
            'nome_mae' => 'required|string|max:190',
            //'nome_pai' => 'string|max:190',
            'questao1' => 'required',
            'questao2' => 'required',
            'questao3' => 'required',
            'questao4' => 'required',
            'questao5' => 'required',
            'questao6' => 'required',
            'questao7' => 'required',
            'questao8' => 'required',
            'questao9' => 'required',
            'questao10' => 'required',
            'questao11' => 'required',
            'questao12' => 'required',
        ]);


        $socio = Socioeconomico::create([
            'usuario_id' => Auth::id(),
            'inscricao_id' => $inscricao->id,
            'nome_mae' => $request['nome_mae'],
            'nome_pai' => $request['nome_pai'],
            'questao1' => $request['questao1'],
            'questao2' => $request['questao2'],
            'questao3' => $request['questao3'],
            'questao4' => $request['questao4'],
            'questao5' => $request['questao5'],
            'questao6' => $request['questao6'],
            'questao7' => $request['questao7'],
            'questao8' => $request['questao8'],
            'questao9' => $request['questao9'],
            'questao10' => $request['questao10'],
            'questao11' => $request['questao11'],
            'questao12' => $request['questao12'],
        ]);

        if($socio){
            return redirect()->route('minhaconta.home')->with('success','Inscrição para socioeconômico realizada com sucesso!');
        } else {
            return redirect()->back()->with('danger','Inscrição para socioeconômico não foi realizada, tente novamente!');
        }
    }

    public function respostasQuestionario() {
        $inscricao = Inscricao::where('usuario_id', Auth::id())
                    ->where('status', '!=', '0')->first();
        $socio = Socioeconomico::where('inscricao_id', $inscricao->id)->first();
        if ($socio != null){
            $pdf = PDF::loadView('minhaconta.respostas-socio', compact('socio'));
            return $pdf->stream();
        }else{
            return redirect()->route('minhaconta.home');
        }

        //return view('minhaconta.respostas-socio', compact('socio'));
    }

    public function comprovanteSocio() {
        $inscricao = Inscricao::where('usuario_id', Auth::id())
                    ->where('status', '!=', '0')->first();
        $socio = Socioeconomico::where('inscricao_id', $inscricao->id)->with('usuarios')->first();
        $usuario = Usuario::find(Auth::id());
        if ($socio != null){
            //return view('minhaconta.comprovante-socio', compact('socio'));
            $pdf = PDF::loadView('minhaconta.comprovante-socio', compact('socio'));
            return $pdf->stream();
        }else{
            return redirect()->route('minhaconta.home');
        }
    }

}
