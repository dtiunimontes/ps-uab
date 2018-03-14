@extends('layouts.app')
@section('title', 'Recursos ')
@section('content')
<div class="row">
    <div class="col-md-3" style="margin-bottom:15px;">
        <a class="dashboard-stat dashboard-stat-v2 red" href="{{ route('admin.recursos.abertos') }}">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc"> Em aberto </div>
            </div>
        </a>
    </div>
    <div class="col-md-3" style="margin-bottom:15px;">
        <a class="dashboard-stat dashboard-stat-v2 green" href="{{ route('admin.recursos.respondidos') }}">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc"> Respondidos </div>
            </div>
        </a>
    </div>
</div>
@endsection
