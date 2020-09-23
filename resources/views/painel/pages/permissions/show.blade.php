@extends('layouts.app')

@section('title', 'Edição')

@section('content')
    <div class="container">
        <div class="card">
            <form role="form" id="form" action="{{ route('permissions.update', $permission->id) }}" method="POST">
                @method('PUT')
                @include('painel.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@endsection
