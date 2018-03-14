<?php

namespace App\Http\Controllers\Auth;

use App\Models\Usuario;
use App\Models\Endereco;
use App\Models\Formacao;
use App\Models\Polo;
use App\Models\Curso;
use App\Models\Inscricao;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\MinhaConta\BarCodeController;

class RegisterController extends Controller{
    use RegistersUsers;
    protected $redirectTo = '/minhaconta';

    public function __construct(){
        $this->middleware('guest');
    }

    public function showRegistrationForm(){
        $cursos = Curso::all();
        $curso = Curso::find(1);
        $polos = $curso->polos()->get();
        $local_prova = Polo::take(19)->get();
        return view('auth.register', compact('polos', 'cursos', 'local_prova'));
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'nome' => 'required|string|max:80',
            'email' => 'required|string|email|max:45|unique:usuarios',
            'password' => 'required|string|min:6|confirmed',
            'cpf' => 'required|string|min:11|max:11|unique:usuarios',
            'rg' => 'required|string|max:20|unique:usuarios',
            'org_exped' => 'required|string|max:20',
            'data_nasc' => 'required',
            'telefone' => 'required|string|max:20',
            'necessidade_especial' => 'required',
            'cep' => 'required|max:8',
            'logradouro' => 'required|string|max:100',
            'numero' => 'required|integer',
            'cidade' => 'required|string|max:50',
            'bairro' => 'required|string|max:50',
            'estado' => 'required|string|max:2',
            'polo_curso_id' => 'required',
            'polo_id' => 'required',
            'modalidade' => 'required',
            'local_prova' => 'required',
        ]);
    }

    protected function create(array $data){
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

        list($dia, $mes, $ano) = explode('/', $data['data_nasc']);
        $usuario = Usuario::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'cpf' => $data['cpf'],
            'rg' => $data['rg'],
            'org_exped' => $data['org_exped'],
            'data_nasc' => $ano.'-'.$mes.'-'.$dia,
            'telefone' => $data['telefone'],
            'necessidade_especial' => $data['necessidade_especial'],
            'cep' => $data['cep'],
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'],
            'cidade' => $data['cidade'],
            'bairro' => $data['bairro'],
            'estado' => $data['estado'],
        ]);

        $servico = "68";
        // Tem-se 9 digitos para usar no boleto
        $nossonumero = str_pad($servico, 2, "0", STR_PAD_LEFT).str_pad($usuario->id, 9, "0", STR_PAD_LEFT); // numero do DAE
        $nossonumero = $nossonumero.dgnossonum($nossonumero);//numero do DAE
        $inscricao = Inscricao::create([
            'usuario_id' => $usuario->id,
            'modalidade' => $data['modalidade'],
            'local_prova' => $data['local_prova'],
            'polo_id' => $data['polo_id'],
            'polo_curso_id' => $data['polo_curso_id'],
            'valor' => '100,00',
            'vencimento' => '2017-09-29',
            'numero_dae' => $nossonumero,
            'mes_referencia' => date('Y-m-d'),
        ]);

        new BarCodeController($usuario->id, 0, 'barcode.gif', 200, 80, true, $usuario->nome);
        return $usuario;
    }
}
