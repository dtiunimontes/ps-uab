<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Comprovante inscrição</title>
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
		<!--<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">-->
		<style media="screen">
			@page { margin: 1cm; };
		</style>
	</head>
	<body>
        <div class="container" style="font-family: 'Roboto', sans-serif!important;">
            <div class="col-md-12">
                <img src="{{ asset('assets/img/header-comprovante.png') }}" class="img-responsive" alt="">
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <img src='{{ asset("etiquetas/{$inscricao->usuario_id}.png") }}' alt="">
                </div>
                <div class="col-xs-4 text-right">
                    <img src='{{ asset("etiquetas/{$inscricao->usuario_id}.png") }}' alt="">
                </div>
            </div>
            <br/><br/><br/><br/><br/>
            <div class="col-md-12 text-uppercase text-center">
                <h1>Comprovante de Inscrição</h1>
            </div>
            <div class="col-md-12" style="margin-top:20px;">
                <p><strong>INSCRIÇÃO: </strong>{{ $inscricao->id_inscricao }}</p>
                <p><strong>NOME COMPLETO: </strong>{{ $inscricao->nome_completo }}</p>
                <p><strong>CPF: </strong>{{ $inscricao->cpf }}</p>
                <p><strong>CURSO: </strong>{{ $inscricao->curso }}</p>
                <p><strong>POLO: </strong>{{ $inscricao->cidade }}</p>
								<p><strong>LOCAL DA PROVA: </strong>{{ $inscricao->local }}</p>
								<p><strong>STATUS: </strong><?php
									if ($inscricao->status == 0)
										echo 'Inscrição Cancelada';
									elseif ($inscricao->status == 1)
										echo 'Aguardando Pagamento';
									elseif ($inscricao->status == 2)
										echo 'Isento';
									elseif ($inscricao->status == 3)
										echo 'Pago';
									 ?></p>
            </div><br/><br/><br/>
			<div class="col-md-12 text-center">
                <img src='{{ asset("etiquetas/{$inscricao->usuario_id}.png") }}' alt="">
            </div>
            <div class="col-md-12 text-center" style="margin-top:30px;">
                <p>Montes Claros/MG, {{date('d\/m\/Y', strtotime($inscricao->data_inscricao))}}</p>
            </div><br/><br/><br/>
            <div class="row">
                <div class="col-xs-6">
                    <img src='{{ asset("etiquetas/{$inscricao->usuario_id}.png") }}' alt="">
                </div>
                <div class="col-xs-4 text-right">
                    <img src='{{ asset("etiquetas/{$inscricao->usuario_id}.png") }}' alt="">
                </div>
            </div>
        </div>
    </body>
</html>
