@extends('layouts.app')

@section('title', 'Inscrição')
@section('content')

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        if ($("#cep").val() != '') {
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
                     $('#estado').html('<option value="'+json.estado+'">'+json.estado+'</option>');
                     //$('#cidade').prop('readonly', true);
                     //$('#bairro').prop('readonly', true);
                 }
             }
          })
        }
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
@if(date('Y-m-d H:i') < '2017-10-26 18:00')

{{ Form::open(['url' => route('register'), 'method' => 'post']) }}

<h3 class="form-section">Dados Pessoais</h3>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nome">Nome completo: <span class="required">*</span></label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
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
            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}" required>
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
            <input type="text" class="form-control" id="rg" name="rg" value="{{ old('rg') }}" required>
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
            <input type="text" class="form-control" name="org_exped" value="{{ old('org_exped') }}" maxlength="10" required>
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
            <input type="text" class="form-control" id="data_nasc" name="data_nasc" value="{{ old('data_nasc') }}" required>
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
            <select class="form-control" name="necessidade_especial">
                <option value="nao" @if (old('necessidade_especial') == 'nao') selected @endif>Não</option>
                <option value="auditiva" @if (old('necessidade_especial') == 'auditiva') selected @endif>Deficiente auditivo</option>
                <option value="fisica" @if (old('necessidade_especial') == 'fisica') selected @endif>Deficiente físico</option>
                <option value="visual" @if (old('necessidade_especial') == 'visual') selected @endif>Deficiente visual</option>
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
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
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
            <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone') }}" required>
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
            <input type="text" class="form-control" id="cep" name="cep" value="{{ old('cep') }}" required>
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
            <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ old('logradouro') }}" required>
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
            <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero') }}" required>
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
            <input type="text" class="form-control" id="complemento" name="complemento" value="{{ old('complemento') }}">
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
            <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro') }}" required>
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
            <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade') }}" required>
            @if ($errors->has('cidade'))
                <span class="help-block">
                    <strong>{{ $errors->first('cidade') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <!-- <div class="col-md-4">
        <div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
            <label for="estado">Estado: <span class="required">*</span></label>
            <input type="text" class="form-control" id="estado" name="estado" value="{{ old('estado') }}" required>
            @if ($errors->has('estado'))
                <span class="help-block">
                    <strong>{{ $errors->first('estado') }}</strong>
                </span>
            @endif
        </div>
    </div> -->
   <div class="col-md-4">
        <div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
            <label for="estado">Estado: <span class="required">*</span></label>
            <input type="text" class="form-control" id="estado" name="estado" value="{{ old('estado') }}" required>
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
            <select class="form-control" id="local_prova" name="local_prova">
                @foreach ($local_prova as $local)
                    <option value="{{$local->id}}" @if (old('local_prova') == $local->nome) selected @endif>{{$local->nome}}</option>
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
            <select class="form-control" id="curso_id" name="polo_curso_id">
                <option>-- Selecione --</option>
                @foreach ($cursos as $curso)
                    <option value="{{$curso->id}}" @if (old('polo_curso_id') == $curso->nome) selected @endif>{{$curso->nome}}</option>
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
            <select class="form-control" id="polo_id" name="polo_id"></select>
            @if ($errors->has('polo_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('polo_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="modalidade">Modalidade / Pré-Inscrição Reserva de Vagas: <span class="required">*</span></label>
            <select class="form-control" id="modalidade" name="modalidade">
                <option value="universal">Universal</option>
                @if(date('Y-m-d H:i') < '2017-08-29 18:00')
                    <option value="afrodescendente">Afrodescendente, carente</option>
                    <option value="escola_publica">Egresso de Escola Pública, carente</option>
                    <option value="deficiencia_indigena">Deficiência/Indígena</option>
                @endif
            </select>
            @if ($errors->has('modalidade'))
                <span class="help-block">
                    <strong>{{ $errors->first('modalidade') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<h3 class="form-section">Cadastre uma Senha</h3>
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
<h3 class="form-section">Declaração</h3>
    <div class="col-md-12">
        <div class="note note-info">
            <h4 class="block"><strong>Nota:</strong></h4>
            <p> Com o preenchimento da Ficha de Inscrição, o candidato declara: </p>
            <p>a) estar ciente e aceitar as normas constantes no Edital.</p>
            <p>b) o preenchimento desta ficha e as informações prestadas são de inteira responsabilidade do(a) candidato(a) .</p>
            <p>c) estar ciente de que não serão permitidas alterações posteriores.</p>
            <p>d) ao cadastrar sua senha, você poderá acessar a área do inscrito posteriormente.</p>
        </div>
    </div>
    <div class="col-md-12">
        <label class="mt-checkbox mt-checkbox-outline">
            <input type="checkbox" required > Declaro atender as condições exigidas para inscrição, conhecer o Edital do Processo e concordo com o mesmo.
            <span></span>
        </label>
    </div>
    <div class="col-md-12">
        <label class="mt-checkbox mt-checkbox-outline">
            <input type="checkbox" required > Declaro ter concluído o ensino médio ou equivalente conforme item 1.1.1 do Edital.
            <span></span>
        </label>
    </div>
</div>
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>

{{ Form::close() }}
@else
<h3 class="form-section">Inscrições Encerradas...</h3>
@endif
@endsection
