@extends('layouts.app')

@section('title', 'Meus Dados')
@section('content')
@push('scripts')
<script type="text/javascript">

        // if ($("#cep").val() != '') {
        //   var cep = $('#cep').val();
        //   $.ajax({
        //      url: 'http://api.postmon.com.br/v1/cep/'+cep,
        //      type: 'GET',
        //      dataType: 'json',
        //      success: function(json){
        //          if (typeof json.estado != 'undefined') {
        //              $('#cidade').val(json.cidade);
        //              $('#logradouro').val(json.logradouro);
        //              $('#bairro').val(json.bairro);
        //              $('#estado').html('<option value="'+json.estado+'">'+json.estado+'</option>');
        //              //$('#cidade').prop('readonly', true);
        //              //$('#bairro').prop('readonly', true);
        //          }
        //      }
        //   })
        // }
        $('#cep').blur(function(){
           var cep = $('#cep').val();
           $.ajax({
              url: 'http://api.postmon.com.br/v1/cep/'+cep,
              type: 'GET',
              dataType: 'json',
              success: function(json){
                  if (typeof json.estado != 'undefined') {
                      $('#cidade').val(json.cidade);
                      $('#logradouro').val(json.logradouro);
                      $('#bairro').val(json.bairro);
                      $('#estado').val(json.estado);
                      // $('#cidade').prop('readonly', true);
                      // $('#bairro').prop('readonly', true);
                  }
              }
           })
        })
        $(document).ready(function(){
        $("#curso_id").change(function(){
            var curso = $("#curso_id").val();
            if(curso != ''){
                $.ajax({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'post',
                url: '{{ route('inscricao.polos') }}',
                data: '&curso='+curso,
                success:
                    function(success){
                        if (success.length == 0){
                            $("#polo_id").html('<option value=""></option>');
                        }else{
                            var options;
                            for (var i = 0; i < success.length; i++){
                                options += '<option value="'+success[i].id+'">'+success[i].nome+'</option>';
                            }
                            $('#polo_id').html(options);
                        }
                    }
                })
            } else {
                console.log('erro');
                $("#polo_id").html('<option value=""></option>');
            }
        })
    })
</script>
<script language="Javascript">
function confirmacao(){
     var resposta = confirm("Tem Certeza de que deseja cancelar sua inscrição?\nImportante: Caso cancele a inscrição o cadastro de socioeconômico (caso preenchido) automaticamente será cancelado.\nAo realizar nova incrição é necessário cadastrar novamente o socioeconômico.");
     if (resposta == true){
       document.forms['cancelar'].submit();
     }
}
</script>
@endpush

{{ Form::open(['url' => route('minhaconta.salvar'), 'method' => 'post']) }}

<h3 class="form-section">Dados Pessoais</h3>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nome">Nome: <span class="required">*</span></label>
            <input type="hidden" name="id" value="{{ $usuario->id }}">
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $usuario->nome }}" @if ($ver) readonly @endif>
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
            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $usuario->cpf }}" required readonly>
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
            <input type="text" class="form-control" id="rg" name="rg" value="{{ $usuario->rg }}" required @if ($ver) readonly @endif>
            @if ($errors->has('rg'))
                <span class="help-block">
                    <strong>{{ $errors->first('rg') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('rg') ? ' has-error' : '' }}">
            <label>Org. Exp: <span class="required">*</span></label>
            <input type="text" class="form-control" name="org_exped" value="{{ $usuario->org_exped }}" maxlength="10" required @if ($ver) readonly @endif>
            @if ($errors->has('org_exped'))
                <span class="help-block">
                    <strong>{{ $errors->first('org_exped') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('data_nasc') ? ' has-error' : '' }}">
            <label for="data_nasc">Data de nascimento: <span class="required">*</span></label>
            <input type="text" class="form-control" id="data_nasc" name="data_nasc" value="{{ date('dmY', strtotime($usuario->data_nasc)) }}" required @if ($ver) readonly @endif>
            @if ($errors->has('data_nasc'))
                <span class="help-block">
                    <strong>{{ $errors->first('data_nasc') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('necessidade_especial') ? ' has-error' : '' }}">
            <label for="necessidade_especial">Portador de necessidades especiais: </label>
            <select class="form-control" name="necessidade_especial" @if ($ver) readonly @endif>
                <option value="nao" @if ($usuario->necessidade_especial == 'nao') selected @endif>Não</option>
                <option value="auditiva" @if ($usuario->necessidade_especial == 'auditiva') selected @endif>Deficiente auditivo</option>
                <option value="fisica" @if ($usuario->necessidade_especial == 'fisica') selected @endif>Deficiente físico</option>
                <option value="visual" @if ($usuario->necessidade_especial == 'visual') selected @endif>Deficiente visual</option>
            </select>
            @if ($errors->has('necessidade_especial'))
                <span class="help-block">
                    <strong>{{ $errors->first('necessidade_especial') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<h3 class="form-section">Dados de contato</h3>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">E-mail: <span class="required">*</span></label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}" required @if ($ver) readonly @endif>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('telefone') ? ' has-error' : '' }}">
            <label for="telefone">Telefone: <span class="required">*</span></label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $usuario->telefone }}" required @if ($ver) readonly @endif>
            @if ($errors->has('telefone'))
                <span class="help-block">
                    <strong>{{ $errors->first('telefone') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('cep') ? ' has-error' : '' }}">
            <label for="cep">CEP: <span class="required">*</span></label>
            <input type="text" class="form-control" id="cep" name="cep" value="{{ $usuario->cep }}" required @if ($ver) readonly @endif>
            @if ($errors->has('cep'))
                <span class="help-block">
                    <strong>{{ $errors->first('cep') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group {{ $errors->has('logradouro') ? ' has-error' : '' }}">
            <label for="logradouro">Endereço: <span class="required">*</span></label>
            <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ $usuario->logradouro }}" required @if ($ver) readonly @endif>
            @if ($errors->has('logradouro'))
                <span class="help-block">
                    <strong>{{ $errors->first('logradouro') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('numero') ? ' has-error' : '' }}">
            <label for"numero">Número: <span class="required">*</span></label>
            <input type="number" class="form-control" id="numero" name="numero" value="{{ $usuario->numero }}" required @if ($ver) readonly @endif>
            @if ($errors->has('numero'))
                <span class="help-block">
                    <strong>{{ $errors->first('numero') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('complemento') ? ' has-error' : '' }}">
            <label for="complemento">Complemento: </label>
            <input type="text" class="form-control" id="complemento" name="complemento" value="{{ $usuario->complemento }}" @if ($ver) readonly @endif>
            @if ($errors->has('complemento'))
                <span class="help-block">
                    <strong>{{ $errors->first('complemento') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('bairro') ? ' has-error' : '' }}">
            <label for="bairro">Bairro: <span class="required">*</span></label>
            <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $usuario->bairro }}" required @if ($ver) readonly @endif>
            @if ($errors->has('bairro'))
                <span class="help-block">
                    <strong>{{ $errors->first('bairro') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('cidade') ? ' has-error' : '' }}">
            <label for="cidade">Cidade: <span class="required">*</span></label>
            <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $usuario->cidade }}" required @if ($ver) readonly @endif>
            @if ($errors->has('cidade'))
                <span class="help-block">
                    <strong>{{ $errors->first('cidade') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
            <label for="estado">Estado: <span class="required">*</span></label>
            <input type="text" class="form-control" id="estado" name="estado" value="{{ $usuario->estado }}" required @if ($ver) readonly @endif>
            @if ($errors->has('estado'))
                <span class="help-block">
                    <strong>{{ $errors->first('estado') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
@if($inscricao != null)
<h3 class="form-section">Informações do Concurso</h3>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="local_prova">Local da Prova: <span class="required">*</span></label>
            <input type="text" class="form-control" id="local_prova" name="local_prova" value="{{$local_prova->nome}}" readonly>
            @if ($errors->has('local_prova'))
                <span class="help-block">
                    <strong>{{ $errors->first('local_prova') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="polo_curso_id">Curso Desejado: <span class="required">*</span></label>
            <input type="text" class="form-control" id="curso_id" name="curso_id" value="{{$curso->nome}}" readonly>
            @if ($errors->has('polo_curso_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('polo_curso_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="polo_id">Polo do Curso Desejado: <span class="required">*</span></label>
            <input type="text" class="form-control" id="polo_id" name="polo_id" value="{{$inscricao->polo->nome}}" readonly>
            @if ($errors->has('polo_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('polo_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
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
</div>
@else
<h3 class="form-section">Você não está inscrito em nenhum curso</h3>
@endif
<div class="row">
    <div class="col-md-4">
@if (!$ver)
    <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Alterar Dados Pessoais</button>
@endif
{{ Form::close() }}
    </div>
    <div class="col-md-4">
{{ Form::open(['url' => route('minhaconta.cancelar_inscricao'), 'method' => 'post', 'name' => 'cancelar']) }}
@if($inscricao != null)
    <input type="hidden" name="id" value="{{ $inscricao->id }}">
    <button type="button" onclick="confirmacao()" class="btn bg-red bg-font-red">Cancelar Inscrição Atual</button>
@endif
{{ Form::close() }}
</div>
</div>
@endsection
