@extends('layouts.app')

@section('title', 'Perfis da Permissões')

@section('content')
    <div class="container">
        <div class="row">
            <h1> Perfis da Permissões  {{ ucfirst($permission->name) }}</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile)
                        <tr>
                            <td>{{ $profile->name }}</td>
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
