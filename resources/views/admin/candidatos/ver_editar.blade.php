@extends('layouts.app')

@section('title', 'Inscrição do Candidato')
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
@endpush

{{ Form::open(['url' => route('admin.candidatos.salvar'), 'method' => 'post']) }}

<h3 class="form-section">Dados Pessoais</h3>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nome">Nome Completo: <span class="required">*</span></label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $usuario->nome }}" @if ($ver) readonly @endif>
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
            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $usuario->cpf }}" required @if ($ver) readonly @endif>
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
            <input type="text" class="form-control" id="numero" name="numero" value="{{ $usuario->numero }}" required @if ($ver) readonly @endif>
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
<h3 class="form-section">Informações do Concurso</h3>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="local_prova">Selecione o Local da Prova: <span class="required">*</span></label>
            <select class="form-control" id="local_prova" name="local_prova"  @if ($ver || Auth::user()->permissao == 1) readonly @endif>
                @foreach ($polos as $polo)
                    <option value="{{$polo->id}}" @if ($polo->id == $local_prova->id ) selected @endif>{{$polo->nome}}</option>
                @endforeach
            </select>
            @if ($errors->has('local_prova'))
                <span class="help-block">
                    <strong>{{ $errors->first('local_prova') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="polo_curso_id">Selecione o Curso desejado: <span class="required">*</span></label>
            <select class="form-control" id="curso_id" name="polo_curso_id"  @if ($ver || Auth::user()->permissao == 1) readonly @endif>
                <option>-- Selecione --</option>
                @foreach ($cursos as $c)
                    <option value="{{$c->id}}" @if ($c->id == $curso->id) selected @endif>{{$c->nome}}</option>
                @endforeach
            </select>
            @if ($errors->has('polo_curso_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('polo_curso_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="polo_id">Selecione o Polo desejado: <span class="required">*</span></label>
            <select class="form-control" id="polo_id" name="polo_id" @if ($ver || Auth::user()->permissao == 1) readonly @endif>
                <option value="{{$inscricao->polo->id}}">{{$inscricao->polo->nome}}</option>
            </select>
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
            <select class="form-control" id="modalidade" name="modalidade" @if ($ver || Auth::user()->permissao == 1) readonly @endif>
                <option value="universal" @if ($inscricao->modalidade == 'universal') selected @endif >Universal</option>
                <option value="afrodescendente" @if ($inscricao->modalidade == 'afrodescendente') selected @endif >Afrodescendente, carente</option>
                <option value="escola_publica" @if ($inscricao->modalidade == 'escola_publica') selected @endif >Egresso de Escola Pública, carente</option>
                <option value="deficiencia_indigena" @if ($inscricao->modalidade == 'deficiencia_indigena') selected @endif >Deficiência/Indígena</option>
            </select>
            @if ($errors->has('modalidade'))
                <span class="help-block">
                    <strong>{{ $errors->first('modalidade') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
@if (!$ver)
<h3 class="form-section">Alterar Senha</h3>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="password">Senha: <span class="required">*</span></label>
            <input type="password" id="password" name="password" class="form-control">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="password_confirmation">Confirme a Senha: <span class="required">*</span></label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>
    </div>
</div>
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>
@endif

{{ Form::close() }}

@endsection
