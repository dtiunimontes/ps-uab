@extends('layouts.app')

@section('title', 'Adicionar Cursos')
@section('content')

{{ Form::open(['url' => route('admin.cursos.salvar', $curso->id), 'method' => 'post']) }}
<h3 class="form-section">Cursos</h3>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nome">Nome do Curso: <span class="required">*</span></label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $curso->nome }}" required @if($ver) readonly @endif>
            @if ($errors->has('nome'))
                <span class="help-block">
                    <strong>{{ $errors->first('nome') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
@if(!$ver)
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>
@else
<a href="{{ route('admin.cursos.home')}}" class="btn bg-green-jungle bg-font-green-jungle">Voltar</a>
@endif
{{ Form::close() }}
@endsection
