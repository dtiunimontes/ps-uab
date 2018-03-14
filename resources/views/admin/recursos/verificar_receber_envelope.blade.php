@extends('layouts.app')

@section('title', $titulo)
@section('content')

@push('scripts')
    <script type="text/javascript">
        function bloquearCtrlJ(){   // Verificação das Teclas
            var tecla=window.event.keyCode;   //Para controle da tecla pressionada
            var ctrl=window.event.ctrlKey;    //Para controle da Tecla CTRL
            if (ctrl && tecla==74){    //Evita teclar ctrl + j
                event.keyCode=0;
                event.returnValue=false;
            }
        }
    </script>
@endpush

{{ Form::open(['url' => route('admin.candidatos.recebimento_envelope'), 'method' => 'post']) }}

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('id') ? ' has-error' : '' }}">
            <label for="id">Código de Barras: <span class="required">*</span></label>
            <input type="text" class="form-control" id="id" name="id" onKeyDown="bloquearCtrlJ()">
            <input type="hidden" name="acao" value=" {{ $acao }} ">
            @if ($errors->has('id'))
                <span class="help-block">
                    <strong>{{ $errors->first('id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('cpf') ? ' has-error' : '' }}">
            <label for="cpf">CPF: <span class="required">*</span></label>
            <input type="text" class="form-control" id="cpf" name="cpf">
            @if ($errors->has('cpf'))
                <span class="help-block">
                    <strong>{{ $errors->first('cpf') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>

{{ Form::close() }}

@endsection
