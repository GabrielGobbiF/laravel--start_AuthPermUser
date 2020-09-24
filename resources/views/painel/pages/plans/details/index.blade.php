@extends('layouts.app')

@section('title', "Detalhes do Plano {$plan->name}")

@section('content')
    <div class="container">
        <div class="row">
            <h1> Detalhes do Plano {{ $plan->name }} </h1>
            <a href="{{ route('plans.details.create', $plan->url) }}" class="btn btn-dark"> Add</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>{{ $detail->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('plans.details.show', [$plan->url, $detail->id]) }}"
                                    class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a href="{{ route('plans.details.destroy', [$plan->url, $detail->id]) }}"
                                    class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
