@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <h1>Adicionar Novo Plano</h1>
@stop

@section('content')
    <div class="card">
        <form role="form" id="form" novalidate="novalidate" action="{{ route('plans.store') }}" method="POST">
            @csrf
            @include('painel.pages.plans._partials.form')
        </form>
    </div>
@stop
