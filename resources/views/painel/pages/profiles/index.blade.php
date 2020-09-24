@extends('layouts.app')

@section('title', 'Perfis')

@section('content')
    <div class="container">
        <div class="row">
            <h1> Perfis </h1>
            <a href="{{ route('profiles.create') }}" class="btn btn-dark"> Add</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile)
                        <tr>
                            <td>{{ $profile->name }}</td>
                            <td>{{ $profile->description }}</td>
                            <td class="text-center">
                                <a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <a href="{{ route('profiles.destroy', $profile->id) }}" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Excluir
                                </a>
                                <a href="{{ route('profile.permissions', $profile->id) }}" class="btn btn-danger">
                                    <i class="fa fa-lock"></i> Permissões
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
