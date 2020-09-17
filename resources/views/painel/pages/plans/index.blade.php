@extends('layouts.app')

@section('title', 'Edição')

@section('content')
    <div class="container">
        <div class="row">
            <h1> Planos </h1>
            <a href="{{ route('plans.create') }}" class="btn btn-dark"> Add</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Preco</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{ $plan->name }}</td>
                            <td>R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <a href="{{ route('plans.destroy', $plan->url) }}" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Excluir
                                </a>
                                <a href="{{ route('plans.details.index', $plan->url) }}" class="btn btn-primary">
                                    <i class="fa fa-trash"></i> Detalhes
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
