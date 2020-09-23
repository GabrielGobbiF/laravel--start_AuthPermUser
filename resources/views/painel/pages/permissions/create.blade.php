@extends('layouts.app')

@section('title', 'Cadastrar')

@section('content')
    <div class="container">
        <h1>Adicionar Novo Perfil</h1>

        <div class="card">
            <form role="form" id="form" novalidate="novalidate" action="{{ route('permissions.store') }}" method="POST">
                @include('painel.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@stop
