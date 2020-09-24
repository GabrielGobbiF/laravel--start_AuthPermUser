@extends('layouts.app')

@section('title', 'Permissões')

@section('content')
    <div class="container">
        <div class="row">
            <h1> Permissões do Perfil {{ $profile->name }}</h1>
            <a href="{{ route('profile.permissions.available', $profile->id) }}" class="btn btn-dark"> Adicionar nova Permissão</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('profile.permissions.detach', [$profile->id, $permission->id]) }}" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Retirar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
