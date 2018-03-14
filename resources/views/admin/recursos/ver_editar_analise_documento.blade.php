@extends('layouts.app')

@section('title', 'Análise de Documentação')
@section('content')
@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $("#indeferido").change(function(){
        document.getElementById('justificativa_reserva').required = true;
        document.getElementById('justificativa_reserva').readOnly = '';
    })
    $("#deferido").change(function(){
        document.getElementById('justificativa_reserva').readOnly = true;
    })
})
$(document).ready(function(){
    $("#d").change(function(){
        document.getElementById('justificativa_socio').required = true;
        document.getElementById('justificativa_socio').readOnly = '';
        document.getElementById('indeferido').selected = true;
    })
    $("#a").change(function(){
        document.getElementById('justificativa_socio').readOnly = true;
    })
    $("#b").change(function(){
        document.getElementById('justificativa_socio').readOnly = true;
    })
    $("#c").change(function(){
        document.getElementById('justificativa_socio').readOnly = true;
    })
})
</script>
@endpush

{{ Form::open(['url' => route('admin.recursos.responder'), 'method' => 'post']) }}

<h3 class="form-section">Dados Pessoais</h3>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nome">Nome Completo: <span class="required">*</span></label>
            <input type="hidden" name="id" value="{{ $usuario->id }}">
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $usuario->nome }}" readonly>
            <input type="hidden" name="id" value="{{ $usuario->id}}">
            @if ($errors->has('nome'))
                <span class="help-block">
                    <strong>{{ $errors->first('nome') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('cpf') ? ' has-error' : '' }}">
            <label for="cpf">CPF: <span class="required">*</span></label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $usuario->cpf }}" readonly>
            @if ($errors->has('cpf'))
                <span class="help-block">
                    <strong>{{ $errors->first('cpf') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('rg') ? ' has-error' : '' }}">
            <label for="rg">RG: <span class="required">*</span></label>
            <input type="text" class="form-control" id="rg" name="rg" value="{{ $usuario->rg }}" readonly>
            @if ($errors->has('rg'))
                <span class="help-block">
                    <strong>{{ $errors->first('rg') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('org_exped') ? ' has-error' : '' }}">
            <label>Org. Exp: <span class="required">*</span></label>
            <input type="text" class="form-control" name="org_exped" value="{{ $usuario->org_exped }}" maxlength="10" readonly>
            @if ($errors->has('org_exped'))
                <span class="help-block">
                    <strong>{{ $errors->first('org_exped') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="modalidade">Modalidade: <span class="required">*</span></label>
            <input type="text" class="form-control" id="modalidade" name="modalidade"
            value="<?php if ($inscricao->modalidade == 'universal') echo 'Universal';
                elseif ($inscricao->modalidade == 'afrodescendente') echo 'Afrodescendente, carente';
                elseif ($inscricao->modalidade == 'escola_publica') echo 'Egresso de Escola Pública, carente';
                elseif ($inscricao->modalidade == 'deficiencia_indigena') echo 'Deficiência/Indígena'; ?>" readonly>
            @if ($errors->has('modalidade'))
                <span class="help-block">
                    <strong>{{ $errors->first('modalidade') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="status">Status: <span class="required">*</span></label>
            <input type="text" class="form-control" id="status" name="status"
            value="<?php if ($inscricao->status == '1') echo 'Aguardando Pagamento';
                elseif ($inscricao->status == '2') echo 'Isento';
                elseif ($inscricao->status == '3') echo 'Pago';?>" readonly>
            @if ($errors->has('status'))
                <span class="help-block">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>
    </div>



    <div class="col-md-12">
        <div class="form-group {{ $errors->has('socio') ? ' has-error' : '' }}">
            <label for="socio"> Socioeconômico: <span class="required">*</span></label><br/>
                <input type="radio" class="socio" id="a" name="socio" value="a" @if ($inscricao->valor == '00,00') checked="checked" @endif >  00,00 - Deferido<br/>
                <input type="radio" class="socio" id="b" name="socio" value="b" @if ($inscricao->valor == '29,00') checked="checked" @endif >  29,00 - Deferido<br/>
                <input type="radio" class="socio" id="c" name="socio" value="c" @if ($inscricao->valor == '42,00') checked="checked" @endif >  42,00 - Deferido<br/>
                <input type="radio" class="socio" id="d" name="socio" value="d" @if ($inscricao->valor == '100,00') checked="checked" @endif > 100,00 - Indeferido<br/>
            @if ($errors->has('socio'))
                <span class="help-block">
                    <strong>{{ $errors->first('socio') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('justificativa_socio') ? ' has-error' : '' }}">
            <label>Justificativa Socioeconômico: <span class="required">*</span></label>
            <textarea name="justificativa_socio" id="justificativa_socio" rows="8" class="form-control" readonly>{{$recurso->justificativa}}</textarea>
            @if ($errors->has('justificativa_socio'))
                <span class="help-block">
                    <strong>{{ $errors->first('justificativa_socio') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('recurso') ? ' has-error' : '' }}">
            <label>Recurso: <span class="required">*</span></label>
            <textarea name="recurso" id="recurso" rows="8" class="form-control" readonly>{{$recurso->recurso}}</textarea>
            @if ($errors->has('recurso'))
                <span class="help-block">
                    <strong>{{ $errors->first('recurso') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('resposta_socio') ? ' has-error' : '' }}">
            <label>Resposta do Recurso Socioeconômico: <span class="required">*</span></label>
            <textarea name="resposta_socio" id="resposta_socio" rows="8" class="form-control" readonly>{{$recurso->resposta_recurso}}</textarea>
            @if ($errors->has('resposta_socio'))
                <span class="help-block">
                    <strong>{{ $errors->first('resposta_socio') }}</strong>
                </span>
            @endif
        </div>
    </div>



    <div class="col-md-12">
        <div class="form-group {{ $errors->has('acao') ? ' has-error' : '' }}">
            <label for="acao"> Reserva de Vagas: <span class="required">*</span></label><br/>
                <input type="radio" class="acao" id="deferido" name="acao" value="deferido" @if ($recurso->status_res == '2') checked="checked" @endif> Deferido<br/>
                <input type="radio" class="acao" id="indeferido" name="acao" value="indeferido" @if ($recurso->status_res == '3') checked="checked" @endif> Indeferido<br/>
            @if ($errors->has('acao'))
                <span class="help-block">
                    <strong>{{ $errors->first('acao') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('justificativa_reserva') ? ' has-error' : '' }}">
            <label>Justificativa Reserva: <span class="required">*</span></label>
                <textarea name="justificativa_reserva" id="justificativa_reserva" rows="8" class="form-control" readonly>{{$recurso->justificativa_res}}</textarea>
            @if ($errors->has('justificativa_reserva'))
                <span class="help-block">
                    <strong>{{ $errors->first('justificativa_reserva') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('recurso') ? ' has-error' : '' }}">
            <label>Recurso: <span class="required">*</span></label>
                <textarea name="recurso" id="recurso" rows="8" class="form-control" readonly>{{$recurso->recurso_res}}</textarea>
            @if ($errors->has('recurso'))
                <span class="help-block">
                    <strong>{{ $errors->first('recurso') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('resposta_res') ? ' has-error' : '' }}">
            <label>Resposta do Recurso de Reserva de Vagas: <span class="required">*</span></label>
            <textarea name="resposta_res" id="resposta_res" rows="8" class="form-control" readonly>{{$recurso->resposta_recurso_res}}</textarea>
            @if ($errors->has('resposta_res'))
                <span class="help-block">
                    <strong>{{ $errors->first('resposta_res') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
@if (isset($rec) && $rec == 2)
    <a href="{{ route('admin.recursos.respondidos') }}" class="btn bg-green-jungle bg-font-green-jungle">Voltar</a>
@elseif (isset($rec) && $rec == 5)
    <a href="{{ route('minhaconta.home') }}" class="btn bg-green-jungle bg-font-green-jungle">Voltar</a>
@else
    <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>
    @if (isset($rec))
        <a href="{{ route('admin.recursos.abertos') }}" class="btn bg-green-jungle bg-font-green-jungle">Voltar</a>
    @endif
@endif
{{ Form::close() }}

@endsection
