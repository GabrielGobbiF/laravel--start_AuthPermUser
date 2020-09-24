@extends('layouts.app')

@section('title', 'Permissões')

@section('content')
    <div class="container">
        <div class="row">
            <h1> Permissões </h1>
            <a href="{{ route('permissions.create') }}" class="btn btn-dark"> Add</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td class="text-center">
                                <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('permissions.destroy', $permission->id) }}" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <a href="{{ route('permissions.profiles', $permission->id) }}" class="btn btn-warning">
                                    <i class="fas fa-users"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
