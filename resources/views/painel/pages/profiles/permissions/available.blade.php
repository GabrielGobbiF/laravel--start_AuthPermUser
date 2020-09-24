@extends('layouts.app')

@section('title', 'Permissões do Perfil')

@section('content')
    <form action="{{ route('profile.permissions.attach', $profile->id) }}" method="POST">
        <div class="container">
            <div class="row">
                <h1> Permissões Disponiveis Perfil {{ $profile->name }}</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center" width="50px">#</th>
                            <th>Nome</th>

                        </tr>
                    </thead>
                    <tbody>
                        @csrf
                        @foreach ($permissions as $permission)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" />
                                </td>
                                <td>{{ $permission->name }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="" colspan="500">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
@endsection
