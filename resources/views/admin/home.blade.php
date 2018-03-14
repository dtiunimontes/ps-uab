@extends('layouts.app')
@section('title', 'Administrador ')
@section('content')
<div class="row">
    <div class="col-md-3" style="margin-bottom:15px;">
        <a class="dashboard-stat dashboard-stat-v2 green" href="{{ route('admin.candidatos.home') }}">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc"> Candidatos </div>
            </div>
        </a>
    </div>
    <div class="col-md-3" style="margin-bottom:15px;">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ route('admin.polos.home') }}">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc"> Polos </div>
            </div>
        </a>
    </div>
    <div class="col-md-3" style="margin-bottom:15px;">
        <a class="dashboard-stat dashboard-stat-v2 red" href="{{ route('admin.cursos.home') }}">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc"> Cursos </div>
            </div>
        </a>
    </div>
    <div class="col-md-3" style="margin-bottom:15px;">
        <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{ route('admin.candidatos.receber') }}">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc"> Socio/Reserva </div>
            </div>
        </a>
    </div>
    <!-- <div class="col-md-3" style="margin-bottom:15px;">
        <a class="dashboard-stat dashboard-stat-v2 purple" href="{{ route('admin.candidatos.verificar') }}">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc"> Verificar Envelope </div>
            </div>
        </a>
    </div> -->
    <div class="col-md-3" style="margin-bottom:15px;">
        <a class="dashboard-stat dashboard-stat-v2 green-soft" href="{{ route('admin.candidatos.curso_polo') }}">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc"> Inscrições Curso / Polo </div>
            </div>
        </a>
    </div>
    <div class="col-md-3" style="margin-bottom:15px;">
        <a class="dashboard-stat dashboard-stat-v2 purple-soft" href="{{ route('admin.recursos.home') }}">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc"> Recursos </div>
            </div>
        </a>
    </div>
</div>
@endsection
