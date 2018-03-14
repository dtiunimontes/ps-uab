@extends('layouts.app')
@section('title', 'Inscrição Processo de Seleção Cursos Licenc./Tec UAB ')
@section('content')
<div class="row">
    <div class="col-md-4">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ route('register') }}">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc"> Nova Inscrição </div>
            </div>
        </a>
    </div>
</div>
@endsection
