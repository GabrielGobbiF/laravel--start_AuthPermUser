@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <h1>Planos</h1>
    <a href="{{ route('plans.create') }}" class="btn btn-dark"> Add</a>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <form action="{{ route('plans.search') }}" method="POST" class="form form-inline">
                @csrf
                <div class="form-group">
                    <input type="text" class="text" name="filter" class="form-control" value="{{$filters['filter'] ?? ''}}">
                </div>
                <button type="submit" class="btn btn-dark">pesquisar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{ $plan->name }}</td>
                            <td>R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-primary "><i
                                        class="fa fa-edit"></i></a>
                                <a href="{{ route('plans.destroy', $plan->url) }}" class="btn btn-danger "><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
            @endif
        </div>
    </div>
@stop
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
