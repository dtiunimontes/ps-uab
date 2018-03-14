@extends('layouts.app')

@section('title', $titulo)
@section('content')

{{ Form::open(['url' => route('admin.polos.salvar', $polo->id), 'method' => 'post']) }}
<h3 class="form-section">Polos</h3>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('curso') ? ' has-error' : '' }}">
            <label for="curso_id">Selecione o Curso: <span class="required">*</span></label>
            <select class="form-control" id="curso_id" name="curso_id" @if($ver) readonly @endif>
                @foreach($cursos as $curso)
                   <option value="{{$curso->id}}" @if($curso->id == $polo->curso_id) selected @endif >{{$curso->nome}}</option>
                @endforeach
            </select>
            @if ($errors->has('curso_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('curso_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('polo') ? ' has-error' : '' }}">
            <label for="polo">Nome do Polo: <span class="required">*</span></label>
            <input type="text" class="form-control" id="polo" name="polo" value=" {{ $polo->nome }} " required @if($ver) readonly @endif>
            @if ($errors->has('polo'))
                <span class="help-block">
                    <strong>{{ $errors->first('polo') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
@if(!$ver)
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>
@else
<a href="{{ route('admin.polos.home')}}" class="btn bg-green-jungle bg-font-green-jungle">Voltar</a>
@endif
{{ Form::close() }}
@endsection
