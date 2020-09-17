@extends('layouts.app')

@section('title', 'Cadastrar')

@section('content')
    <div class="container">
        <h1>Adicionar Novo Plano</h1>

        <div class="card">
            <form role="form" id="form" novalidate="novalidate" action="{{ route('plans.store') }}" method="POST">
                @csrf
                @include('painel.pages.plans._partials.form')
            </form>
        </div>
    </div>
@stop
