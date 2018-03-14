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
                    <img src='{{ asset("etiquetas/{$socio->usuarios[0]->id}.png") }}' alt="">
                </div>
                <div class="col-xs-4 text-right">
                    <img src='{{ asset("etiquetas/{$socio->usuarios[0]->id}.png") }}' alt="">
                </div>
            </div>
            <div class="col-md-12 text-uppercase text-center">
                <h1><strong>FORMULÁRIO DE IDENTIFICAÇÃO DO CANDIDATO</strong></h1>
                <h3><strong>PROCESSO SELETIVO GRADUAÇÃO UAB 2017 </strong></h3>
            </div>
            <div class="col-md-12 text-justify">
                <b> ANEXO I - Subitem 2.2.1 </b><br>

                Juntar o Questionário de Avaliação à documentação comprobatória exigida, colocar no envelope e lacrá-lo. Até o dia 10/08/2017, a documentação deverá ser enviada à Unimontes/CEPS, podendo ser postada nos Correios, com Aviso de Recebimento (AR), ou ser entregue, mediante protocolo, na recepção da CEPS, no horário das 8 às 18 horas, exceto sábados, domingos e feriados. O candidato deverá endereçar o envelope à Unimontes/CEPS – Prédio 4, Campus Universitário Professor Darcy Ribeiro, Caixa Postal 126, Montes Claros/MG, CEP 39401-089.
            </div>
            <div class="col-md-12 text-center">
                <h3><strong>ATENÇÃO: Utilize este formulário para identificar o envelope (Socioeconômico)</strong></h3>
            </div>
            <div class="col-md-12">
                <p><strong>DESTINATÁRIO</strong></p>
                <p>CEPS/UNIMONTES - CAMPUS UNIVERSITÁRIO PROF. DARCY RIBEIRO, CEP 39401-089, MONTES CLAROS/MG</p>
            </div>
            <div class="col-md-12" style="margin-top:20px;">
                <p><strong>INSCRIÇÃO: </strong>{{ $socio->id }}</p>
                <p><strong>NOME COMPLETO: </strong>{{ $socio->usuarios[0]->nome }}</p>
                <p><strong>CPF: </strong>{{ $socio->usuarios[0]->cpf }}</p>
            </div>
			<div class="col-md-12 text-center">
                <img src='{{ asset("etiquetas/{$socio->usuarios[0]->id}.png") }}' alt="">
            </div>
            <div class="col-md-12 text-center" style="margin-top:30px;">
                <p>Montes Claros/MG, {{date('d\/m\/Y', strtotime($socio->created_at))}}</p>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <img src='{{ asset("etiquetas/{$socio->usuarios[0]->id}.png") }}' alt="">
                </div>
                <div class="col-xs-4 text-right">
                    <img src='{{ asset("etiquetas/{$socio->usuarios[0]->id}.png") }}' alt="">
                </div>
            </div>            
        </div>
    </body>
</html>
