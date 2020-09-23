@extends('layouts.app')

@section('title', 'Edição')

@section('content')
    <div class="container">
        <div class="card">
            <form role="form" id="form" action="{{ route('profiles.update', $profile->id) }}" method="POST">
                @method('PUT')
                @include('painel.pages.profiles._partials.form')
            </form>
        </div>
    </div>
@endsection
