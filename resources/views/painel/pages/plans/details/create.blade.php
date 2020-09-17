@extends('adminlte::page')

@section('title', 'Cadastrar')

@section('content')
    <div class="container">
        <h1>Adicionar Novo Detalhe no Plano {{$plan->name ?? ''}} </h1>

        <div class="card">
            <form role="form" id="form" novalidate="novalidate" action="{{ route('plans.details.store', $plan->url) }}" method="POST">
                @csrf
                @include('painel.pages.plans._partials.form_details')
            </form>
        </div>
    </div>
@stop
