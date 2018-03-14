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
            <div class="col-md-12" style="margin-top:20px;">
                <p><strong>INSCRIÇÃO: </strong>{{ $socio->inscricao_id }}</p>
                <p><strong>CÓD. SOCIOECONÔMICO: </strong>{{ $socio->id }}</p>
                <p><strong>NOME COMPLETO: </strong>{{ $socio->usuarios[0]->nome }}</p>
                <p><strong>CPF: </strong>{{ $socio->usuarios[0]->cpf }}</p>
            </div><br>

            <div class="col-md-12 text-uppercase text-center">
                <h1><strong>Questionário de Avaliação</strong></h1>
            </div><br>

			<div class="col-md-12" style="margin-top:20px;">
				<p><strong>01 - Renda familiar per capta (R$)</strong>  Resposta:
					<strong>
						@if($socio->questao1 == 1)
							Zero a 234,00
						@elseif($socio->questao1 == 2)
							235,00 a 468,00
						@elseif($socio->questao1 == 3)
							469,00 a 937,00
						@elseif($socio->questao1 == 4)
							Mais de 937,00
						@endif
					</strong>
				</p>
			</div>
            <div class="col-md-12 well">
                <b> Documentos para comprovação: </b><br>

				- Cópias de documentos do candidato e de todos os membros do grupo familiar: Carteira de Identidade, Certidão de Nascimento, Certidão de Casamento. Inclusive, documento oficial em caso de guarda ou adoção de menor.<br>
		        - Cópia da Carteira de Trabalho do candidato e de todos os membros do grupo familiar, inclusive daqueles que não trabalhem ou trabalhem informalmente (as páginas em que constam os contratos de trabalho, a página seguinte ao último contrato e as páginas que identificam o portador da Carteira).<br>
		        - Cópias dos contracheques, dos últimos 3 meses, do candidato e dos membros do grupo familiar. Se a empresa não emitir contracheque, pode apresentar declaração (emitida pela empresa, em papel timbrado, e assinada por autoridade competente) constando o cargo e o valor bruto mensal.<br>
		        - Cópia da última declaração de imposto de renda, de todos os membros do grupo familiar.<br>
		        - Cópias do Extrato (dos últimos 3 meses) do recebimento de benefício previdenciário do candidato e de membros do grupo familiar, para comprovar a situação de pensionista, aposentado, afastado ou de que recebe(m) qualquer benefício social de órgão público ou privado, desde que regular. Obs.: Para obter esse Extrato, o interessado deverá acessar o endereço www.previdenciasocial.gov.br, e, no link Extrato de Pagamento de Benefício, informar o número do benefício e imprimir o Extrato.<br>
		        - Cópias de documentos comprobatórios de outras rendas (aluguel de imóveis, etc.).
		        <br>
		     	- Cópia de comprovante de pensão alimentícia (pagamento ou recebimento).
		        <br>
		        - Declaração, assinada de próprio punho, do candidato e de membros do grupo familiar, de que exercem atividade remunerada informal, constando o tipo de atividade e renda bruta mensal.
		        <br>
		        - Cópias dos Recibos de Pagamento a Autônomos - RPA - dos últimos 3 meses, no caso de autônomo ou profissional liberal.<br>
		        - Cópias dos recibos de retirada pró-labore, dos últimos 3 meses, e cópia da declaração de imposto de renda de pessoa jurídica, exercício 2016, no caso de proprietário de microempresa.<br>
		        - Declaração de Sindicato ou de Cooperativa de Taxistas, emitida para fins de comprovação de renda mensal do interessado, dos últimos 3 meses, no caso de taxistas.<br>
		        - Cópia da declaração de imposto territorial rural ou a última declaração de renda de atividades rurais, em que se comprove a condição de proprietário de imóvel rural e o exercício de atividades rurais, no caso de produtor rural.
            </div>

			<hr>

			<div class="col-md-12" style="margin-top:20px;">
				<p><strong>02 - Escola em que cursou o Ensino Médio:</strong>  Resposta:
					<strong>
						@if($socio->questao2 == 1)
							Escola pública
						@elseif($socio->questao2 == 2)
							Escola particular, com pagamento integral
						@elseif($socio->questao2 == 3)
							Escola particular, com bolsa parcial (mínimo de 50%)
						@elseif($socio->questao2 == 4)
							Escola particular, com bolsa integral
						@elseif($socio->questao2 == 5)
							Parte em escola particular, com bolsa parcial e parte em escola pública
						@elseif($socio->questao2 == 6)
							Parte em escola pública, parte em escola particular
						@endif
					</strong>
				</p>
			</div>
			<div class="col-md-12 well">
				<b> Documentos para comprovação: </b><br>
				- Histórico escolar ou declaração emitida pela instituição de ensino, assinada pelo diretor, constando o nome da(s) escola(s) em que o candidato cursou ou está cursando cada uma das três séries do Ensino Médio.<br>
		        - Declaração emitida pela instituição de ensino, assinada pelo diretor, indicando a condição especial de pagamento ou bolsa (informar o percentual) com que o candidato foi beneficiado, caso faça o Ensino Médio ou tenha feita alguma das séries em escola particular.
            </div>
			<hr>
			<div class="col-md-12">
				<p><strong>03 - Escola em que fez integralmente o ensino fundamental</strong>  Resposta:
					<strong>
						@if($socio->questao3 == 1)
							Escola pública
						@elseif($socio->questao3 == 2)
							Escola particular, com pagamento integral
						@elseif($socio->questao3 == 3)
							Escola particular, com bolsa parcial (mínimo de 50%)
						@elseif($socio->questao3 == 4)
							Escola particular, com bolsa integral
						@elseif($socio->questao3 == 5)
							Parte em escola particular, com bolsa parcial e parte em escola pública
						@elseif($socio->questao3 == 6)
							Parte em escola pública, parte em escola particular
						@endif
					</strong>
				</p>
			</div>
			<div class="col-md-12 well">
				<b> Documentos para comprovação: </b><br>
				- Histórico escolar ou declaração emitida pela instituição de ensino, assinada pelo diretor, constando o nome da(s) escola(s) em que o candidato cursou cada uma das quatro séries finais do Ensino Fundamental.<br>
					 - Declaração emitida pela instituição de ensino, assinada pelo diretor, indicando a condição de pagamento ou bolsa (informar o percentual) com que o candidato foi beneficiado, caso tenha estudado o Ensino Fundamental em escola particular.
            </div>
			<hr>
			<div class="col-md-12">
				<p><strong>04 - Escola/Instituição em que fez ou está fazendo cursinho pré-vestibular</strong>  Resposta:
					<strong>
						@if($socio->questao4 == 1)
							Escola pública
						@elseif($socio->questao4 == 2)
							Escola particular, com pagamento integral
						@elseif($socio->questao4 == 3)
							Escola particular, com bolsa parcial (mínimo de 50%)
						@elseif($socio->questao4 == 4)
							Escola particular, com bolsa integral
						@elseif($socio->questao4 == 5)
							Não fez cursinho
						@endif
					</strong>
				</p>
			</div>
			<div class="col-md-12 well">
				<b> Documentos para comprovação: </b><br>
				- Declaração emitida pela instituição de ensino, assinada pelo diretor, indicando a condição especial de pagamento ou bolsa (informar o percentual) com que o candidato foi beneficiado para fazer o cursinho pré-vestibular ou declaração de gratuidade do pré-vestibular.
            </div>
			<hr>
			<div class="col-md-12">
				<p><strong>05 - O candidato ou algum membro da famúlia participa de programa
			        social do governo federal</strong>  Resposta:
						<strong>
							@if($socio->questao5 == 1)
								Bolsa Família
							@elseif($socio->questao5 == 2)
								Passe Livre para transportes coletivos interestaduais para deficientes carentes
							@elseif($socio->questao5 == 3)
								Benefício de prestação continuada (BPC)
							@elseif($socio->questao5 == 4)
								Não participa de programas sociais
							@endif
						</strong>
					</p>
			</div>
			<div class="col-md-12 well">
				<b> Documentos para comprovação: </b><br>
				- Cópia de documentos que comprovem a participação
			        do candidato ou de membro do grupo familiar no(s) programa(s) Bolsa-Famúlia
			        (Ministério do Desenvolvimento Social)- último extrato bancário-, Benefúcio de Prestação Continuada (Ministério da Previdência Social), Passe Livre para transportes coletivos municipais e interestaduais para deficientes carentes (Ministério dos Transportes), último extrato.
            </div>
			<hr>
			<div class="col-md-12">
				<p><strong>06 - Situação civil do candidato:</strong>  Resposta:
					<strong>
						@if($socio->questao6 == 1)
							Solteiro(a)
						@elseif($socio->questao6 == 2)
							Casado(a)
						@elseif($socio->questao6 == 3)
							Separado(a)(separação legalizada ou não)/Divorciado
						@elseif($socio->questao6 == 4)
							Viúvo(a)
						@elseif($socio->questao6 == 5)
							União estável
						@endif
					</strong>
				</p>
			</div>
			<div class="col-md-12 well">
				<b> Documentos para comprovação: </b><br>
				- Cópia da Certidão de Casamento do candidato, se for o caso.
			    <br>
				- Cópia de sentença judicial de separação/divórcio do candidato e, se for o caso, de seus pais.
            </div>
			<hr>
			<div class="col-md-12">
				<p><strong>07 - Se o candidato é solteiro e não mora com a famúlia:</strong>  Resposta:
					<strong>
						@if($socio->questao7 == 0)
							Não se aplica
						@elseif($socio->questao7 == 1)
							Mora sozinho, em imóvel próprio
						@elseif($socio->questao7 == 2)
							Mora sozinho, em imóvel alugado
						@elseif($socio->questao7 == 3)
							Mora em república/pensão
						@elseif($socio->questao7 == 4)
							Mora com parentes ou conhecidos
						@endif
					</strong>
				</p>
			</div>
			<div class="col-md-12 well">
				<b> Documentos para comprovação: </b><br>
				- Se o candidato for solteiro e não morar com o grupo familiar, mas em casa alugada, república ou pensão, apresentar cópia do contrato de aluguel em nome do candidato ou de um dos membros do grupo familiar, ou declaração do responsável pela república/pensão de que o candidato mora no local além do comprovante de pagamento de mensalidade.
            </div>
			<hr>
			<div class="col-md-12">
				<p><strong>08 - Situação da casa em que reside o grupo familiar:</strong>  Resposta:
					<strong>
						@if($socio->questao8 == 1)
							Alugada
						@elseif($socio->questao8 == 2)
							Própria (ainda em pagamento)
						@elseif($socio->questao8 == 3)
							Própria (já paga/herdada)
						@elseif($socio->questao8 == 4)
							Cedida por familiares/terceiros
						@endif
					</strong>
				</p>
			</div>
			<div class="col-md-12 well">
				<b> Documentos para comprovação: </b><br>
				- Cópia do contrato de aluguel do imóvel em que reside o grupo familiar, em nome do candidato ou de membros do grupo familiar.<br>
			        - Cópia do contrato de compra e venda do imóvel em que reside o grupo familiar.<br>
			        - Declaração assinada pelo proprietário do imóvel, se a casa em que reside o grupo familiar foi cedida.
            </div>
			<hr>
			<div class="col-md-12">
				<p><strong>9 - Além do próprio candidato, quantos membros do grupo familiar
			        vão se inscrever no programa socioeconômico para concessão
			        de desconto/isenção:</strong>  Resposta:
						<strong>
							@if($socio->questao9 == 1)
								Nenhum membro
							@elseif($socio->questao9 == 2)
								01 membro
							@elseif($socio->questao9 == 3)
								02 ou mais membros
							@endif
						</strong>
					</p>
			</div>
			<div class="col-md-12 well">
				<b> Documentos para comprovação: </b><br>
				- Declaração assinada pelo candidato, indicando o nome,
			        CPF e o n&ordm; de inscrição de cada um dos membros do grupo
			        familiar inscrito no programa, exceto ele.<br>
			        - Cópia da Certidão de Óbito dos pais ou responsável, se for o caso.
            </div>
			<hr>
			<div class="col-md-12">
				<p><strong>10 - O candidato ou membro do grupo familiar utiliza medicamento de uso contúnuo:</strong>  Resposta:
					<strong>
						@if($socio->questao10 == 1)
							Sim
						@elseif($socio->questao10 == 2)
							Não
						@endif
					</strong>
				</p>
			</div>
			<div class="col-md-12 well">
				<b> Documentos para comprovação: </b><br>
				- Cópia da receita do medicamento em nome do candidato ou de membro do grupo familiar, constando o uso contínuo do medicamento, se for o caso.
            </div>
			<hr>
			<div class="col-md-12">
				<p><strong>11 - Participa do programa de tarifa social da COPASA:</strong>  Resposta:
					<strong>
						@if($socio->questao11 == 1)
							Sim
						@elseif($socio->questao11 == 2)
							Não
						@endif
					</strong>
				</p>
			</div>
			<div class="col-md-12 well">
				<b> Documentos para comprovação: </b><br>
				- Cópia da conta (fatura) de água, m&ecirc;s
			        maio ou junho/2017 (não precisa estar quitada).
            </div>
			<hr>
			<div class="col-md-12">
				<p><strong>12 - Participa do programa de tarifa social da CEMIG:</strong> Resposta:
					<strong>
						@if($socio->questao12 == 1)
							Sim
						@elseif($socio->questao12 == 2)
							Não
						@endif
					</strong>
				</p>
			</div>
			<div class="col-md-12 well">
				<b> Documentos para comprovação: </b><br>
				- Cópia da conta (fatura) de energia elétrica, m&ecirc;s
			         maio ou junho/2017 (não precisa estar quitada).
            </div>
			<hr>

			<div class="col-md-12 text-center">
                <img src='{{ asset("etiquetas/{$socio->usuarios[0]->id}.png") }}' alt="">
            </div>

            <div class="col-md-12 text-center" style="margin-top:30px;">
                <p>Montes Claros/MG, {{date('d\/m\/Y', strtotime($socio->created_at))}}</p>
            </div>
            <br/><br/><br/>
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
