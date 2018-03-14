@extends('layouts.app')

@section('title', 'Nova Inscrição')
@section('content')
@push('scripts')
<script type="text/javascript">
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
        });

        $('#inscricao').on('submit', function(){
            $('#btn-submit').attr('disabled', 'disabled');
        });
    });
</script>
@endpush

{{ Form::open(['url' => route('minhaconta.novainscricao.salvar'), 'method' => 'post', 'id' => 'inscricao']) }}

<h3 class="form-section">Informações do Concurso</h3>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="local_prova">Selecione o Local da Prova: <span class="required">*</span></label>
            <select class="form-control" id="local_prova" name="local_prova">
                @foreach ($polos as $polo)
                    <option value="{{$polo->id}}" @if (old('local_prova') == $polo->nome) selected @endif>{{$polo->nome}}</option>
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
<button type="submit" id="btn-submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>
{{ Form::close() }}
@endsection
