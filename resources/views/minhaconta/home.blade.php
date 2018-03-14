@extends('layouts.app')
@section('title', 'Inscrição ')
@section('content')
<div class="row">
    <div class="col-md-3" style="margin-bottom:15px;">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ route('minhaconta.meus_dados') }}">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc"> Meus Dados </div>
            </div>
        </a>
    </div>
    @if($inscricao !=  null)
        @if($inscricao->valor!='00,00')
            <div class="col-md-3" style="margin-bottom:15px;">
                <a class="dashboard-stat dashboard-stat-v2 blue-soft" href="{{ route('minhaconta.dae') }}">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="desc"> Emitir DAE </div>
                    </div>
                </a>
            </div>
            @if($inscricao->vencimento == '2017-08-31' || $inscricao->vencimento == '2017-09-29' || $inscricao->vencimento == '2017-10-26'|| $inscricao->vencimento == '2017-11-14')
                <div class="col-md-3" style="margin-bottom:15px;">
                    <a class="dashboard-stat dashboard-stat-v2 blue-soft" href="{{ route('minhaconta.atualiza_vencimento') }}">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="desc"> Atualizar Vencimento da DAE </div>
                        </div>
                    </a>
                </div>
            @endif
        @else
            <div class="col-md-3" style="margin-bottom:15px;">
                <a class="dashboard-stat dashboard-stat-v2 blue-soft" href="#">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="desc"> Você foi Isento </div>
                    </div>
                </a>
            </div>
        @endif
        <div class="col-md-3" style="margin-bottom:15px;">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="{{ route('minhaconta.comprovante') }}">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="desc"> Comprovante de Inscrição </div>
                </div>
            </a>
        </div>
        @if(date('Y-m-d H:i') < '2017-10-05 18:00')
            <div class="col-md-3" style="margin-bottom:15px;">
                <a class="dashboard-stat dashboard-stat-v2 red" href="{{ route('minhaconta.socioeconomico.inscrever') }}">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="desc"> Inscrever no Socio-econômico </div>
                    </div>
                </a>
            </div>
        @endif
        @if($inscricao != null)
            @if($inscricao->modalidade == 'afrodescendente' || $inscricao->modalidade == 'deficiencia_indigena')
                <div class="col-md-3" style="margin-bottom:15px;">
                    <a class="dashboard-stat dashboard-stat-v2 green-soft" href="{{ route('minhaconta.socioeconomico.declaracao') }}">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="desc"> Declaração - Reserva de Vagas </div>
                            <div class="desc"> (Imprimir e colocar dentro do envelope) </div>
                        </div>
                    </a>
                </div>
            @endif
        @endif
        @if($socio!=null)
            <div class="col-md-3" style="margin-bottom:15px;">
                <a class="dashboard-stat dashboard-stat-v2 yellow-soft" href="{{ route('minhaconta.socioeconomico.comprovante') }}">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="desc"> Comprovante Socio-econômico </div>
                        <div class="desc"> (Imprimir e colar no envelope) </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3" style="margin-bottom:15px;">
                <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{ route('minhaconta.socioeconomico.questionario') }}">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="desc"> Questionário Socio-econômico </div>
                        <div class="desc"> (Imprimir e colocar dentro do envelope) </div>
                    </div>
                </a>
            </div>
        @endif
        @if($recurso != null && ($recurso->status_socio == 3 || $recurso->status_res == 3))
            <!-- <div class="col-md-3" style="margin-bottom:15px;">
                <a class="dashboard-stat dashboard-stat-v2 red-soft" href="{{ route('minhaconta.recurso') }}">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="desc"> Enviar Recurso </div>
                    </div>
                </a>
            </div> -->
        @endif
        @if($recurso != null)
            <div class="col-md-3" style="margin-bottom:15px;">
                <a class="dashboard-stat dashboard-stat-v2 red-soft" href="{{ route('minhaconta.resposta', $usuario->id) }}">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="desc"> Resultado Recurso </div>
                    </div>
                </a>
            </div>
        @endif
    @else
        <div class="col-md-3" style="margin-bottom:15px;">
            <a class="dashboard-stat dashboard-stat-v2 green" href="{{ route('minhaconta.novainscricao') }}">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="desc"> Efeturar nova Inscrição </div>
                </div>
            </a>
        </div>
    @endif
</div>
@endsection
