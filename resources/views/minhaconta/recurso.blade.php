@extends('layouts.app')

@section('title', 'Recursos')
@section('content')

{{ Form::open(['url' => route('minhaconta.recurso_usuario'), 'method' => 'post']) }}

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
    @if($recurso->status_socio == 3)
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('justificativa') ? ' has-error' : '' }}">
                <label>Motivos do Indeferimento do Socioeconômico: <span class="required">*</span></label>
                <textarea name="justificativa" rows="8" class="form-control" readonly>{{ $recurso->justificativa }}</textarea>
                @if ($errors->has('justificativa'))
                    <span class="help-block">
                        <strong>{{ $errors->first('justificativa') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('recurso') ? ' has-error' : '' }}">
                <label>Recurso Socioeconômico: <span class="required">*</span></label>
                <textarea name="recurso" rows="8" class="form-control" required></textarea>
                @if ($errors->has('recurso'))
                    <span class="help-block">
                        <strong>{{ $errors->first('recurso') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    @endif
    @if($recurso->status_res == 3)
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('justificativa_res') ? ' has-error' : '' }}">
                <label>Motivos do Indeferimento da Reserva de Vagas: <span class="required">*</span></label>
                <textarea name="justificativa_res" rows="8" class="form-control" readonly>{{ $recurso->justificativa_res }}</textarea>
                @if ($errors->has('justificativa_res'))
                    <span class="help-block">
                        <strong>{{ $errors->first('justificativa_res') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('recurso_res') ? ' has-error' : '' }}">
                <label>Recurso da Reserva de Vagas: <span class="required">*</span></label>
                <textarea name="recurso_res" rows="8" class="form-control" required></textarea>
                @if ($errors->has('recurso_res'))
                    <span class="help-block">
                        <strong>{{ $errors->first('recurso_res') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    @endif
</div>
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>

{{ Form::close() }}

@endsection
