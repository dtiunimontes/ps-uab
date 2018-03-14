@extends('layouts.app')

@section('title', 'Selecionar Curso/Polo')
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
        })
    })
</script>
@endpush
{{ Form::open(['url' => route('admin.candidatos.listar'), 'method' => 'post']) }}

<h3 class="form-section">Listar Inscrições</h3>
<div class="row">
		<div class="col-md-4">
				<div class="form-group">
						<label for="curso_id">Curso: <span class="required">*</span></label>
						<select class="form-control" id="curso_id" name="curso_id" required>
								<option value="">--SELECIONE--</option>
								@foreach ($cursos as $curso):
										<option value="{{ $curso->id }}">{{ $curso->nome }}</option>
								@endforeach
						</select>
				</div>
		</div>
		<div class="col-md-4">
        <div class="form-group">
            <label for="polo_id">Polo: <span class="required">*</span></label>
            <select class="form-control" id="polo_id" name="polo_id" required></select>
            @if ($errors->has('polo_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('polo_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
		<div class="col-md-4">
        <div class="form-group">
            <label for="inscricao">Inscrição: <span class="required">*</span></label>
            <select class="form-control" id="inscricao" name="inscricao" required>
								<option value="">--SELECIONE--</option>
								<option value="0">Inscrição Cancelada</option>
								<option value="1">Aguardando Pagamento</option>
								<option value="2">Isento</option>
								<option value="3">Paga</option>
								<option value="4">Todas Inscrições</option>
						</select>
            @if ($errors->has('inscricao'))
                <span class="help-block">
                    <strong>{{ $errors->first('inscricao') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>
{{ Form::close() }}

@endsection
