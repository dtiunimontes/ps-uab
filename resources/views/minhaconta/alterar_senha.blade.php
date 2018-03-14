@extends('layouts.app')

@section('title', 'Alterar Senha')
@section('content')

{{ Form::open(['url' => route('minhaconta.alterar_senha'), 'method' => 'post']) }}

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <input type="hidden" name="id" value="{{$usuario->id}}">
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

{{ Form::close() }}

@endsection
