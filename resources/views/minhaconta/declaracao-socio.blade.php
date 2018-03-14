<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Declaração socioeconômico</title>
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
		<!--<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">-->
		<style media="screen">
			@page { margin: 1cm; };
		</style>
	</head>
	<body>
        <header class="header" style="position: fixed; height:100px;">
            <img src="{{ asset('assets/img/header-comprovante.png') }}" class="img-responsive" alt="">
        </header>
        <div class="container" style="font-family: 'Roboto', sans-serif!important;">
            <div class="col-md-12" style="position:absolute; top: 5cm;">

    			<div class="col-md-12" id="indigena">
                    <div class="col-md-12 text-uppercase text-center">
                        <h2><strong>Declaração</strong></h2>
                    </div><br>
    				Esta declaração deverá ser, obrigatoriamente, preenchida pelos candidatos que desejarem concorrer às vagas reservadas para a<b> Categoria Indígena.</b><br> <br>

    	            <br>
    	            Eu, {{ $usuario->nome }},<br>
    	            me declaro Indígena
    	            para concorrer ao ao Processo Seletivo Graduação UAB 2017, no
    	            Sistema de Reserva de Vagas.
    	            <p align="center"><br><br><br>
    	          	_________________________________________________<br>
    	            {{ $usuario->nome }}<br><br>
    	            _________________________________________________<br>
    	            Assinatura do(a) Responsável (Caso Menor)
    	            </p>
    			</div>
                <div class="col-md-12 text-center" style="margin-top:30px;">
                    <p>Montes Claros/MG, {{date('d\/m\/Y', strtotime($usuario->created_at))}}</p>
                </div>
                <br><br><br><br>
                <br><br><br><br>
                <br><br><br><br>

            </div>

            <p style="page-break-after: always;"></p>

            <div class="col-md-12" style="position:absolute; top: 5cm;">
    			<div class="col-md-12" id="afrodescendente">
                    <div class="col-md-12 text-uppercase text-center">
                        <h2><strong>Declaração</strong></h2>
                    </div><br>
    				Esta declaração deverá ser, obrigatoriamente, preenchida pelos candidatos que desejarem concorrer às vagas reservadas para as<strong> Categoria Afrodescendente, Carente.</strong><br> <br>

    				Eu, {{ $usuario->nome }},<br>
    				me declaro afrodescendente para concorrer ao Processo Seletivo Graduação UAB 2017, no
    				Sistema de Reserva de Vagas.
                    <p align="center"><br><br><br>
    	          	_________________________________________________<br>
    	            {{ $usuario->nome }}<br><br>
    	            _________________________________________________<br>
    	            Assinatura do(a) Responsável (Caso Menor)
    	            </p>
    			</div>

                <div class="col-md-12 text-center" style="margin-top:30px;">
                    <p>Montes Claros/MG, {{date('d\/m\/Y', strtotime($usuario->created_at))}}</p>
                </div>
            </div>

		</div>
    </body>
</html>
