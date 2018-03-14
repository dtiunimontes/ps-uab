<?php

namespace App\Http\Controllers\MinhaConta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Inscricao;
use App\Models\Usuario;
use App\Models\Polo;
use App\Models\Curso;
use App\Models\Socioeconomico;
use PDF;
use App\Models\RecursoReserva;
use Datatables;

class InscricaoController extends Controller{

    public function index(){
        $usuario = Usuario::find(Auth::id());
        $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')->first();
        if($inscricao != null){
            $socio = Socioeconomico::where('inscricao_id', $inscricao->id)->first();
        }else{
            $socio = null;
        }

        $recurso = RecursoReserva::where('usuario_id', $usuario->id)->first();
        new BarCodeController($usuario->id, 0, 'barcode.gif', 120, 60, true, $usuario->nome);
        if($usuario->permissao == 2){
            return redirect()->route('admin.home');
        }
        return view('minhaconta.home', compact('usuario', 'socio', 'inscricao', 'recurso'));
    }

    public function getPolos(Request $request){
        $polo = Polo::where('curso_id', $request['curso'])->get();
        return $polo;
    }

    public function resposta($id){
      $rec = 5;
      $usuario = Usuario::find($id);
      $recurso = RecursoReserva::where('usuario_id', $usuario->id)->first();
      $inscricao = Inscricao::where('usuario_id', $usuario->id)
              ->where('status', '!=', '0')->first();
      return view('admin.recursos.ver_editar_analise_documento', compact('inscricao', 'usuario', 'recurso', 'rec'));
    }

    public function getCursoPolo(Request $request){
        // $request['curso_id'] = 1;
        // $request['polo_id'] = 1;
        // $request['inscricao'] = 4;
        if($request['inscricao'] == 4){
            $inscricoes = Inscricao::
              join('usuarios', 'inscricao.usuario_id', 'usuarios.id')
            ->select('nome', 'modalidade', 'email', 'status', 'cpf')
            ->where('polo_curso_id', '=', $request['curso_id'])
            ->where('polo_id', '=', $request['polo_id'])
            ->get();
        }else{
            $inscricoes = Inscricao::
              join('usuarios', 'inscricao.usuario_id', 'usuarios.id')
            ->select('nome', 'modalidade', 'email', 'status', 'cpf')
            ->where('polo_curso_id', '=', $request['curso_id'])
            ->where('polo_id', '=', $request['polo_id'])
            ->where('status', '=', $request['inscricao'])
            ->get();
        }
        return Datatables::of($inscricoes)
        ->editColumn('status', function ($inscricao) {
            if ($inscricao->status == 0) {
              $label = 'Inscrição Cancelada';
            } elseif ($inscricao->status == 1) {
              $label = 'Aguardando Pagamento';
            } elseif ($inscricao->status == 2) {
              $label = 'Isento';
            } elseif ($inscricao->status == 3) {
              $label = 'Pago';
            }
            return $label;
          })
        ->editColumn('modalidade', function ($inscricao) {
            if ($inscricao->modalidade == 'afrodescendente') {
              $label = 'Afrodescendente';
            } elseif ($inscricao->modalidade == 'universal') {
              $label = 'Universal';
            } elseif ($inscricao->modalidade == 'escola_publica') {
              $label = 'Escola Pública';
            } elseif ($inscricao->modalidade == 'deficiencia_indigena') {
              $label = 'Deficiente / Indígena';
            }
            return $label;
        })
        ->make(true);
    }

    public function recurso(){
        $usuario = Usuario::find(Auth::id());
        $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')->first();
        $recurso = RecursoReserva::where('usuario_id', $usuario->id)->first();
        if($recurso->status_socio == 3 || $recurso->status_res == 3){
            if($recurso->recurso != null || $recurso->recurso_res != null){
                return redirect()->route('minhaconta.home')->with('danger', 'Recurso já Enviado!');
            }
            return view('minhaconta.recurso', compact('usuario', 'inscricao', 'recurso'));
        }else{
            return redirect()->route('minhaconta.home')->with('success', 'O seu pedido de Reserva de Vagas foi Deferido!');
        }
    }

    public function cancelar_inscricao(Request $request){
        $inscricao = Inscricao::find($request['id']);
        $inscricao->status = 0;
        if($inscricao->save()){
            return redirect()->route('minhaconta.home')->with('success', 'Inscrição Cancelada com Sucesso!');
        }else{
            return redirect()->route('minhaconta.home')->with('danger', 'A Inscrição não pôde ser Cancelada!');
        }
    }

    public function novainscricao(){
        $usuario = Usuario::find(Auth::id());
        $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')->first();
        if($inscricao != null){
            return redirect()->route('minhaconta.home')->with('danger', 'Inscrição já efetuada!');
        }
        $polos = Polo::take(19)->get();
        $cursos = Curso::all();
        return view('minhaconta.novainscricao', compact('polos', 'cursos'));
    }

    public function novainscricao_salvar(Request $request){
        function modulo11($numero){
            $mult = 2;
            $dig = 0;
            for ($i=strlen($numero)-1;$i>=0;$i--){
                $dig = $dig + (substr($numero,$i,1)*$mult);
        //	echo substr($numero,$i,1)."*".$mult." = ".(substr($numero,$i,1)*$mult)."<br>";
                $mult = $mult+1;
                if ($mult > 11){
                    $mult = 2;
                }
            }
            $dig = $dig % 11;
            if ($dig==0){
                $dig=1;
            }else if ($dig==1){
                $dig=0;
            }else{
                $dig = 11 - $dig;
                if ($dig > 9){
                    $dig = 0;
                }
            }
            return $dig;
        }

        function modulo10($numero){
            $mult = 2;
            $somador = 0;
            $dig = 0;
            for ($i=strlen($numero)-1;$i>=0;$i--){
                $somador = (substr($numero,$i,1)*$mult);
            //	echo substr($numero,$i,1)."*".$mult." = ";
                if ($somador > 9){
                    for ($j=0;$j<strlen($somador);$j++){
                        $dig = $dig+substr($somador,$j,1);
            //			 echo substr($somador,$j,1)."<br>";
                    }
                }
                else{
                    $dig = $dig + $somador;
            //		 echo $somador."<br>";
                }
                if ($mult == 2){
                    $mult = 1;
                }else{
                    $mult = 2;
                }
            }
            $dig = $dig % 10;
            $dig = 10 - $dig;
            if ($dig > 9){
                $dig = 0;
            }
            return $dig;
        }

        function dgnossonum($numero){
            $dg10 = modulo10($numero);
            $dg11 = modulo11($numero.$dg10);
            return $dg10.$dg11;
        }

        $usuario = Usuario::find(Auth::id());
        $this->validate($request, [
            'polo_curso_id' => 'required',
            'polo_id' => 'required',
            'modalidade' => 'required',
            'local_prova' => 'required',
        ]);

        $servico = "68";
        // Tem-se 9 digitos para usar no boleto
        $nossonumero = str_pad($servico, 2, "0", STR_PAD_LEFT).str_pad($usuario->id, 9, "0", STR_PAD_LEFT); // numero do DAE
        $nossonumero = $nossonumero.dgnossonum($nossonumero);//numero do DAE
        Inscricao::where('usuario_id', $usuario->id)
            ->update([
                'status' => 0,
            ]);
        $inscricao = Inscricao::create([
            'usuario_id' => $usuario->id,
            'modalidade' => $request['modalidade'],
            'local_prova' => $request['local_prova'],
            'polo_id' => $request['polo_id'],
            'polo_curso_id' => $request['polo_curso_id'],
            'valor' => '100,00',
            'vencimento' => '2017-09-29',
            'numero_dae' => $nossonumero,
            'mes_referencia' => date('Y-m-d'),
        ]);

        if($inscricao != null){
            return redirect()->route('minhaconta.home')->with('success', 'Sua Inscrição foi feita com sucesso!');
        }else{
            return redirect()->route('minhaconta.home')->with('danger', 'Ocorreu um erro, Sua Inscrição pôde ser processada!');
        }
    }

    public function recurso_usuario(Request $request){
        $usuario = Usuario::find($request['id']);
        $recurso = RecursoReserva::where('usuario_id', $usuario->id)
            ->update([
                'recurso' => $request['recurso'],
                'recurso_res' => $request['recurso_res'],
                'data_recurso' => date('Y-m-d H:i'),
            ]);

        if($recurso != null){
            return redirect()->route('minhaconta.home')->with('success', 'Seu Recurso foi enviado com sucesso!');
        }else{
            return redirect()->route('minhaconta.home')->with('danger', 'Ocorreu um erro, seu Recurso não podes ser enviado!');
        }
    }

    public function atualiza_vencimento(){
        $usuario = Usuario::find(Auth::id());
        $atualiza = Inscricao::
              where('usuario_id', $usuario->id)
            ->where('status', 1)
            ->update([
                'vencimento' => '2017-11-28',
            ]);
        if($atualiza != null){
            return redirect()->route('minhaconta.home')->with('success', 'Dae Atualizada com sucesso!');
        }else{
            return redirect()->route('minhaconta.home')->with('danger', 'Ocorreu um erro, o vencimento não pôde ser alterado!');
        }
    }

    public function declaracao() {
        $usuario = Usuario::find(Auth::id());
        $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')->first();
        $socio = Socioeconomico::where('inscricao_id', $inscricao->id)->with('usuarios')->first();
        //return view('minhaconta.declaracao-socio', compact('socio'));
        $pdf = PDF::loadView('minhaconta.declaracao-socio', compact('usuario'));
        return $pdf->stream();
    }

    public function meus_dados(){
        $usuario = Usuario::find(Auth::id());
        $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')
                    ->with('polo')->first();
        if($inscricao != null){
            $local_prova = Polo::find($inscricao->local_prova);
            $curso = Curso::find($inscricao->polo->curso_id);
        }else{
            $local_prova = null;
            $curso = null;
        }
        $polos = Polo::all();
        $cursos = Curso::all();
        $ver = 0;
        return view('minhaconta.dados_pessoais', compact('usuario', 'ver', 'polos', 'local_prova', 'cursos', 'curso', 'inscricao'));
    }

    public function salvar(Request $request){
        list($dia, $mes, $ano) = explode('/', $request['data_nasc']);
        $request['data_nasc'] = $ano.'-'.$mes.'-'.$dia;

        $this->validate($request, [
            'nome' => 'required|string|max:80',
            'email' => 'required|string|email|max:45|unique:usuarios,email,'.$request['id'],
            'rg' => 'required|string|max:20|unique:usuarios,rg,'.$request['id'],
            'org_exped' => 'required|string|max:20',
            'data_nasc' => 'required|date',
            'telefone' => 'required|string|max:20',
            'necessidade_especial' => 'required',
            'cep' => 'required|max:8',
            'logradouro' => 'required|string|max:100',
            'numero' => 'required|integer',
            'cidade' => 'required|string|max:50',
            'bairro' => 'required|string|max:50',
            'estado' => 'required|string|max:2',
        ]);

        $usuario = Usuario::find($request['id']);
        $usuario->nome = $request['nome'];
        $usuario->email = $request['email'];
        $usuario->rg = $request['rg'];
        $usuario->org_exped = $request['org_exped'];
        $usuario->data_nasc = $request['data_nasc'];
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

        return redirect()->route('minhaconta.home')->with('success', 'Dados Salvos com sucesso!');
    }

    public function senha(){
        $usuario = Usuario::find(Auth::id());
        return view('minhaconta.alterar_senha', compact('usuario'));
    }

    public function alterar_senha(Request $request){
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ]);

        $usuario = Usuario::find($request['id']);
        $usuario->password = bcrypt($request['password']);
        $usuario->save();

        return redirect()->route('minhaconta.home')->with('success', 'Senha salva com sucesso!');
    }

    public function dae(){

        function esquerda($entra, $comp){
        	return substr($entra, 0, $comp);
        }

        function direita($entra,$comp){
        	return substr($entra,strlen($entra)-$comp,$comp);
        }

        function modulo10($numero){
            $mult = 2;
            $somador = 0;
            $dig = 0;
            for ($i=strlen($numero)-1;$i>=0;$i--){
                $somador = (substr($numero,$i,1)*$mult);
            //	echo substr($numero,$i,1)."*".$mult." = ";
                if ($somador > 9){
                    for ($j=0;$j<strlen($somador);$j++){
                        $dig = $dig+substr($somador,$j,1);
            //			 echo substr($somador,$j,1)."<br>";
                    }
                }
                else{
                    $dig = $dig + $somador;
            //		 echo $somador."<br>";
                }
                if ($mult == 2){
                    $mult = 1;
                }else{
                    $mult = 2;
                }
            }
            $dig = $dig % 10;
            $dig = 10 - $dig;
            if ($dig > 9){
                $dig = 0;
            }
            return $dig;
        }

        function WBarCode($valor) {
        	$fino = 1;
        	$largo = 3;
        	$altura = 50;
            $return = '';

        	$barcodes[0] = "00110" ;
        	$barcodes[1] = "10001" ;
        	$barcodes[2] = "01001" ;
        	$barcodes[3] = "11000" ;
        	$barcodes[4] = "00101" ;
        	$barcodes[5] = "10100" ;
        	$barcodes[6] = "01100" ;
        	$barcodes[7] = "00011" ;
        	$barcodes[8] = "10010" ;
        	$barcodes[9] = "01010" ;
        	for($f1=9;$f1>=0;$f1--){
        		for($f2=9;$f2>=0;$f2--){
        			$f = ($f1 * 10) + $f2;
        			$texto = "" ;
        			for($i=1;$i<6;$i++){
        				$texto .=  substr($barcodes[$f1],($i-1),1) . substr($barcodes[$f2],($i-1),1);
        			}
        			$barcodes[$f] = $texto;
        		}
        	}
        //Desenho da barra
        //Guarda inicial
        	$texto = $valor ;
        //if (bcmod(strlen($texto),2) <> 0){
        //   $texto = "0" . $texto;}
        	$return = $return."<img src='../images/p.gif' width=$fino height=$altura border=0><img ";
        	$return = $return."src='../images/b.gif' width=$fino height=$altura border=0><img ";
        	$return = $return."src='../images/p.gif' width=$fino height=$altura border=0><img ";
        	$return = $return."src='../images/b.gif' width=$fino height=$altura border=0><img ";
        // Draw dos dados
        	while (strlen($texto) > 0){
        		$i = round(esquerda($texto, 2));
        		$texto = direita($texto,strlen($texto)-2);
        		$f = $barcodes[$i];
        		for($i = 1; $i < 11; $i += 2){
        			if (substr($f, ($i-1), 1) == "0"){
        				$f1 = $fino ;
        			}else{
        				$f1 = $largo ;
        			}
        			$return = $return."src='../images/p.gif' width=$f1 height=$altura border=0><img ";
        	    	if (substr($f, $i, 1) == "0"){
        	      		$f2 = $fino ;
        	    	}else{
        	      		$f2 = $largo ;
        	    	}
        			$return = $return." src='../images/b.gif' width=$f2 height=$altura border=0><img ";
        	  	}
        	}
        // Draw guarda final
        	$return = $return."src='../images/p.gif' width=$largo height=$altura border=0><img ";
        	$return = $return."src='../images/b.gif' width=$fino height=$altura border=0><img ";
        	$return = $return."src='../images/p.gif' width=1 height=$altura border=0> ";
            return $return;
        }

        function codbarra($valor, $data, $nossonumero, $orgaodestino){
        	$inicio = "856";
            $valor = str_pad($valor, 11, "0", STR_PAD_LEFT);
        	$empresa = "0213";

        	$origemversao = "12";
        	$taxa = "0";
        //'85680000000802502130604151202200698501820231'
        	$camposcod = $valor.$empresa.$data.$origemversao.$nossonumero.$taxa.$orgaodestino;
        	$codbarra = $inicio.modulo10($inicio.$camposcod).$camposcod;
        //echo $codbarra."<br>";
        	// Substituição da função
        	//$codbarratxt = preg_replace('/([0-9]{11})/e', '"\1" ." ". modulo10("\1")." "', $codbarra);
        	$codbarraEnv = $codbarra;
        	$codbarra = str_split($codbarra, 11);
        	$codbarratxt = '';
        	foreach ($codbarra as $key => $cod) {
        		$codbarratxt = $codbarratxt.$cod.' '.modulo10($cod).' ';
        	}
        /*
        $codbarratxt  =     substr($codbarra,0,11)." ".modulo10(substr($codbarra,0,11));
        $codbarratxt .= " ".substr($codbarra,11,11)." ".modulo10(substr($codbarra,11,11));
        $codbarratxt .= " ".substr($codbarra,22,11)." ".modulo10(substr($codbarra,22,11));
        $codbarratxt .= " ".substr($codbarra,33,11)." ".modulo10(substr($codbarra,33,11));
        */
        //echo $codbarratxt;
        	$res[0]=$codbarraEnv;
        	$res[1]=$codbarratxt;
        	return $res;
        }

        $usuario = Usuario::find(Auth::id());
        $inscricao = Inscricao::where('usuario_id', $usuario->id)
                    ->where('status', '!=', '0')->first();
        $date = date('ymd', strtotime($inscricao->vencimento));

        // converte o valor que vem do banco de dados no formato ($1,110.50) para o formato (1110.50)
        $valor = str_replace(',', '', $inscricao->valor);
        // o valor deve estar somente com numeros para gerar o codigo de barras
        // $valor = str_replace('.', '', $valor);
        $codbarraS = codbarra($valor, $date, $inscricao->numero_dae, "231");
        $codBarraS_WBarCode = WBarCode($codbarraS[0]);
        $codbarraS = $codbarraS[1];

        return view('minhaconta.dae', compact('usuario', 'inscricao', 'codbarraS', 'codBarraS_WBarCode'));
    }
}
